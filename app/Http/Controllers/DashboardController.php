<?php

namespace App\Http\Controllers;

use App\Models\Nilai;
use App\Models\Siswa;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        return view('dashboard', [
            'totalSiswa' => Siswa::count(),
            'totalNilai' => Nilai::count(),
            'siswaTerbaru' => Siswa::query()->latest()->limit(5)->get(),
        ]);
    }
}
