<?php
namespace App\Http\Controllers;
use App\Models\{ProgramStudi,Dosen,Mahasiswa,MataKuliah,KelasKuliah,Krs};
use Illuminate\Routing\Controller;
class DashboardController extends Controller { public function __invoke(){ return view('dashboard.index',['stats'=>['Program Studi'=>ProgramStudi::count(),'Dosen'=>Dosen::count(),'Mahasiswa'=>Mahasiswa::count(),'Mata Kuliah'=>MataKuliah::count(),'Kelas Kuliah'=>KelasKuliah::count(),'KRS'=>Krs::count()],'recent'=>Krs::with('mahasiswa.programStudi')->latest()->take(6)->get()]); } }
