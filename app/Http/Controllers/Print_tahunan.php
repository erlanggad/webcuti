<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\models\Pengajuan_cuti;

class Print_tahunan extends Controller
{
    public function show(Request $request)
    {
        $data['pengajuan_cuti'] = Pengajuan_cuti::join('karyawan','karyawan.id_karyawan','=','pengajuan_cuti.id_karyawan')->where([
            'id_pengajuan_cuti' => $request->segment(3)
        ])->first();
        return view('print_tahunan', $data);
    }
}
