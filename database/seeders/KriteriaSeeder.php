<?php

namespace Database\Seeders;

use App\Models\Kriteria;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KriteriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $kriteria = [
            ['nama' => 'Kebutuhan Air', 'tipe_kriteria' => 'benefit', 'jenis_input' => 'kategori'],
            ['nama' => 'Drainase', 'tipe_kriteria' => 'benefit', 'jenis_input' => 'kategori'],
            ['nama' => 'Lama Istirahat', 'tipe_kriteria' => 'cost', 'jenis_input' => 'numerik'],
            ['nama' => 'Jenis Tanah', 'tipe_kriteria' => 'benefit', 'jenis_input' => 'kategori'],
            ['nama' => 'Musim', 'tipe_kriteria' => 'benefit', 'jenis_input' => 'kategori'],
            ['nama' => 'Tanaman Sebelumnya', 'tipe_kriteria' => 'benefit', 'jenis_input' => 'kategori']
        ];

        foreach ($kriteria as $kriteria) {
            Kriteria::create($kriteria);
        }
    }
}
