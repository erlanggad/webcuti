<?php

namespace App\Http\Controllers;

use App\Models\Divisi;
use App\Models\Jabatan;
use Illuminate\Http\Request;
use App\models\Karyawan;
use App\Models\Pegawai;

class Manage_karyawan extends Controller
{
    public function index()
    {
        $data['karyawan'] = Pegawai::join('jabatan','jabatan.id','=','pegawai.jabatan_id')->join('divisi', 'divisi.id','=','pegawai.divisi_id')->select('pegawai.*', 'divisi.nama as nama_divisi', 'jabatan.nama as nama_jabatan')->get();
        return view('manage_karyawan', $data);
    }

    public function create()
    {
        return view('form_karyawan');
    }

    public function store(Request $request)
    {
        if (Karyawan::create($request->all())) {
            return redirect(Session('user')['role'].'/manage-karyawan')->with('success', 'Berhasil membuat karyawan');
        } else {
            return redirect(Session('user')['role'].'/manage-karyawan')->with('failed', 'Gagal membuat karyawan');
        }
    }

    public function edit(Request $request)
    {
        // $data['karyawan'] = Pegawai::where([
        //     'id' => $request->segment(3)
        // ])->first();
        $karyawan = Pegawai::where([
            'id' => $request->segment(3)
        ])->first();
        $divisi = Divisi::all();
        $jabatan = Jabatan::all();
        return view('form_karyawan', compact('karyawan', 'divisi', 'jabatan'));
    }

    public function update(Request $request)
    {
        $karyawan = Pegawai::where([
            'id' => $request->segment(3)
        ])->first();
        $karyawan->nama_pegawai = $request->nama_karyawan;
        $karyawan->email = $request->email;
        $karyawan->nik = $request->nik;
        $karyawan->created_at = $request->tanggal_lahir;
        $karyawan->jabatan_id = $request->jabatan_id;
        $karyawan->divisi_id = $request->divisi_id;
        if ($karyawan->save()) {
            return redirect(Session('user')['role'].'/manage-karyawan')->with('success', 'Berhasil memperbarui karyawan');
        } else {
            return redirect(Session('user')['role'].'/manage-karyawan')->with('failed', 'Gagal memperbarui karyawan');
        }
    }

    public function show(){

    }

    public function destroy(Request $request)
    {
        $karyawan = Karyawan::find($request->segment(3));
        if ($karyawan->delete()) {
            return redirect(Session('user')['role'].'/manage-karyawan')->with('success', 'Berhasil menghapus karyawan');
        } else {
            return redirect(Session('user')['role'].'/manage-karyawan')->with('failed', 'Gagal menghapus karyawan');
        }
    }
}
