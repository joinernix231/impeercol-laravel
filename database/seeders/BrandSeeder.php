<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Brand;
use Illuminate\Support\Str;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $brands = [
            ['name' => 'Metic', 'order' => 1],
            ['name' => 'Holsim', 'order' => 2],
            ['name' => 'AquaStop', 'order' => 3],
            ['name' => 'Texsa', 'order' => 4],
            ['name' => 'NovaFlex', 'order' => 5],
            ['name' => 'Soudal', 'order' => 6],
            ['name' => 'Top Cement', 'order' => 7],
            ['name' => 'FiberGlass isober', 'order' => 8],
            ['name' => 'MAPEI', 'order' => 9],
            ['name' => 'SIKA', 'order' => 10],
            ['name' => 'SIKA constructor', 'order' => 11],
        ];

        foreach ($brands as $brandData) {
            Brand::updateOrCreate(
                ['name' => $brandData['name']],
                [
                    'slug' => Str::slug($brandData['name']),
                    'order' => $brandData['order'],
                    'is_active' => true,
                ]
            );
        }
    }
}

