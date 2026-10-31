<?php
namespace Tests\Feature;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\{ProgramStudi,Mahasiswa,MataKuliah,Dosen,KelasKuliah,Krs,KrsDetail};
use App\Services\KrsService;
use Illuminate\Database\QueryException;
class KrsTransactionTest extends TestCase {
 use RefreshDatabase;
 public function test_failed_detail_rolls_back_krs_header_and_previous_details(): void {
  $prodi=ProgramStudi::create(['kode'=>'TI','nama'=>'Teknik Informatika','jenjang'=>'S1','aktif'=>true]);
  $mhs=Mahasiswa::create(['program_studi_id'=>$prodi->id,'nim'=>'4212345678','nama'=>'Mahasiswa Uji','email'=>'uji@kampus.ac.id','angkatan'=>2026,'aktif'=>true]);
  $dosen=Dosen::create(['nidn'=>'1000000001','nama'=>'Dosen Uji','email'=>'dosen@kampus.ac.id','aktif'=>true]);
  $mk=MataKuliah::create(['kode'=>'IF101','nama'=>'Basis Data','sks'=>3,'semester_rekomendasi'=>3,'aktif'=>true]);
  $kelas=KelasKuliah::create(['mata_kuliah_id'=>$mk->id,'dosen_id'=>$dosen->id,'nama_kelas'=>'A','tahun_akademik'=>'2026/2027','semester'=>'ganjil','kapasitas'=>30]);
  try { app(KrsService::class)->buat($mhs,['tahun_akademik'=>'2026/2027','semester'=>'ganjil','kelas_ids'=>[$kelas->id,999999]]); } catch (QueryException $e) {}
  $this->assertDatabaseCount('krs',0);
  $this->assertDatabaseCount('krs_details',0);
 }
}
