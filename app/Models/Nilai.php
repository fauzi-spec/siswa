<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Nilai extends Model
{
    protected $fillable = [
        'siswa_id',
        'mata_pelajaran',
        'semester',
        'nilai',
    ];

    protected function casts(): array
    {
        return [
            'semester' => 'integer',
            'nilai' => 'decimal:2',
        ];
    }

    public function siswa(): BelongsTo
    {
        return $this->belongsTo(Siswa::class);
    }
}
