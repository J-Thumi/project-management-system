<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('onboarding_plant_preferences', function (Blueprint $table) {
            $table->uuid('id')->primary()->default(DB::raw('(UUID())'));
            $table->foreignUuid('onboarding_id')->constrained('onboarding_requests')->onDelete('cascade');
            $table->foreignUuid('catalog_item_id')->nullable()->constrained('master_items_catalog')->onDelete('set null');
            $table->string('custom_plant_name', 150)->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('onboarding_plant_preferences');
    }
};