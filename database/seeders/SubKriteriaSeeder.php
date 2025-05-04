<?php

namespace Database\Seeders;

use App\Models\Kriteria;
use App\Models\SubKriteria;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SubKriteriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $kriteriaIds = Kriteria::pluck('id', 'nama');

        $dataSubKriteria = [
            'Kebutuhan Air' => [
                ['nama_sub' => 'Tinggi', 'nilai' => 3],
                ['nama_sub' => 'Sedang', 'nilai' => 2],
                ['nama_sub' => 'Rendah', 'nilai' => 1],
            ],
            'Drainase' => [
                ['nama_sub' => 'Cepat', 'nilai' => 3],
                ['nama_sub' => 'Sedang', 'nilai' => 2],
                ['nama_sub' => 'Lambat', 'nilai' => 1],
            ],
            'Jenis Tanah' => [
                ['nama_sub' => 'Pasir', 'nilai' => 1],
                ['nama_sub' => 'Liat', 'nilai' => 2],
                ['nama_sub' => 'Lempung', 'nilai' => 3],
                ['nama_sub' => 'Gambut', 'nilai' => 4],
            ],
            'Musim' => [
                ['nama_sub' => 'Kemarau', 'nilai' => 1],
                ['nama_sub' => 'Hujan', 'nilai' => 2],
            ],
        ];

        foreach ($dataSubKriteria as $namaKriteria => $subKriterias) {
            $idKriteria = $kriteriaIds[$namaKriteria] ?? null;

            if ($idKriteria) {
                foreach ($subKriterias as $sub) {
                    SubKriteria::create([
                        'id_kriteria' => $idKriteria,
                        'nama_sub' => $sub['nama_sub'],
                        'nilai' => $sub['nilai'],
                    ]);
                }
            }
        }
    }
}
