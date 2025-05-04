<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class NilaiPerbandingan extends Model
{
    use HasUuids;

    protected $table = 'tb_nilai_perbandingan';
    protected $primaryKey = 'id';
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'kriteria_1',
        'kriteria_2',
        'nilai',
    ];


    // relasi
    public function kriteriaSatu(): BelongsTo
    {
        return $this->belongsTo(Kriteria::class, 'kriteria_1', 'id');
    }

    public function kriteriaDua(): BelongsTo
    {
        return $this->belongsTo(Kriteria::class, 'kriteria_2', 'id');
    }
}
