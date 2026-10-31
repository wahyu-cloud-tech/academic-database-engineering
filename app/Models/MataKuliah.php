<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class MataKuliah extends Model {
 use HasFactory;
 protected $table = 'mata_kuliahs';
 protected $fillable = ['kode',
        'nama',
        'sks',
        'semester_rekomendasi',
        'aktif'];
 public function kelasKuliahs(){ return $this->hasMany(KelasKuliah::class); }
}
