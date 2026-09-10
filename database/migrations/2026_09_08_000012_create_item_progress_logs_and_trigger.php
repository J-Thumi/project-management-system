<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('item_progress_logs', function (Blueprint $table) {
            $table->uuid('id')->primary()->default(DB::raw('(UUID())'));
            $table->foreignUuid('daily_log_id')->constrained('daily_logs')->onDelete('cascade');
            $table->foreignUuid('quotation_item_id')->constrained('quotation_items')->onDelete('cascade');
            $table->decimal('quantity_added', 10, 2);
            $table->timestamp('created_at')->useCurrent();
        });

        // Add CHECK constraint (Supported in MariaDB 10.2.1+)
        DB::statement("ALTER TABLE item_progress_logs ADD CONSTRAINT chk_quantity_added CHECK (quantity_added > 0);");

        // MariaDB Trigger to automatically update installed quantity on quotation_items
        DB::unprepared("
            CREATE TRIGGER trg_after_item_progress_insert
            AFTER INSERT ON item_progress_logs
            FOR EACH ROW
            BEGIN
                UPDATE quotation_items
                SET quantity_installed = quantity_installed + NEW.quantity_added
                WHERE id = NEW.quotation_item_id;
            END;
        ");
    }

    public function down(): void
    {
        DB::unprepared("DROP TRIGGER IF EXISTS trg_after_item_progress_insert;");
        Schema::dropIfExists('item_progress_logs');
    }
};