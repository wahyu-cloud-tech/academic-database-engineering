<?php
namespace App\Services;
use App\Models\Krs; use App\Models\Mahasiswa; use Illuminate\Support\Facades\DB;
class KrsService {
 public function buat(Mahasiswa $mahasiswa, array $data): Krs {
  return DB::transaction(function () use ($mahasiswa,$data) {
   $krs=Krs::create(['mahasiswa_id'=>$mahasiswa->id,'tahun_akademik'=>$data['tahun_akademik'],'semester'=>$data['semester'],'status'=>'draft']);
   foreach($data['kelas_ids'] as $kelasId) $krs->details()->create(['kelas_kuliah_id'=>$kelasId]);
   return $krs->load('mahasiswa.programStudi','details.kelasKuliah.mataKuliah','details.kelasKuliah.dosen');
  });
 }
}
