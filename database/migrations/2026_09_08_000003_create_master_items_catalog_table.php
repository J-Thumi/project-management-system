<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('master_items_catalog', function (Blueprint $table) {
            $table->uuid('id')->primary()->default(DB::raw('(UUID())'));
            $table->enum('category', ['hardscape','trees',
                'shrubs',
                'groundcovers',
                'pots',
                'irrigation',
                'lawn',
                'gravel',
                'mulch',
                'lighting',
                'labour']);
            $table->string('common_name', 150);
            $table->string('Supplier_name')->nullable();
            $table->string('botanical_name', 150)->nullable();
            $table->string('sun_requirements', 100)->nullable();
            $table->string('water_needs', 100)->nullable();
            $table->string('mature_size', 100)->nullable();
            $table->string('unit_of_measure', 30)->default('pcs');
            $table->decimal('default_unit_price', 10, 2)->default(0.00);
            $table->timestamp('created_at')->useCurrent();
        });

    }

    public function down(): void
    {
        Schema::dropIfExists('master_items_catalog');
    }
};