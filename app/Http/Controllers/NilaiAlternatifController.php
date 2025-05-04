<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class NilaiAlternatifController extends Controller
{
    public function index(): Response
    {
        // return Inertia::render('alternatif/index', [
        //     'tanaman' => Tanaman::all(),
        //     'kriteria' => Kriteria::with('subKriteria')->get(),
        //     'nilai_alternatif' => NilaiAlternatif::all(), // optional untuk edit/update
        // ]);
    }
}
