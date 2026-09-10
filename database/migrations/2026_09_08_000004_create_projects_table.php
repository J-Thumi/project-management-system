
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->uuid('id')->primary()->default(DB::raw('(UUID())'));
            $table->string('title', 150);
            $table->foreignUuid('client_id')->constrained('users')->onDelete('restrict');
            $table->foreignUuid('designer_id')->nullable()->constrained('users')->onDelete('set null');
            $table->foreignUuid('supervisor_id')->nullable()->constrained('users')->onDelete('set null');
            $table->enum('status', ['inquiry', 'active', 'on_hold', 'completed', 'cancelled'])->default('inquiry');
            $table->text('property_address');
            $table->decimal('property_size_sqm', 10, 2)->nullable();
            $table->timestamps();
        });

    }

    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};