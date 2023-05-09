<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengajuan_cuti_non extends Model
{
    use HasFactory;
    protected $dates =['tanggal_pengajuan','tanggal_lahir'];
    protected $primaryKey = 'id_cuti_non';
    protected $table = "cuti_non";
    protected $fillable = [
        'id_karyawan',
        'tanggal_pengajuan',
        'lama_cuti',
        'keterangan',
        'ttd_karyawan',
        'image'=> 'image|file',
        'status',
        'verifikasi_oleh',
        'jabatan_verifikasi',
        'catatan'
    ];
}
