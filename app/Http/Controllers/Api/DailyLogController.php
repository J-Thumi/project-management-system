<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\DailyLog;
use App\Models\ItemProgressLog;
use App\Models\LogMedia;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DailyLogController extends Controller
{
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'project_id' => 'required|uuid|exists:projects,id',
            'supervisor_id' => 'required|uuid|exists:users,id',
            'log_date' => 'nullable|date',
            'summary_notes' => 'required|string',
            'progress_items' => 'nullable|array',
            'progress_items.*.quotation_item_id' => 'required|uuid|exists:quotation_items,id',
            'progress_items.*.quantity_added' => 'required|numeric|gt:0',
            'media' => 'nullable|array',
            'media.*.media_type' => 'required|in:render,site_photo,site_video,document',
            'media.*.file_url' => 'required|url',
            'media.*.is_render_comparison_source' => 'nullable|boolean',
        ]);

        $log = DB::transaction(function () use ($validated) {
            $dailyLog = DailyLog::create([
                'project_id' => $validated['project_id'],
                'supervisor_id' => $validated['supervisor_id'],
                'log_date' => $validated['log_date'] ?? now()->toDateString(),
                'summary_notes' => $validated['summary_notes'],
            ]);

            if (!empty($validated['progress_items'])) {
                foreach ($validated['progress_items'] as $item) {
                    ItemProgressLog::create([
                        'daily_log_id' => $dailyLog->id,
                        'quotation_item_id' => $item['quotation_item_id'],
                        'quantity_added' => $item['quantity_added'],
                    ]);
                }
            }

            if (!empty($validated['media'])) {
                foreach ($validated['media'] as $mediaItem) {
                    LogMedia::create([
                        'daily_log_id' => $dailyLog->id,
                        'project_id' => $validated['project_id'],
                        'uploaded_by_user_id' => $validated['supervisor_id'],
                        'media_type' => $mediaItem['media_type'],
                        'file_url' => $mediaItem['file_url'],
                        'is_render_comparison_source' => $mediaItem['is_render_comparison_source'] ?? false,
                    ]);
                }
            }

            return $dailyLog;
        });

        return response()->json($log->load(['itemProgressLogs', 'media']), 201);
    }
}