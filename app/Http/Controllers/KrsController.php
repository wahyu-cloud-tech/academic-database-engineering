<?php
namespace App\Http\Controllers;
use App\Models\{Krs, Mahasiswa, KelasKuliah, MataKuliah};
use App\Services\KrsService;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
class KrsController extends Controller
{
    public function index()
    {
        $rows = Krs::with(['mahasiswa.programStudi', 'details.kelasKuliah.mataKuliah'])->latest()->paginate(10);
        return view('krs.index', compact('rows'));
    }
    public function create()
    {
        $mahasiswas = Mahasiswa::where('aktif', true)->with('programStudi')->orderBy('nama')->get();
        $kelas = KelasKuliah::with(['mataKuliah', 'dosen'])
            ->where('tahun_akademik', '2026/2027')
            ->whereHas('mataKuliah', fn ($query) => $query->where('aktif', true))
            ->orderBy('mata_kuliah_id')->orderBy('nama_kelas')->get();
        // Hitung satu kali per mata kuliah agar kelas A dan B tidak menggandakan SKS.
        $totalSksTersedia = MataKuliah::where('aktif', true)->sum('sks');
        return view('krs.create', compact('mahasiswas', 'kelas', 'totalSksTersedia'));
    }
    public function store(Request $request, KrsService $service)
    {
        $data = $request->validate([
            'mahasiswa_id' => ['required', 'exists:mahasiswas,id'],
            'tahun_akademik' => ['required', 'string', 'max:9'],
            'semester' => ['required', 'in:ganjil,genap'],
            'kelas_ids' => ['required', 'array', 'min:1'],
            'kelas_ids.*' => ['integer', 'distinct', 'exists:kelas_kuliahs,id'],
        ]);
        try {
            $service->buat(Mahasiswa::findOrFail($data['mahasiswa_id']), $data);
            return redirect()->route('krs.index')->with('success', 'KRS berhasil dibuat. Total SKS dihitung dari mata kuliah yang dipilih.');
        } catch (\Throwable $e) {
            return back()->withInput()->with('error', 'KRS gagal disimpan. Pastikan mahasiswa belum memiliki KRS pada periode yang sama dan kelas tidak duplikat.');
        }
    }
    public function show(Krs $kr)
    {
        $kr->load('mahasiswa.programStudi', 'details.kelasKuliah.mataKuliah', 'details.kelasKuliah.dosen');
        return view('krs.show', ['row' => $kr]);
    }
}
