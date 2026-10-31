<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Krs extends Model {
 use HasFactory;
 protected $table = 'krs';
 protected $fillable = ['mahasiswa_id',
        'tahun_akademik',
        'semester',
        'status',
        'diajukan_at'];
 public function mahasiswa(){ return $this->belongsTo(Mahasiswa::class); }
 public function details(){ return $this->hasMany(KrsDetail::class); }
}
