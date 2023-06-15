<?php

namespace Database\Seeders;

use App\Models\Transaction;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $transactions = [
            [
                'uuid' => 'TRS-3213',
                'date' => '2023-06-13',
                'inventory_id' => '1',
                'inventory_name' => 'Pulpen',
                'quantity' => 36,
                'status' => 'masuk',
                'notes' => 'Deskripsi transaksi 1',
            ],
            // [
            //     'uuid' => 'TRS-8973',
            //     'date' => '2023-06-13',
            //     'inventory_id' => '2',
            //     'quantity' => '23',
            //     'status' => 'masuk',
            //     'notes' => 'Deskripsi transaksi 1',
            // ],
            // [
            //     'uuid' => 'TRS-8971',
            //     'date' => '2023-06-13',
            //     'inventory_id' => '1',
            //     'quantity' => '12',
            //     'status' => 'masuk',
            //     'notes' => 'Deskripsi transaksi 1',
            // ],
            // [
            //     'uuid' => 'TRS-4532',
            //     'date' => '2023-06-13',
            //     'inventory_id' => '1',
            //     'quantity' => '12',
            //     'status' => 'masuk',
            //     'notes' => 'Deskripsi transaksi 1',
            // ],
        ];

        Transaction::insert($transactions);
    }
}
