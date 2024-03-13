<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\models\Pengajuan_cuti;
use App\models\View_sisa_cuti;
use App\models\DIvisi;

class Manage_pengajuan_cuti extends Controller
{
    public function index(Request $request)
    {
        $role = Session('user')['role'];
        switch ($role) {
            case 'karyawan':
                # code...
                return $this->index_karyawan($request);
                break;

            case 'Karyawan':
                # code...
                return $this->index_karyawan($request);
                break;
            case 'Manager':
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
        $data['pengajuan_cuti'] = Pengajuan_cuti::join('pegawai','pegawai.id','=','pengajuan_cuti.pegawai_id')->join('urgensi_cuti', 'urgensi_cuti.id','=','pengajuan_cuti.urgensi_cuti_id')->get();
        // dd($data)
        return view('manage_pengajuan_cuti', $data);
    }
    public function index_pengelolaa($request){
        $data['role'] = Session('user')['role'];
        $id_divisi = Session('user')['id_divisi'];
        $data['pengajuan_cuti'] = Pengajuan_cuti::join('karyawan','karyawan.id_karyawan','=','pengajuan_cuti.id_karyawan')
        ->first();
        $data['pengajuan_cuti'] = Pengajuan_cuti::join('pejabat_struktural','pejabat_struktural.id_divisi','=','pengajuan_cuti.id_divisi')
        ->where(['pengajuan_cuti.id_divisi' => $id_divisi])
        ->get();
        return view('manage_pengajuan_cuti', $data);
    }
    public function index_karyawan($request){
        $data['role'] = Session('user')['role'];
        $id_karyawan = Session('user')['id_karyawan'];;
        $data['pengajuan_cuti'] = Pengajuan_cuti::join('karyawan','karyawan.id_karyawan','=','pengajuan_cuti.id_karyawan')
        ->where(['karyawan.id_karyawan' => $id_karyawan])
        ->get();
        return view('manage_pengajuan_cuti', $data);
    }

    public function create()
    {

        return view('form_pengajuan_cuti');
    }

    public function store(Request $request)
    {
        $id_karyawan = Session('user')['id_karyawan'];
        $sisa_cuti = View_sisa_cuti::where([
            'id_karyawan' => $id_karyawan,
            'tahun' => substr($request->tanggal_pengajuan,0,4),
        ])->first();
        if($sisa_cuti->sisa_cuti >= $request->lama_cuti) {
            $data = $request->all();
            $data['id_karyawan'] = $id_karyawan;
            $simpan = Pengajuan_cuti::create($data);
            if ($request->hasFile('ttd_karyawan')) {
               $request->file('ttd_karyawan')->move('ttd_karyawan/', $request->file('ttd_karyawan')->getClientOriginalName());
               $simpan->ttd_karyawan = $request->file('ttd_karyawan')->getClientOriginalName();
               $simpan->save();
            }
            if ($simpan) {
                return redirect(Session('user')['role'].'/manage-pengajuan-cuti')->with('success', 'Berhasil membuat pengajuan cuti');
            } else {
                return redirect(Session('user')['role'].'/manage-pengajuan-cuti')->with('failed', 'Gagal membuat pengajuan cuti');
            }
        } else {
            return redirect(Session('user')['role'].'/manage-pengajuan-cuti')->with('failed', 'Gagal, sisa cuti tidak mencukupi');
        }
    }

    public function edit(Request $request)
    {
        $data['pengajuan_cuti'] = Pengajuan_cuti::join('pegawai','pegawai.id','=','pengajuan_cuti.pegawai_id')->join('urgensi_cuti', 'urgensi_cuti.id','=','pengajuan_cuti.urgensi_cuti_id')->where([
            'id_pengajuan_cuti' => $request->segment(3)
        ])->first();
        return view('form_konfirmasi_pengajuan', $data);
    }
    public function update(Request $request)
    {
        $pengajuan_cuti = Pengajuan_cuti::where([
            'id_pengajuan_cuti' => $request->segment(3)
        ])->first();
        $nama = Session('user')['nama'];
        $jabatan = Session('user')['role'];
        // $image=Session('user')['image'];
        $pengajuan_cuti->status = $request->status;
        $pengajuan_cuti->verifikasi_oleh = $nama;
        $pengajuan_cuti->jabatan_verifikasi = $jabatan;
        $pengajuan_cuti->catatan = $request->catatan;
        // $pengajuan_cuti->image = $image;
        if ($pengajuan_cuti->save()) {
            return redirect('pejabat-struktural/hasil-akhir-pengajuan-cuti')->with('success', 'Berhasil memperbarui pengajuan cuti');
        } else {
            return redirect('pejabat-struktural/hasil-akhir-pengajuan-cuti')->with('failed', 'Gagal memperbarui pengajuan cuti');
        }
    }

    public function show(Request $request)
    {
        $p['pengajuan_cuti'] = Pengajuan_cuti::join('karyawan','karyawan.id_karyawan','=','pengajuan_cuti.id_karyawan')->where([
            'id_pengajuan_cuti' => $request->segment(3)
        ])->first();
        return view('form_konfirmasi_pengajuan', $p);
    }
    public function print(){

    }
    public function destroy(Request $request)
    {
        $pengajuan_cuti = Pengajuan_cuti::find($request->segment(3));
        if ($pengajuan_cuti->delete()) {
            return redirect(Session('user')['role'].'/manage-pengajuan-cuti')->with('success', 'Berhasil menghapus pengajuan cuti');
        } else {
            return redirect(Session('user')['role'].'/manage-pengajuan-cuti')->with('failed', 'Gagal menghapus pengajuan cuti');
        }
    }
}
