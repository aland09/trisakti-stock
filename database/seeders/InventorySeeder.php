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
                'code' => 'INV0000001',
                'slug' => 'pulpen',
                'category_id' => 1,
                'quantity' => 100,
                'satuan' => 'pcs',
                'image' => 'seeder/pulpen.png',
                'description' => 'Deskripsi pulpen',
            ],
            [
                'name' => 'CCTV',
                'code' => 'INV0000002',
                'slug' => 'cctv',
                'category_id' => 6,
                'quantity' => 10,
                'satuan' => 'pcs',
                'image' => 'seeder/cctv.png',
                'description' => 'Deskripsi cctv',
            ],
            [
                'name' => 'Meja',
                'code' => 'INV0000003',
                'slug' => 'meja',
                'category_id' => 3,
                'quantity' => 20,
                'satuan' => 'pcs',
                'image' => 'seeder/meja.png',
                'description' => 'Deskripsi meja',
            ],
            [
                'name' => 'Monitor',
                'code' => 'INV0000004',
                'slug' => 'monitor',
                'category_id' => 2,
                'quantity' => 30,
                'satuan' => 'pcs',
                'image' => 'seeder/monitor.png',
                'description' => 'Deskripsi monitor',
            ],
            [
                'name' => 'Palu',
                'code' => 'INV0000005',
                'slug' => 'palu',
                'category_id' => 5,
                'quantity' => 8,
                'satuan' => 'pcs',
                'image' => 'seeder/palu.png',
                'description' => 'Deskripsi palu',
            ],
            [
                'name' => 'Sapu',
                'code' => 'INV0000006',
                'slug' => 'sapu',
                'category_id' => 4,
                'quantity' => 18,
                'satuan' => 'pcs',
                'image' => 'seeder/sapu.png',
                'description' => 'Deskripsi sapu',
            ],
        ]);
    }
}
