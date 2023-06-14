<?php

namespace Database\Seeders;

use App\Models\Inventory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class InventorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Inventory::insert([
            [
                'name' => 'Pulpen',
                'code' => 'ATK-RI-20239876',
                'slug' => 'pulpen',
                'category_id' => 1,
                'room_id' => 1,
                'quantity' => 36,
                'satuan' => 'pcs',
                'image' => 'seeder/pulpen.png',
                'description' => 'Deskripsi pulpen',
            ],
            [
                'name' => 'CCTV',
                'code' => 'SEC-R2-20232134',
                'slug' => 'cctv',
                'category_id' => 6,
                'room_id' => 2,
                'quantity' => null,
                'satuan' => 'pcs',
                'image' => 'seeder/cctv.png',
                'description' => 'Deskripsi cctv',
            ],
            [
                'name' => 'Meja',
                'code' => 'FUR-R3-20239870',
                'slug' => 'meja',
                'category_id' => 3,
                'room_id' => 3,
                'quantity' => null,
                'satuan' => 'pcs',
                'image' => 'seeder/meja.png',
                'description' => 'Deskripsi meja',
            ],
            [
                'name' => 'Monitor',
                'code' => 'ELC-R4-20231234',
                'slug' => 'monitor',
                'category_id' => 2,
                'room_id' => 4,
                'quantity' => null,
                'satuan' => 'pcs',
                'image' => 'seeder/monitor.png',
                'description' => 'Deskripsi monitor',
            ],
            [
                'name' => 'Palu',
                'code' => 'LAB-R5-20237890',
                'slug' => 'palu',
                'category_id' => 5,
                'room_id' => 5,
                'quantity' => null,
                'satuan' => 'pcs',
                'image' => 'seeder/palu.png',
                'description' => 'Deskripsi palu',
            ],
            [
                'name' => 'Sapu',
                'code' => 'KEB-R6-20237645',
                'slug' => 'sapu',
                'category_id' => 4,
                'room_id' => 6,
                'quantity' => null,
                'satuan' => 'pcs',
                'image' => 'seeder/sapu.png',
                'description' => 'Deskripsi sapu',
            ],
        ]);
    }
}
