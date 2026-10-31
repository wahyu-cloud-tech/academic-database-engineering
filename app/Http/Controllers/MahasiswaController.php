<?php
namespace App\Http\Controllers;
use App\Models\{Mahasiswa,ProgramStudi}; use Illuminate\Http\Request; use Illuminate\Routing\Controller;
class MahasiswaController extends Controller {
 public function index(Request $request){ $q=Mahasiswa::with('programStudi')->when($request->search,fn($b,$s)=>$b->where(fn($x)=>$x->where('nama','like',"%$s%")->orWhere('nim','like',"%$s%")))->latest(); return view('mahasiswas.index',['rows'=>$q->paginate(10)->withQueryString()]); }
 public function create(){ return view('mahasiswas.form',['row'=>new Mahasiswa,'prodis'=>ProgramStudi::where('aktif',true)->orderBy('nama')->get()]); }
 public function store(Request $r){ $d=$r->validate(['program_studi_id'=>'required|exists:program_studis,id','nim'=>'required|string|max:20|unique:mahasiswas,nim','nama'=>'required|string|max:100','email'=>'required|email|unique:mahasiswas,email','angkatan'=>'required|integer|min:2000|max:2100']); Mahasiswa::create($d+['aktif'=>$r->boolean('aktif')]); return redirect()->route('mahasiswas.index')->with('success','Mahasiswa berhasil ditambahkan.'); }
 public function edit(Mahasiswa $mahasiswa){ return view('mahasiswas.form',['row'=>$mahasiswa,'prodis'=>ProgramStudi::orderBy('nama')->get()]); }
 public function update(Request $r,Mahasiswa $mahasiswa){ $d=$r->validate(['program_studi_id'=>'required|exists:program_studis,id','nim'=>'required|string|max:20|unique:mahasiswas,nim,'.$mahasiswa->id,'nama'=>'required|string|max:100','email'=>'required|email|unique:mahasiswas,email,'.$mahasiswa->id,'angkatan'=>'required|integer|min:2000|max:2100']); $mahasiswa->update($d+['aktif'=>$r->boolean('aktif')]); return redirect()->route('mahasiswas.index')->with('success','Data mahasiswa diperbarui.'); }
 public function destroy(Mahasiswa $mahasiswa){ try{$mahasiswa->delete(); return back()->with('success','Mahasiswa dihapus.');}catch(\Throwable $e){return back()->with('error','Mahasiswa masih memiliki data KRS sehingga tidak dapat dihapus.');} }
}
