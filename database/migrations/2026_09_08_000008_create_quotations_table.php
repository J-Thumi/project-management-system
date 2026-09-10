<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('quotations', function (Blueprint $table) {
            $table->uuid('id')->primary()->default(DB::raw('(UUID())'));
            $table->foreignUuid('project_id')->constrained('projects')->onDelete('cascade');
            $table->integer('version_number')->default(1);
            $table->enum('status', ['draft', 'pending_approval', 'approved', 'rejected', 'superseded'])->default('draft');
            $table->decimal('total_amount', 12, 2)->default(0.00);
            $table->foreignUuid('created_by_user_id')->constrained('users')->onDelete('restrict');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('quotations');
    }
};