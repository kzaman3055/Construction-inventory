<?php
namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::create([
            'name' => 'admin',
            'email' => 'info@theriserit.com',
            'password' => bcrypt('riserit'),
        ]);


        $units = [
            ['name' => 'Ton'],
            ['name' => 'KG'],
            ['name' => 'Liter'],
            ['name' => 'Gallon'],
            ['name' => 'Meter'],
        ];
        foreach ($units as $unit) {
            \App\Models\Unit::create($unit);
        }

        $dailycostcategory = [
            ['name' => 'Labor'],
            ['name' => 'Equipment rent'],
            ['name' => 'Transport'],
        ];
        foreach ($dailycostcategory as $costcategory) {
            \App\Models\DailyCostCategory::create($costcategory);
        }

        $materialcategory = [
            ['name' => 'Steel'],
            ['name' => 'Brick'],
            ['name' => 'Concrete'],
            ['name' => 'Sand'],
            ['name' => 'Lumber'],
            ['name' => 'Cement'],
            ['name' => 'Stone Chips'],
            ['name' => 'Tiles'],
            ['name' => 'PVC Pipes'],
        ];
        foreach ($materialcategory as $material) {
            \App\Models\Category::create($material);
        }
    }
}
