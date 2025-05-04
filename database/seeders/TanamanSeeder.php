<?php

namespace Database\Seeders;

use App\Models\Tanaman;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TanamanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tanaman = [
            "Padi",
            "Tembakau",
            "Cabai Besar",
            "Cabai Rawit",
            "Tomat",
            "Bawang Merah",
            "Jagung",
        ];

        foreach ($tanaman as $tanaman) {
            Tanaman::create([
                'nama' => $tanaman,
            ]);
        }
    }
}
