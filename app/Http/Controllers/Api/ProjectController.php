<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\ProjectStage;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProjectController extends Controller
{
    private const DEFAULT_STAGES = [
        'inquiry', 'site_visit', 'concept_design', 'quotation', 
        'approval', 'procurement', 'site_prep', 'hard_landscaping', 
        'planting', 'finishing', 'snag_list', 'project_completion'
    ];

    /**
     * Display a paginated list of projects with role-based scoping and status filtering.
     */
    public function index(Request $request): JsonResponse
    {
        $user = $request->user();

        $projects = Project::with(['client', 'designer', 'supervisor', 'stages'])
            // Scope projects by role
            ->when($user && $user->role === 'client', fn($q) => $q->where('client_id', $user->id))
            ->when($user && $user->role === 'designer', fn($q) => $q->where('designer_id', $user->id))
            ->when($user && $user->role === 'supervisor', fn($q) => $q->where('supervisor_id', $user->id))
            // Filter by status if query parameter is provided
            ->when($request->query('status'), fn($q, $status) => $q->where('status', $status))
            ->latest()
            ->paginate($request->integer('per_page', 15));

        return response()->json($projects);
    }

    /**
     * Create a new project and bulk-insert default pipeline stages.
     */
    public function store(Request $request): JsonResponse
    {
        // 1. Authorization Check
        if ($request->user() && !in_array($request->user()->role, ['admin', 'designer'])) {
            return response()->json(['message' => 'Unauthorized to create projects.'], 403);
        }

        // 2. Validation
        $validated = $request->validate([
            'title' => 'required|string|max:150',
            'client_id' => 'required|uuid|exists:users,id',
            'designer_id' => 'nullable|uuid|exists:users,id',
            'supervisor_id' => 'nullable|uuid|exists:users,id',
            'property_address' => 'required|string',
            'property_size_sqm' => 'nullable|numeric|min:0',
            'status' => 'nullable|in:inquiry,active,on_hold,completed,cancelled',
        ]);

        // 3. Atomic Transaction for Project & Default Stages Creation
        $project = DB::transaction(function () use ($validated) {
            $project = Project::create($validated);

            $now = now();
            $stages = collect(self::DEFAULT_STAGES)->map(fn ($stageName, $index) => [
                'id' => (string) Str::uuid(),
                'project_id' => $project->id,
                'stage_name' => $stageName,
                'sequence_order' => $index + 1,
                'is_completed' => false,
                'created_at' => $now,
                'updated_at' => $now,
            ])->toArray();

            // Single bulk insert query instead of multiple loops
            ProjectStage::insert($stages);

            return $project;
        });

        return response()->json($project->load('stages'), 201);
    }

    /**
     * Show detailed project information with all relations.
     */
    public function show(Request $request, string $id): JsonResponse
    {
        $user = $request->user();

        $project = Project::with([
            'client', 
            'designer', 
            'supervisor', 
            'onboardingRequest.plantPreferences.catalogItem', 
            'stages' => fn($q) => $q->orderBy('sequence_order'), 
            'quotations.items', 
            'dailyLogs.media'
        ])->findOrFail($id);

        // RBAC access check on single resource
        if ($user && $user->role === 'client' && $project->client_id !== $user->id) {
            return response()->json(['message' => 'Unauthorized to view this project.'], 403);
        }

        return response()->json($project);
    }

    /**
     * Update project attributes.
     */
    public function update(Request $request, string $id): JsonResponse
    {
        // 1. Authorization Check
        if ($request->user() && !in_array($request->user()->role, ['admin', 'designer'])) {
            return response()->json(['message' => 'Unauthorized to update projects.'], 403);
        }

        $project = Project::findOrFail($id);

        // 2. Validation
        $validated = $request->validate([
            'title' => 'sometimes|string|max:150',
            'designer_id' => 'nullable|uuid|exists:users,id',
            'supervisor_id' => 'nullable|uuid|exists:users,id',
            'property_address' => 'sometimes|string',
            'property_size_sqm' => 'nullable|numeric|min:0',
            'status' => 'sometimes|in:inquiry,active,on_hold,completed,cancelled',
        ]);

        $project->update($validated);

        return response()->json($project);
    }

    /**
     * Update completion status of a project workflow stage.
     */
    public function updateStage(Request $request, string $projectId, string $stageId): JsonResponse
    {
        // 1. Authorization Check
        if ($request->user() && !in_array($request->user()->role, ['admin', 'designer', 'supervisor'])) {
            return response()->json(['message' => 'Unauthorized to modify project stages.'], 403);
        }

        // 2. Locate Stage bound to Project
        $stage = ProjectStage::where('project_id', $projectId)->findOrFail($stageId);

        // 3. Validation
        $validated = $request->validate([
            'is_completed' => 'required|boolean',
            'approved_by_user_id' => 'nullable|uuid|exists:users,id',
        ]);

        $isCompleted = (bool) $validated['is_completed'];

        // 4. Update state with automatic timestamping and approval tagging
        $stage->update([
            'is_completed' => $isCompleted,
            'completed_at' => $isCompleted ? now() : null,
            'approved_by_user_id' => $validated['approved_by_user_id'] 
                ?? ($isCompleted && $request->user() ? $request->user()->id : null),
        ]);

        return response()->json([
            'message' => 'Stage status updated successfully.',
            'stage' => $stage,
        ]);
    }
}