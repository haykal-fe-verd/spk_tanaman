<?php

namespace App\Http\Controllers;

use App\Helpers\AhpHelper;
use App\Models\BobotKriteria;
use App\Models\Kriteria;
use App\Models\NilaiPerbandingan;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;


class AhpController extends Controller
{
    public function index(): Response
    {
        $kriteria = Kriteria::all();
        $perbandingan = [];

        $data = NilaiPerbandingan::all();
        foreach ($data as $item) {
            $perbandingan[$item->kriteria_1][$item->kriteria_2] = $item->nilai;
        }

        return Inertia::render('ahp/index', compact('kriteria', 'perbandingan'));
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->input('perbandingan');

        // Hapus data sebelumnya
        NilaiPerbandingan::truncate();

        foreach ($data as $k1 => $items) {
            foreach ($items as $k2 => $nilai) {
                if (empty($nilai)) continue;

                // Simpan nilai asli
                NilaiPerbandingan::create([
                    'kriteria_1' => $k1,
                    'kriteria_2' => $k2,
                    'nilai' => $nilai,
                ]);

                // Simpan nilai kebalikannya juga (1/n)
                NilaiPerbandingan::create([
                    'kriteria_1' => $k2,
                    'kriteria_2' => $k1,
                    'nilai' => 1 / $nilai,
                ]);
            }
        }


        return redirect()->back()->with('success', 'Data perbandingan berhasil disimpan.');
    }

    public function bobotAhp(): RedirectResponse
    {
        $bobot = AhpHelper::hitungBobotKriteria();

        // Simpan ke tabel bobot_kriteria
        foreach ($bobot as $id_kriteria => $nilai) {
            BobotKriteria::updateOrCreate(
                ['id_kriteria' => $id_kriteria],
                ['bobot' => $nilai]
            );
        }

        return redirect()->back()->with('success', 'Perhitungan AHP selesai. Bobot kriteria disimpan.');
    }
}
