@extends('template')

@section('title','- Manage Pengajuan Cuti')

@section('konten')
<div class="container-fluid">
    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">Manage Pengajuan Cuti Diluar Tahunan</h4>
        </div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            @if (Session::has('success'))
            <div class="alert alert-success alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                {{ Session::get('success') }}
            </div>
            @endif
            @if (Session::has('failed'))
            <div class="alert alert-danger alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                {{ Session::get('failed') }}
            </div>
            @endif
        </div>
        <!-- /.col-lg-12 -->
        <div class="col-md-12">
            @if ($role == 'karyawan' || $role == 'Karyawan')
            <a href="/karyawan/cuti-non-tahunan/create">
                <button class="btn btn-primary btn-block">Tambah</button>
            </a>
            @endif
        </div>
    </div>
    <!-- /row -->
    <div class="row">
        <div class="col-sm-12">
            <div class="white-box">
                <h3 class="box-title m-b-0">Data Pengajuan Cuti</h3>
                <div class="table-responsive">
                    <table id="myTable" class="table table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Karyawan</th>
                                <th>Tanggal Awal</th>
                                <th>Tanggal Akhir</th>
                                <th>Lama Cuti</th>
                                <th>Keterangan</th>
                                <th>Lampiran</th>
                                <th>Status</th>
                                <th>Verifikasi Oleh</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1 ?>
                            @foreach($cuti_non as $item)
                            <tr>
                                <td>{{$no}}</td>
                                <td>{{$item->nama_pegawai}}</td>
                                <td>{{$item->tanggal_pengajuan->translatedFormat('d M Y')}}</td>
                                <td>{{$item->tanggal_akhir->translatedFormat('d M Y')}}</td>
                                <td>{{$item->lama_cuti}} hari</td>
                                <td>{{$item->keterangan}}</td>
                                <td>
                                    <img src="{{asset('uploadnon/'.$item->image)}}"alt="" style="width: 50px" >
                                </td>
                                <td>{{$item->status}}</td>
                                <td>{{$item->verifikasi_oleh}}</td>
                                <th>
                                    @if (in_array($role,['Manager']))
                                    <a class="ml-auto mr-auto" href="/pejabat-struktural/cuti-non-tahunan/{{$item->id_cuti_non}}/edit">
                                        <button class="btn btn-warning ml-auto mr-auto">Edit</button>
                                    </a>
                                    @endif
                                    @if ($item->status == 'verifikasi')
    <form class="ml-auto mr-auto mt-3" method="POST" action="/{{ Session('user')['role'] . '/cuti-non-tahunan/' . $item->id_cuti_non }}">
        {{ csrf_field() }}
                      @method("DELETE")

        <button class="btn btn-danger ml-auto mr-auto">Deletes</button>
    </form>
@endif

                                    @if ($item->status == 'disetujui')
                                    @if (in_array($role,['admin']))
                                    <form class="ml-auto mr-auto mt-3" method="POST" action="/{{Session('user')['role'] }}/cuti-non-tahunan/{{$item->id_cuti_non}}">
                                        {{ csrf_field() }}
                                        {{ method_field('DELETE') }}

                                        <button class="btn btn-danger ml-auto mr-auto">Delete</button>
                                    </form>
                                    @endif
                                    @endif

                                    @if ($item->status == 'disetujui')
                                    @if (in_array($role,['karyawan']))
                                    <a class="ml-auto mr-auto"  target = "_blank" href="/@php Session('user')['role'] === "Karyawan" ? "karyawan" : Session('user')['role'] @endphp/print-non-tahunan/{{ $item->id_cuti_non}}">
                                        <button class="btn btn-success ml-auto mr-auto">Print</button>
                                    </a>
                                    @endif
                                    @endif
                                </th>
                            </tr>
                            <?php $no++ ?>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
</div>
<!-- /.row -->
@endsection
