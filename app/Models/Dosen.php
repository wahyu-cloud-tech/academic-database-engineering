<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Dosen extends Model
{
    use HasFactory;

    protected $table = 'dosens';

    protected $fillable = [
        'nidn',
        'nama',
        'email',
        'aktif',
    ];

    public function kelasKuliahs()
    {
        return $this->hasMany(KelasKuliah::class);
    }
}