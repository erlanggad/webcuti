@extends('template')

@section('title', '- Form Konfirmasi Pengajuan Cuti')

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

        @if (Request::segment(3) != 'create')
            <!-- .row -->
            <div class="row">
                <div class="col-sm-12">
                    <div class="white-box">
                        <h3 class="box-title m-b-0">Form Konfirmasi Pengajuan Cuti Diluar Cuti Tahunan</h3>
                        <hr>
                        <form class="form" action="/pejabat-struktural/cuti-non-tahunan/{{ Request::segment(3) }}"
                            method="post">
                            @csrf
                            @method('PUT')
                            <div class="form-group row">
                                <label for="example-text-input" class="col-2 col-form-label">Nama Karyawan</label>
                                <div class="col-10">
                                    <input class="form-control" type="text" value="{{ $cuti_non->nama_pegawai }}"
                                        id="example-text-input" readonly>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="example-email-input" class="col-2 col-form-label">Lama Cuti</label>
                                <div class="col-10">
                                    <input class="form-control" type="text" value="{{ $cuti_non->lama_cuti }}"
                                        id="example-email-input" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="example-text-input" class="col-2 col-form-label">Keterangan</label>
                                <div class="col-10">
                                    <input class="form-control" type="text" value="{{ $cuti_non->keterangan }}"
                                        id="example-text-input" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="example-email-input" class="col-2 col-form-label">Status</label>
                                <div class="col-10">
                                    <select name="status" class="form-control" id="status-select" required>
                                        <option value="verifikasi">verifikasi</option>
                                        <option value="disetujui">disetujui</option>
                                        <option value="ditolak">ditolak</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="cuti_diterima" class="col-2 col-form-label">Cuti Diterima</label>
                                <div class="col-10">
                                    <input class="form-control" type="number" value="{{ $cuti_non->cuti_diterima }}"
                                        name="cuti_diterima" min="0" id="cuti_diterima">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="example-email-input" class="col-2 col-form-label">Catatan</label>
                                <div class="col-10">
                                    <input class="form-control" name="catatan" type="text"
                                        value="{{ $cuti_non->catatan }}" id="example-email-input">
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-12">

                                    <button class="btn btn-primary btn-block" type="submit">Update</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- /.row -->
        @endif

    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const statusSelect = document.getElementById('status-select');
            const cutiDiterimaInput = document.getElementById('cuti_diterima');

            function toggleCutiDiterima() {
                if (statusSelect.value === 'ditolak') {
                    cutiDiterimaInput.value =
                    0; // Atau gunakan null jika ingin kosong: cutiDiterimaInput.value = null;
                    cutiDiterimaInput.disabled = true;
                } else {
                    cutiDiterimaInput.disabled = false;
                }
            }

            statusSelect.addEventListener('change', toggleCutiDiterima);

            // Initial check in case the page loads with "ditolak" already selected
            toggleCutiDiterima();
        });
    </script>
@endsection
