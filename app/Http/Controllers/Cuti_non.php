<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\models\Pengajuan_cuti_non;

class Cuti_non extends Controller
{
    public function index(Request $request)
    {
        $role = Session('user')['role'];
        switch ($role) {
            case 'karyawan':
                # code...
                return $this->index_karyawan($request);
                break;
            case 'pejabat-struktural':
                # code...
                return $this->index_pengelola($request);
                break;
            case 'admin':
                # code...
                return $this->index_pengelola($request);
                break;
            
            default:
                # code...
                return redirect('/login');
                break;
        }
    }

    public function index_pengelola($request){
        $data['role'] = Session('user')['role'];
        $data['cuti_non'] = Pengajuan_cuti_non::join('karyawan','karyawan.id_karyawan','=','cuti_non.id_karyawan')->get();
        return view('pengajuan_cuti_non', $data);
    }

    public function index_karyawan($request){
        $data['role'] = Session('user')['role'];
        $id_karyawan = Session('user')['id_karyawan'];;
        $data['cuti_non'] = Pengajuan_cuti_non::join('karyawan','karyawan.id_karyawan','=','cuti_non.id_karyawan')
        ->where(['karyawan.id_karyawan' => $id_karyawan])
        ->get();
        return view('pengajuan_cuti_non', $data);
    }

    public function create()
    {
        return view('form_pengajuan_cuti_non');
    }

    public function store(Request $request)
    {      
        $id_karyawan = Session('user')['id_karyawan'];
        $data = $request->all();
            $data['id_karyawan'] = $id_karyawan;
            if (Pengajuan_cuti_non::create($data)) {
                return redirect(Session('user')['role'].'/cuti-non-tahunan')->with('success', 'Berhasil membuat pengajuan cuti');
            } else {
                return redirect(Session('user')['role'].'/cuti-non-tahunan')->with('failed', 'Gagal membuat pengajuan cuti');
            }
    }

    public function edit(Request $request)
    {
        $data['cuti_non'] = Pengajuan_cuti_non::join('karyawan','karyawan.id_karyawan','=','cuti_non.id_karyawan')->where([
            'id_cuti_non' => $request->segment(3)
        ])->first();
        return view('form_konfirmasi_pengajuan_non', $data);
    }

    public function update(Request $request)
    {
        $pengajuan_cuti = Pengajuan_cuti_non::where([
            'id_cuti_non' => $request->segment(3)
        ])->first();
        $nama = Session('user')['nama'];
        $pengajuan_cuti->status = $request->status;
        $pengajuan_cuti->verifikasi_oleh = $nama;
        if ($pengajuan_cuti->save()) {
            return redirect(Session('user')['role'].'/cuti-non-tahunan')->with('success', 'Berhasil memperbarui pengajuan cuti');
        } else {
            return redirect(Session('user')['role'].'/cuti-non-tahunan')->with('failed', 'Gagal memperbarui pengajuan cuti');
        }
    }

    public function show(Request $request){
        
    }

    public function destroy(Request $request)
    {
        $pengajuan_cuti = Pengajuan_cuti_non::find($request->segment(3));
        if ($pengajuan_cuti->delete()) {
            return redirect(Session('user')['role'].'/cuti-non-tahunan')->with('success', 'Berhasil menghapus pengajuan cuti');
        } else {
            return redirect(Session('user')['role'].'/cuti-non-tahunan')->with('failed', 'Gagal menghapus pengajuan cuti');
        }
    }
}
