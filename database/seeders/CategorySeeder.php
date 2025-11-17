<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['name' => 'Morteros', 'order' => 1],
            ['name' => 'Growting', 'order' => 2],
            ['name' => 'Pinturas impermeabilizantes', 'order' => 3],
            ['name' => 'Sellos pluretano', 'order' => 4],
            ['name' => 'Hidrofugos', 'order' => 5],
            ['name' => 'Siliconas', 'order' => 6],
            ['name' => 'Boquilla', 'order' => 7],
            ['name' => 'Pegacort', 'order' => 8],
            ['name' => 'Aditivos', 'order' => 9],
            ['name' => 'Vinilos', 'order' => 10],
            ['name' => 'Estuco', 'order' => 11],
        ];

        foreach ($categories as $categoryData) {
            Category::updateOrCreate(
                ['slug' => Str::slug($categoryData['name'])],
                [
                    'name' => $categoryData['name'],
                    'slug' => Str::slug($categoryData['name']),
                    'order' => $categoryData['order'],
                    'is_active' => true,
                ]
            );
        }
    }
}
