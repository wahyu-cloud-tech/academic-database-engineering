<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Mahasiswa extends Model {
 use HasFactory;
 protected $table = 'mahasiswas';
 protected $fillable = ['program_studi_id',
        'nim',
        'nama',
        'email',
        'angkatan',
        'aktif'];
 public function programStudi(){ return $this->belongsTo(ProgramStudi::class); }
 public function krs(){ return $this->hasMany(Krs::class); }
}
