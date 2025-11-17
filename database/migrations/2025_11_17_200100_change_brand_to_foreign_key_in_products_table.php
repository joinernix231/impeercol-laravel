<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Primero, agregar la nueva columna brand_id
        Schema::table('products', function (Blueprint $table) {
            $table->foreignId('brand_id')->nullable()->after('gallery')->constrained('brands')->onDelete('set null');
        });

        // Migrar datos existentes: intentar asociar productos con marcas por nombre
        // Esto solo funcionará si los nombres coinciden exactamente
        $products = DB::table('products')->whereNotNull('brand')->get();
        
        foreach ($products as $product) {
            $brand = DB::table('brands')->where('name', $product->brand)->first();
            if ($brand) {
                DB::table('products')
                    ->where('id', $product->id)
                    ->update(['brand_id' => $brand->id]);
            }
        }

        // Eliminar la columna antigua brand (string)
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn('brand');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Agregar de vuelta la columna brand como string
        Schema::table('products', function (Blueprint $table) {
            $table->string('brand')->nullable()->after('gallery');
        });

        // Migrar datos de vuelta: obtener el nombre de la marca desde brand_id
        $products = DB::table('products')
            ->join('brands', 'products.brand_id', '=', 'brands.id')
            ->select('products.id', 'brands.name')
            ->get();

        foreach ($products as $product) {
            DB::table('products')
                ->where('id', $product->id)
                ->update(['brand' => $product->name]);
        }

        // Eliminar la foreign key y la columna brand_id
        Schema::table('products', function (Blueprint $table) {
            $table->dropForeign(['brand_id']);
            $table->dropColumn('brand_id');
        });
    }
};

