<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class KelasKuliah extends Model
{
    use HasFactory;

    protected $table = 'kelas_kuliahs';

    protected $fillable = [
        'mata_kuliah_id',
        'dosen_id',
        'nama_kelas',
        'tahun_akademik',
        'semester',
        'kapasitas',
    ];

    public function mataKuliah()
    {
        return $this->belongsTo(MataKuliah::class);
    }

    public function dosen()
    {
        return $this->belongsTo(Dosen::class);
    }

    public function krsDetails()
    {
        return $this->hasMany(KrsDetail::class);
    }
}