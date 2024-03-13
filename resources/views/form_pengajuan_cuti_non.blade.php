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
                <form class="form" action="/{{ Session('user')['role'] }}/store-pengajuan-non" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group row">
                        <label for="example-email-input" class="col-2 col-form-label">Tanggal Awal </label>
                        <div class="col-10">
                            <input class="form-control" name="tanggal_pengajuan" type="date" value="" id="example-email-input" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="example-email-input" class="col-2 col-form-label">Tanggal Akhir </label>
                        <div class="col-10">
                            <input class="form-control" name="tanggal_akhir" type="date" value="" id="example-email-input" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="example-email-input" class="col-2 col-form-label">Lama Cuti</label>
                        <div class="col-10">
                            <input class="form-control" name="lama_cuti" type="number" min="1" value="1" id="lama_cuti" required readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="example-email-input" class="col-2 col-form-label">Keterangan</label>
                        <div class="col-10">
                           <select name="keterangan" class="form-control" id="keterangan" required>
                            @foreach ($urgensi_cuti as $list_urgensi)
                                <option value="{{ $list_urgensi->id }}">{{ $list_urgensi->nama }}</option>
                            @endforeach

                            </select>
                        </div>
                    </div>
                          {{-- <option>Cuti sakit dengan surat keterangan dokter</option>
                                <option>Cuti bersalin</option>
                                <option>Cuti gugur kandungan dengan surat keterangan dokter</option>
                                <option>Cuti melangsungkan pernikahan (3 hari)</option>
                                <option>Mengkhitankan anak (2 hari)</option>
                                <option>Membaptis anak (2 hari)</option>
                                <option>Menikahkan anak (2 hari)</option>
                                <option>Ibu/Bapak, Istri/Suami, anak, kakak/adik, mertua/menantu menderita sakit keras atau istri gugur kandungan (2 hari)</option>
                                <option>Ibu/Bapak, Istri/Suami, anak, kakak/adik, mertua/menantu meninggal dunia (2 hari)</option>
                                <option>Istri melahirkan (2 hari)</option>
                                <option>Menunaikan ibadah haji (45 hari)</option>
                                <option>Istirahat panjang selama 6 (enam) bulan</option> --}}
                    <div class="form-group row">
                        <label for="image" class="col-2 col-form-label">Lampiran</label>
                        <div class="col-10">
                            <input class="form-control" name="image" type="file" id="example-email-input">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="example-email-input" class="col-2 col-form-label">Ditujukan kepada</label>
                        <div class="col-10">
                           <select name="divisi" class="form-control" id="" required>
                            <option>Direktur Utama</option>
                            <option>Direktur Keuangan & Umum</option>
                            <option>General Manager Finance & HCGA</option>
                            <option>General Manager Operation & Maintenance</option>
                            <option>Finance Manager</option>
                            <option>Human Capital General Affair & Manager</option>
                            <option>Operation Manager</option>
                            <option>Maintenance Manager</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="image" class="col-2 col-form-label">Tanda Tangan</label>
                        <div class="col-10">
                            <input class="form-control" name="ttd_karyawan" type="file" id="example-email-input">
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
<script>
    document.getElementById('keterangan').addEventListener('change', function() {
        var selectedId = this.value;
        console.log(selectedId)
        if(selectedId) {
            fetch('/urgensi_cuti_detail/' + selectedId)
                .then(response => response.json())
                .then(data => {
                    if(data.success) {
                        console.log(data.data)
                        document.getElementById('lama_cuti').value = data.data.lama_cuti;
                    } else {
                        console.error('Data tidak ditemukan');
                    }
                })
                .catch(error => console.error('Error:', error));
        }
    });
</script>

@endsection
