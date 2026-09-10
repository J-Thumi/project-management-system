<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('log_media', function (Blueprint $table) {
            $table->uuid('id')->primary()->default(DB::raw('(UUID())'));
            $table->foreignUuid('daily_log_id')->nullable()->constrained('daily_logs')->onDelete('cascade');
            $table->foreignUuid('project_id')->constrained('projects')->onDelete('cascade');
            $table->foreignUuid('uploaded_by_user_id')->constrained('users')->onDelete('restrict');
            $table->enum('media_type', ['render', 'site_photo', 'site_video', 'document']);
            $table->text('file_url');
            $table->boolean('is_render_comparison_source')->default(false);
            $table->timestamp('created_at')->useCurrent();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('log_media');
    }
};