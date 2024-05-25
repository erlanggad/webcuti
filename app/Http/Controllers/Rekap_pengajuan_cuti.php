<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\models\View_sisa_cuti;

class Rekap_pengajuan_cuti extends Controller
{
    public function index(Request $request)
    {
        // $data['sisa_cuti'] = View_sisa_cuti::join('pegawai', 'pegawai.id','=','sisa_cuti.pegawai_id')->get();
        // return view('rekap_pengajuan_cuti',$data);

        $tahun_list = View_sisa_cuti::distinct()->pluck('tahun')->toArray();

        // dd(Session('user')['role']);
        if (Session('user')['role'] == "Manajer") {
            $query = View_sisa_cuti::join('pegawai', 'pegawai.id', '=', 'sisa_cuti.pegawai_id')->select('sisa_cuti.*', 'pegawai.*')->where('jabatan_id', '!=', '1')->where('pegawai.divisi_id', Session('user')['divisi']);
        } else {
            $query = View_sisa_cuti::join('pegawai', 'pegawai.id', '=', 'sisa_cuti.pegawai_id')->select('sisa_cuti.*', 'pegawai.*')->where('jabatan_id', '!=', '1');
        }

        if ($request->has('tahun')) {
            $query->where('tahun', $request->tahun);
        }

        $data['sisa_cuti'] = $query->get();
        $data['tahun_list'] = $tahun_list;

        return view('rekap_pengajuan_cuti', $data);
    }
}
