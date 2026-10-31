<?php
namespace App\Http\Controllers;
use App\Models\{Krs,Mahasiswa,KelasKuliah}; use App\Services\KrsService; use Illuminate\Http\Request; use Illuminate\Routing\Controller;
class KrsController extends Controller {
 public function index(){ $rows=Krs::with('mahasiswa.programStudi','details.kelasKuliah.mataKuliah')->latest()->paginate(10); return view('krs.index',compact('rows')); }
 public function create(){ return view('krs.create',['mahasiswas'=>Mahasiswa::where('aktif',true)->orderBy('nama')->get(),'kelas'=>KelasKuliah::with(['mataKuliah','dosen'])->where('tahun_akademik','2026/2027')->orderBy('id')->get()]); }
 public function store(Request $r,KrsService $service){ $data=$r->validate(['mahasiswa_id'=>'required|exists:mahasiswas,id','tahun_akademik'=>'required|string|max:9','semester'=>'required|in:ganjil,genap','kelas_ids'=>'required|array|min:1','kelas_ids.*'=>'integer|distinct|exists:kelas_kuliahs,id']); try{$service->buat(Mahasiswa::findOrFail($data['mahasiswa_id']),$data); return redirect()->route('krs.index')->with('success','KRS berhasil dibuat secara atomik melalui database transaction.');}catch(\Throwable $e){return back()->withInput()->with('error','KRS gagal disimpan. Pastikan mahasiswa belum memiliki KRS pada periode yang sama dan kelas tidak duplikat.');} }
 public function show(Krs $kr){ $kr->load('mahasiswa.programStudi','details.kelasKuliah.mataKuliah','details.kelasKuliah.dosen'); return view('krs.show',['row'=>$kr]); }
}
