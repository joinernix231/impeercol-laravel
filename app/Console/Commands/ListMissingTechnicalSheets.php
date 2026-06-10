<?php

namespace App\Console\Commands;

use App\Models\Product;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class ListMissingTechnicalSheets extends Command
{
    protected $signature = 'products:missing-technical-sheets
                            {--export= : Ruta CSV para exportar (default: storage/app/imports/pendientes-fichas.csv)}
                            {--brand= : Filtrar por marca}';

    protected $description = 'Lista productos sin ficha tecnica, agrupados por marca';

    public function handle(): int
    {
        $query = Product::query()
            ->with('brand')
            ->where(function ($q) {
                $q->whereNull('technical_sheet_file')
                    ->orWhere('technical_sheet_file', '');
            })
            ->orderBy('id');

        $brandFilter = $this->option('brand');
        if ($brandFilter) {
            $query->whereHas('brand', function ($q) use ($brandFilter) {
                $q->where('name', 'LIKE', '%'.strtolower($brandFilter).'%');
            });
        }

        $products = $query->get();

        if ($products->isEmpty()) {
            $this->info('Todos los productos tienen ficha tecnica asignada.');

            return Command::SUCCESS;
        }

        $byBrand = $products->groupBy(fn ($p) => $p->brand->name ?? 'Sin marca');

        $this->info("Productos pendientes: {$products->count()}");
        $this->newLine();

        $rows = [];
        foreach ($byBrand->sortKeys() as $brandName => $brandProducts) {
            $rows[] = [$brandName, $brandProducts->count()];
        }

        $this->table(['Marca', 'Pendientes'], $rows);

        $exportPath = $this->option('export') ?: storage_path('app/imports/pendientes-fichas.csv');
        File::ensureDirectoryExists(dirname($exportPath));

        $handle = fopen($exportPath, 'w');
        fputcsv($handle, ['id', 'nombre', 'slug', 'marca']);

        foreach ($products as $product) {
            fputcsv($handle, [
                $product->id,
                $product->name,
                $product->slug,
                $product->brand->name ?? '',
            ]);
        }

        fclose($handle);

        $this->newLine();
        $this->info("Exportado: {$exportPath}");
        $this->line('Reintenta por marca: php artisan products:import-technical-sheets --brand=mapei -v');
        $this->line('Importa PDFs locales: php artisan products:import-technical-sheets --from-folder');

        return Command::SUCCESS;
    }
}
