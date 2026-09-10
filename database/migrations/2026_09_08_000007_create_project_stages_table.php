<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('project_stages', function (Blueprint $table) {
            $table->uuid('id')->primary()->default(DB::raw('(UUID())'));
            $table->foreignUuid('project_id')->constrained('projects')->onDelete('cascade');
            $table->enum('stage_name', [
                'inquiry', 'site_visit', 'concept_design', 'quotation', 'approval', 
                'procurement', 'site_prep', 'hard_landscaping', 'planting', 'finishing', 
                'snag_list', 'project_completion'
            ]);
            $table->integer('sequence_order');
            $table->boolean('is_completed')->default(false);
            $table->timestamp('completed_at')->nullable();
            $table->foreignUuid('approved_by_user_id')->nullable()->constrained('users')->onDelete('set null');
            
            $table->unique(['project_id', 'stage_name']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('project_stages');
    }
};