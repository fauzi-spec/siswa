<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Siswa extends Model
{
    protected $fillable = [
        'nis',
        'nama',
        'jenis_kelamin',
        'kelas',
        'tanggal_lahir',
        'alamat',
    ];

    protected function casts(): array
    {
        return [
            'tanggal_lahir' => 'date',
        ];
    }

    public function nilais(): HasMany
    {
        return $this->hasMany(Nilai::class);
    }

    public function rataRataNilai(): ?float
    {
        $avg = $this->nilais()->avg('nilai');

        return $avg !== null ? round((float) $avg, 2) : null;
    }
}
