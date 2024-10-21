<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Seed stand_categories table
        $categories = [
            ['name' => 'Catégorie 1', 'color' => '#F8CBAD'], // Example color
            ['name' => 'Catégorie 2', 'color' => '#B4C7E7'], // Example color
            ['name' => 'Catégorie 3', 'color' => '#FFFFFF'], // Example color
        ];

        foreach ($categories as $category) {
            DB::table('stand_categories')->updateOrInsert(['name'=>$category['name']],$category);
        }

        // Get category IDs from the database
        $category1Id = DB::table('stand_categories')->where('name', 'Catégorie 1')->value('id');
        $category2Id = DB::table('stand_categories')->where('name', 'Catégorie 2')->value('id');
        $category3Id = DB::table('stand_categories')->where('name', 'Catégorie 3')->value('id');

        // Seed stands table
        $stands = [
            // Catégorie 1 (Price: 3000)
            ['number' => 'A01', 'price' => 3000, 'category_id' => $category1Id],
            ['number' => 'B01', 'price' => 3000, 'category_id' => $category1Id],
            ['number' => 'C01', 'price' => 3000, 'category_id' => $category1Id],
            ['number' => 'D01', 'price' => 3000, 'category_id' => $category1Id],

            // Catégorie 2 (Price: 2500)
            ['number' => 'A02', 'price' => 2500, 'category_id' => $category2Id],
            ['number' => 'B02', 'price' => 2500, 'category_id' => $category2Id],
            ['number' => 'C02', 'price' => 2500, 'category_id' => $category2Id],
            ['number' => 'D02', 'price' => 2500, 'category_id' => $category2Id],
            ['number' => 'B08', 'price' => 2500, 'category_id' => $category2Id],
            ['number' => 'C08', 'price' => 2500, 'category_id' => $category2Id],

            ['number' => 'B09', 'price' => 2500, 'category_id' => $category2Id],
            ['number' => 'C09', 'price' => 2500, 'category_id' => $category2Id],

            ['number' => 'B15', 'price' => 2500, 'category_id' => $category2Id],
            ['number' => 'C15', 'price' => 2500, 'category_id' => $category2Id],
            ['number' => 'B16', 'price' => 2500, 'category_id' => $category2Id],
            ['number' => 'C16', 'price' => 2500, 'category_id' => $category2Id],
            ['number' => 'A21', 'price' => 2500, 'category_id' => $category2Id],
            ['number' => 'B22', 'price' => 2500, 'category_id' => $category2Id],
            ['number' => 'C22', 'price' => 2500, 'category_id' => $category2Id],
            ['number' => 'D21', 'price' => 2500, 'category_id' => $category2Id],

            // Catégorie 3 (Price: 2000)
            ['number' => 'A03', 'price' => 2000, 'category_id' => $category3Id],
            ['number' => 'A04', 'price' => 2000, 'category_id' => $category3Id],
            ['number' => 'A05', 'price' => 2000, 'category_id' => $category3Id],
            ['number' => 'A06', 'price' => 2000, 'category_id' => $category3Id],
            ['number' => 'A07', 'price' => 2000, 'category_id' => $category3Id],
            ['number' => 'A08', 'price' => 2000, 'category_id' => $category3Id],
            ['number' => 'A09', 'price' => 2000, 'category_id' => $category3Id],
            ['number' => 'A10', 'price' => 2000, 'category_id' => $category3Id],
            ['number' => 'A11', 'price' => 2000, 'category_id' => $category3Id],
            ['number' => 'A12', 'price' => 2000, 'category_id' => $category3Id],
            ['number' => 'A13', 'price' => 2000, 'category_id' => $category3Id],
            ['number' => 'A14', 'price' => 2000, 'category_id' => $category3Id],
            ['number' => 'A15', 'price' => 2000, 'category_id' => $category3Id],
            ['number' => 'A16', 'price' => 2000, 'category_id' => $category3Id],
            ['number' => 'A17', 'price' => 2000, 'category_id' => $category3Id],
            ['number' => 'A18', 'price' => 2000, 'category_id' => $category3Id],
            ['number' => 'A19', 'price' => 2000, 'category_id' => $category3Id],
            ['number' => 'A20', 'price' => 2000, 'category_id' => $category3Id],
            ['number' => 'A21', 'price' => 2000, 'category_id' => $category3Id],
            ['number' => 'B03', 'price' => 2000, 'category_id' => $category3Id],
            ['number' => 'B04', 'price' => 2000, 'category_id' => $category3Id],
            ['number' => 'B05', 'price' => 2000, 'category_id' => $category3Id],
            ['number' => 'B06', 'price' => 2000, 'category_id' => $category3Id],
            ['number' => 'B07', 'price' => 2000, 'category_id' => $category3Id],
            ['number' => 'B09', 'price' => 2000, 'category_id' => $category3Id],
            ['number' => 'B10', 'price' => 2000, 'category_id' => $category3Id],
            ['number' => 'B11', 'price' => 2000, 'category_id' => $category3Id],
            ['number' => 'B12', 'price' => 2000, 'category_id' => $category3Id],
            ['number' => 'B13', 'price' => 2000, 'category_id' => $category3Id],
            ['number' => 'B14', 'price' => 2000, 'category_id' => $category3Id],
            ['number' => 'B17', 'price' => 2000, 'category_id' => $category3Id],
            ['number' => 'B18', 'price' => 2000, 'category_id' => $category3Id],
            ['number' => 'B19', 'price' => 2000, 'category_id' => $category3Id],
            ['number' => 'B20', 'price' => 2000, 'category_id' => $category3Id],
            ['number' => 'B21', 'price' => 2000, 'category_id' => $category3Id],
            ['number' => 'C03', 'price' => 2000, 'category_id' => $category3Id],
            ['number' => 'C04', 'price' => 2000, 'category_id' => $category3Id],
            ['number' => 'C05', 'price' => 2000, 'category_id' => $category3Id],
            ['number' => 'C06', 'price' => 2000, 'category_id' => $category3Id],
            ['number' => 'C07', 'price' => 2000, 'category_id' => $category3Id],
            ['number' => 'C09', 'price' => 2000, 'category_id' => $category3Id],
            ['number' => 'C10', 'price' => 2000, 'category_id' => $category3Id],
            ['number' => 'C11', 'price' => 2000, 'category_id' => $category3Id],
            ['number' => 'C12', 'price' => 2000, 'category_id' => $category3Id],
            ['number' => 'C13', 'price' => 2000, 'category_id' => $category3Id],
            ['number' => 'C14', 'price' => 2000, 'category_id' => $category3Id],
            ['number' => 'C17', 'price' => 2000, 'category_id' => $category3Id],
            ['number' => 'C18', 'price' => 2000, 'category_id' => $category3Id],
            ['number' => 'C19', 'price' => 2000, 'category_id' => $category3Id],
            ['number' => 'C20', 'price' => 2000, 'category_id' => $category3Id],
            ['number' => 'C21', 'price' => 2000, 'category_id' => $category3Id],
            ['number' => 'D03', 'price' => 2000, 'category_id' => $category3Id],
            ['number' => 'D04', 'price' => 2000, 'category_id' => $category3Id],
            ['number' => 'D05', 'price' => 2000, 'category_id' => $category3Id],
            ['number' => 'D06', 'price' => 2000, 'category_id' => $category3Id],
            ['number' => 'D07', 'price' => 2000, 'category_id' => $category3Id],
            ['number' => 'D08', 'price' => 2000, 'category_id' => $category3Id],
            ['number' => 'D09', 'price' => 2000, 'category_id' => $category3Id],
            ['number' => 'D10', 'price' => 2000, 'category_id' => $category3Id],
            ['number' => 'D11', 'price' => 2000, 'category_id' => $category3Id],
            ['number' => 'D12', 'price' => 2000, 'category_id' => $category3Id],
            ['number' => 'D13', 'price' => 2000, 'category_id' => $category3Id],
            ['number' => 'D14', 'price' => 2000, 'category_id' => $category3Id],
            ['number' => 'D15', 'price' => 2000, 'category_id' => $category3Id],
            ['number' => 'D16', 'price' => 2000, 'category_id' => $category3Id],
            ['number' => 'D17', 'price' => 2000, 'category_id' => $category3Id],
            ['number' => 'D18', 'price' => 2000, 'category_id' => $category3Id],
            ['number' => 'D19', 'price' => 2000, 'category_id' => $category3Id],
            ['number' => 'D20', 'price' => 2000, 'category_id' => $category3Id],
        ];

        foreach ($stands as $stand) {
            DB::table('stands')->updateOrInsert(['number'=>$stand['number']],$stand);
        }
    }
}






