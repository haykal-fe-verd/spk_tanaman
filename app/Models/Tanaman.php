<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Tanaman extends Model
{
    use HasUuids;

    protected $table = 'tb_tanaman';
    protected $primaryKey = 'id';
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'nama',
    ];

    // relasi
    public function nilaiAlternatif(): HasMany
    {
        return $this->hasMany(NilaiAlternatif::class, 'id_tanaman', 'id');
    }

    public function hasilRekomendasi(): HasOne
    {
        return $this->hasOne(HasilRekomendasi::class, 'id_tanaman', 'id');
    }
}
