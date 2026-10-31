<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class KrsDetail extends Model {
 use HasFactory;
 protected $table = 'krs_details';
 protected $fillable = ['krs_id',
        'kelas_kuliah_id'];
 public function krs(){ return $this->belongsTo(Krs::class); }
 public function kelasKuliah(){ return $this->belongsTo(KelasKuliah::class); }
}
