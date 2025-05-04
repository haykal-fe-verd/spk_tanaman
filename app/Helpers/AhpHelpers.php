<?php

namespace App\Helpers;

use App\Models\Kriteria;
use App\Models\NilaiPerbandingan;

class AhpHelper
{
    public static function hitungBobotKriteria()
    {
        $kriteria = Kriteria::all();
        $jumlah = $kriteria->count();
        $matrix = [];

        // Buat matriks awal perbandingan
        foreach ($kriteria as $i => $k1) {
            foreach ($kriteria as $j => $k2) {
                if ($k1->id == $k2->id) {
                    $matrix[$i][$j] = 1;
                } else {
                    $nilai = NilaiPerbandingan::where('kriteria_1', $k1->id)
                        ->where('kriteria_2', $k2->id)
                        ->value('nilai');

                    $matrix[$i][$j] = $nilai ?? 1; // default fallback
                }
            }
        }

        // Hitung jumlah kolom
        $jmlKolom = array_fill(0, $jumlah, 0);
        for ($j = 0; $j < $jumlah; $j++) {
            for ($i = 0; $i < $jumlah; $i++) {
                $jmlKolom[$j] += $matrix[$i][$j];
            }
        }

        // Normalisasi matriks
        $normal = [];
        for ($i = 0; $i < $jumlah; $i++) {
            for ($j = 0; $j < $jumlah; $j++) {
                $normal[$i][$j] = $matrix[$i][$j] / $jmlKolom[$j];
            }
        }

        // Hitung eigen vector (rata-rata baris)
        $bobot = [];
        for ($i = 0; $i < $jumlah; $i++) {
            $total = array_sum($normal[$i]);
            $bobot[$kriteria[$i]->id] = round($total / $jumlah, 8);
        }

        return $bobot; // array: [id_kriteria => bobot]
    }
}
