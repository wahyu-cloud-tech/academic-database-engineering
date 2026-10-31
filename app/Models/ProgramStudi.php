<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class ProgramStudi extends Model {
 use HasFactory;
 protected $table = 'program_studis';
 protected $fillable = ['kode',
        'nama',
        'jenjang',
        'aktif'];
 public function mahasiswas(){ return $this->hasMany(Mahasiswa::class); }
}
