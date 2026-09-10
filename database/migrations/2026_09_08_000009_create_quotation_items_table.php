<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('quotation_items', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('quotation_id')->constrained('quotations')->onDelete('cascade');
            $table->foreignUuid('catalog_item_id')->nullable()->constrained('master_items_catalog')->onDelete('set null');
            $table->string('item_name', 150);
            $table->enum('category', ['plant', 'hardscape', 'irrigation', 'lighting', 'soil_mulch', 'labor']);
            $table->string('supplier_name', 150)->nullable();
            $table->decimal('quantity_quoted', 10, 2);
            $table->decimal('quantity_installed', 10, 2)->default(0.00);
            $table->decimal('unit_price', 10, 2);
            
            // Correct syntax: attach storedAs() directly to the decimal column definition
            $table->decimal('total_price', 12, 2)->storedAs('quantity_quoted * unit_price');
            
            $table->timestamp('created_at')->useCurrent();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('quotation_items');
    }
};