<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\models\Pengajuan_cuti_non;

class Print_non_tahunan extends Controller
{
    public function show(Request $request)
    {
        $data['cuti_non'] = Pengajuan_cuti_non::join('karyawan','karyawan.id_karyawan','=','cuti_non.id_karyawan')->where([
            'id_cuti_non' => $request->segment(3)
        ])->first();
        return view('print_non_tahunan', $data);
    }
}
