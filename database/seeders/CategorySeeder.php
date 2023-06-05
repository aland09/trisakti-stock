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
            [
                'name' => 'Alat Tulis Kantor',
                'code' => 'ATK',
                'description' => 'Deskripsi Alat Tulis Kantor'
            ],
            [
                'name' => 'Barang Elektronik',
                'code' => 'ELC',
                'description' => 'Deskripsi Barang Elektronik'
            ],
            [
                'name' => 'Furniture',
                'code' => 'FUR',
                'description' => 'Deskripsi Furniture'
            ],
            [
                'name' => 'Alat Kebersihan',
                'code' => 'KEB',
                'description' => 'Deskripsi Alat Kebersihan'
            ],
            [
                'name' => 'Peralatan Laboraturium',
                'code' => 'LAB',
                'description' => 'Deskripsi Peralatan Laboraturium'
            ],
            [
                'name' => 'Peralatan Keamanan',
                'code' => 'SEC',
                'description' => 'Deskripsi Peralatan Keamanan'
            ],
            [
                'name' => 'Perlengkapan Olahraga',
                'code' => 'OLG',
                'description' => 'Deskripsi Perlengkapan Olahraga'
            ],
            [
                'name' => 'Peralatan Musik',
                'code' => 'MSK',
                'description' => 'Deskripsi Peralatan Musik'
            ],
        ];

        Category::insert($categories);
    }
}
