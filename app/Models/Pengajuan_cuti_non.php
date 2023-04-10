<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengajuan_cuti_non extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_cuti_non';
    protected $table = "cuti_non";
    protected $fillable = [
        'id_karyawan',
        'tanggal_pengajuan',
        'lama_cuti',
        'keterangan',
        'status',
        'verifikasi_oleh'
    ];
}
