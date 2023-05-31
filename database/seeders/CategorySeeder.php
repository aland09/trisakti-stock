<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            ['name' => 'ATK', 'description' => 'Deskripsi Alat Tulis Kantor'],
            ['name' => 'Barang Elektronik', 'description' => 'Deskripsi Barang Elektronik'],
            ['name' => 'Furniture', 'description' => 'Deskripsi Furniture'],
            ['name' => 'Alat Kebersihan', 'description' => 'Deskripsi Alat Kebersihan'],
            ['name' => 'Peralatan Laboraturium', 'description' => 'Deskripsi Peralatan Laboraturium'],
            ['name' => 'Peralatan Keamanan', 'description' => 'Deskripsi Peralatan Keamanan'],
            ['name' => 'Perlengkapan Olahraga', 'description' => 'Deskripsi Perlengkapan Olahraga'],
            ['name' => 'Peralatan Musik', 'description' => 'Deskripsi Peralatan Musik'],
        ];

        Category::insert($categories);
    }
}
