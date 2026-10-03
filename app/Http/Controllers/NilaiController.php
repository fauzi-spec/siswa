<?php

namespace App\Http\Controllers;

use App\Models\Nilai;
use App\Models\Siswa;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class NilaiController extends Controller
{
    public function index(Request $request): View
    {
        $q = $request->string('q')->trim();

        $nilais = Nilai::query()
            ->with('siswa')
            ->when($q->isNotEmpty(), function ($query) use ($q) {
                $query->where(function ($inner) use ($q) {
                    $inner->where('mata_pelajaran', 'like', '%'.$q.'%')
                        ->orWhereHas('siswa', function ($siswa) use ($q) {
                            $siswa->where('nama', 'like', '%'.$q.'%')
                                ->orWhere('nis', 'like', '%'.$q.'%');
                        });
                });
            })
            ->orderByDesc('created_at')
            ->paginate(10)
            ->withQueryString();

        return view('nilai.index', compact('nilais', 'q'));
    }

    public function create(): View
    {
        return view('nilai.create', [
            'siswas' => Siswa::orderBy('nama')->get(),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'siswa_id' => ['required', 'exists:siswas,id'],
            'mata_pelajaran' => ['required', 'string', 'max:100'],
            'semester' => ['required', 'integer', 'min:1', 'max:12'],
            'nilai' => ['required', 'numeric', 'min:0', 'max:100'],
        ]);

        $exists = Nilai::query()
            ->where('siswa_id', $validated['siswa_id'])
            ->where('mata_pelajaran', $validated['mata_pelajaran'])
            ->where('semester', $validated['semester'])
            ->exists();

        if ($exists) {
            return back()
                ->withInput()
                ->withErrors(['mata_pelajaran' => 'Nilai untuk mata pelajaran dan semester ini sudah ada.']);
        }

        Nilai::create($validated);

        return redirect()->route('nilai.index')->with('success', 'Nilai berhasil ditambahkan.');
    }

    public function edit(Nilai $nilai): View
    {
        return view('nilai.edit', [
            'nilai' => $nilai,
            'siswas' => Siswa::orderBy('nama')->get(),
        ]);
    }

    public function update(Request $request, Nilai $nilai): RedirectResponse
    {
        $validated = $request->validate([
            'siswa_id' => ['required', 'exists:siswas,id'],
            'mata_pelajaran' => ['required', 'string', 'max:100'],
            'semester' => ['required', 'integer', 'min:1', 'max:12'],
            'nilai' => ['required', 'numeric', 'min:0', 'max:100'],
        ]);

        $exists = Nilai::query()
            ->where('siswa_id', $validated['siswa_id'])
            ->where('mata_pelajaran', $validated['mata_pelajaran'])
            ->where('semester', $validated['semester'])
            ->where('id', '!=', $nilai->id)
            ->exists();

        if ($exists) {
            return back()
                ->withInput()
                ->withErrors(['mata_pelajaran' => 'Nilai untuk mata pelajaran dan semester ini sudah ada.']);
        }

        $nilai->update($validated);

        return redirect()->route('nilai.index')->with('success', 'Nilai berhasil diperbarui.');
    }

    public function destroy(Nilai $nilai): RedirectResponse
    {
        $nilai->delete();

        return redirect()->route('nilai.index')->with('success', 'Nilai berhasil dihapus.');
    }
}
