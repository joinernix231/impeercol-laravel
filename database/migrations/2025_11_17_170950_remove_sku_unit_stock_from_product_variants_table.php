<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (Schema::hasTable('product_variants')) {
            $columnsToDrop = collect(['sku', 'unit', 'stock'])
                ->filter(fn ($column) => Schema::hasColumn('product_variants', $column))
                ->values()
                ->all();

            if (!empty($columnsToDrop)) {
                Schema::table('product_variants', function (Blueprint $table) use ($columnsToDrop) {
                    $table->dropColumn($columnsToDrop);
                });
            }
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('product_variants', function (Blueprint $table) {
            $table->string('sku')->nullable();
            $table->string('unit')->nullable();
            $table->integer('stock')->default(0);
        });
    }
};
