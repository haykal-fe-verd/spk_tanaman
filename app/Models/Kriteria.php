<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Kriteria extends Model
{
    use HasUuids;

    protected $table = 'tb_kriteria';
    protected $primaryKey = 'id';
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'nama',
        'tipe_kriteria',
        'jenis_input',
    ];

    // relasi
    public function subKriteria(): HasMany
    {
        return $this->hasMany(SubKriteria::class, 'id_kriteria', 'id');
    }

    public function nilaiAlternatif(): HasMany
    {
        return $this->hasMany(NilaiAlternatif::class, 'id_kriteria', 'id');
    }

    public function bobotKriteria(): HasOne
    {
        return $this->hasOne(BobotKriteria::class, 'id_kriteria', 'id');
    }
}
