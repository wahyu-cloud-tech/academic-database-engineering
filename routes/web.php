<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{DashboardController,MahasiswaController,KrsController};
use App\Models\{ProgramStudi,Dosen,MataKuliah,KelasKuliah};
Route::get('/',DashboardController::class)->name('dashboard');
Route::resource('mahasiswas',MahasiswaController::class)->except(['show']);
Route::get('/krs',[KrsController::class,'index'])->name('krs.index');
Route::get('/krs/create',[KrsController::class,'create'])->name('krs.create');
Route::post('/krs',[KrsController::class,'store'])->name('krs.store');
Route::get('/krs/{kr}',[KrsController::class,'show'])->name('krs.show');
Route::get('/master/{type}',function(string $type){ $map=['program-studi'=>[ProgramStudi::class,'Program Studi'],'dosen'=>[Dosen::class,'Dosen'],'mata-kuliah'=>[MataKuliah::class,'Mata Kuliah'],'kelas-kuliah'=>[KelasKuliah::class,'Kelas Kuliah']]; abort_unless(isset($map[$type]),404); [$model,$title]=$map[$type]; $rows=$model::latest()->paginate(12); if($type==='kelas-kuliah') $rows=$model::with(['mataKuliah','dosen'])->latest()->paginate(12); return view('shared.master',['rows'=>$rows,'title'=>$title,'type'=>$type]); })->name('master.index');
