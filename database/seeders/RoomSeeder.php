<?php

namespace Database\Seeders;

use App\Models\Room;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $rooms = [
            [
                'name' => 'Ruangan 1',
                'code' => 'R1',
                'description' => 'Deskripsi Ruangan 1'
            ],
            [
                'name' => 'Ruangan 2',
                'code' => 'R2',
                'description' => 'Deskripsi Ruangan 2'
            ],
            [
                'name' => 'Ruangan 3',
                'code' => 'R3',
                'description' => 'Deskripsi Ruangan 3'
            ],
            [
                'name' => 'Ruangan 4',
                'code' => 'R4',
                'description' => 'Deskripsi Ruangan 4'
            ],
            [
                'name' => 'Ruangan 5',
                'code' => 'R5',
                'description' => 'Deskripsi Ruangan 5'
            ],
            [
                'name' => 'Ruangan 6',
                'code' => 'R6',
                'description' => 'Deskripsi Ruangan 6'
            ],
        ];

        Room::insert($rooms);
    }
}
