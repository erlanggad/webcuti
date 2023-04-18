@extends('template')

@section('title','- Form Pengajuan Cuti')

@section('konten')
<div class="container-fluid">
    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">Form</h4>
        </div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">

        </div>
        <!-- /.col-lg-12 -->
    </div>

    @if (Request::segment(3) == 'create')
    <!-- .row -->
    <div class="row">
        <div class="col-sm-12">
            <div class="white-box">
                <h3 class="box-title m-b-0">Form Pengajuan Cuti</h3>
                <hr>
                <form class="form" action="/{{ Session('user')['role'] }}/store-pengajuan-non" method="post">
                    @csrf
                    <div class="form-group row">
                        <label for="example-email-input" class="col-2 col-form-label">Tanggal Pengajuan</label>
                        <div class="col-10">
                            <input class="form-control" name="tanggal_pengajuan" type="date" value="" id="example-email-input" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="example-email-input" class="col-2 col-form-label">Lama Cuti</label>
                        <div class="col-10">
                            <input class="form-control" name="lama_cuti" type="number" min="1" value="1" id="example-email-input" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="example-email-input" class="col-2 col-form-label">Keterangan</label>
                        <div class="col-10">
                           <select name="keterangan" class="form-control" id="" required>
                                <option>Cuti sakit dengan surat keterangan dokter</option>
                                <option>Cuti bersalin</option>
                                <option>Cuti gugur kandungan dengan surat keterangan dokter</option>
                                <option>Cuti bersalin</option>
                                <option>Cuti melangsungkan pernikahan</option>
                                <option>Mengkhitankan anak</option>
                                <option>Membaptis anak</option>
                                <option>Menikahkan anak</option>
                                <option>Ibu/Bapak, Istri/Suami, anak, kakak/adik, mertua/menantu menderita sakit keras atau istri gugur kandungan</option>
                                <option>Ibu/Bapak, Istri/Suami, anak, kakak/adik, mertua/menantu meninggal dunia</option>
                                <option>Istri melahirkan/option>
                                <option>Menunaikan ibadah haji</option>
                                <option>Istirahat panjang selama 6 (enam) bulan</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-12">

                            <button class="btn btn-primary btn-block" type="submit">Buat</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- /.row -->
    
    @endif

</div>
@endsection