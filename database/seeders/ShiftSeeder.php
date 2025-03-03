<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ShiftSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $shifts = [
            [
                'namaShift' => 'Pagi',
                'mulai' => '08:00',  // Jam mulai shift
                'akhir' => '16:00',  // Jam selesai shift
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'namaShift' => 'Siang',
                'mulai' => '16:00',
                'akhir' => '00:00',  // Shift malam sampai dini hari
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'namaShift' => 'Malam',
                'mulai' => '00:00',
                'akhir' => '08:00',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'namaShift' => 'All Shift',
                'mulai' => '00:00',
                'akhir' => '00:00',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        // Looping untuk memasukkan data shift ke dalam tabel
        foreach ($shifts as $shift) {
            DB::table('shifts')->insert($shift);
        }
    }
}
