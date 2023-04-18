<!DOCTYPE html>
<html lang="en">
      
<head>
      <style type="text/css">
		table {
			border-style: double;
			border-width: 3px;
			border-color: white;
		}
		table tr .text2 {
			text-align: right;
			font-size: 13px;
            }
            table tr .text3 {
			text-align: right;
			font-size: 13px;
		}
		table tr .text {
			text-align: center;
			font-size: 13px;
		}
		table tr td {
			font-size: 13px;
		}
      </style>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <meta http-equiv="X-UA-Compatible" content="ie=edge">
      <title>Print Cuti Tahunan</title>
</head>
<body>
      <center>
		<table>
                  <tr>
                  <td><center><img src="{{URL::asset('plugins/images/jp.png')}}" width="210" height="90"></center></td>
                  </tr>
                  <tr>
				<td>
				<center>
					<font size="4">PERMOHONAN CUTI TAHUNAN KARYAWAN</font><br>
				</center>
				</td>
			</tr>
			<tr>
				<td colspan="2"><hr></td>
			</tr>
		
		</table>

		<br>
		<table width="720">
			<tr>
		       <td>
			       <font size="2">Yth.<br>HCGA <b>Manager</b><br>PT. Jasamarga Pandaan Tolo<br>Di tempat</font>
		       </td>
		    </tr>
		</table>
		<br>
		<table width="720">
			<tr>
		       <td>
			       <font size="2">Yang bertanda tangan di bawah ini :</font>
		       </td>
		    </tr>
		</table>
		</table>
		<table>
			<tr >
				<td>Nama</td>
				<td width="545">: <b>{{$pengajuan_cuti->nama_karyawan}}</b></td>
			</tr>
			<tr>
				<td>Jabatan</td>
				<td width="525">: <b>{{$pengajuan_cuti->posisi}}</b></td>
			</tr>
			<tr>
				<td>Unit Kerja</td>
				<td width="525">: <b>{{$pengajuan_cuti->unit}}</b></td>
			</tr>
                  <tr>
				<td>Tanggal Mulai Bekerja</td>
				<td width="100">: <b>{{$pengajuan_cuti->tanggal_lahir->format('d M Y')}}</b></td>
			</tr>
		</table>
		<table width="720">
			<tr>
		       <td>
			       <font size="2">Dengan ini mengajukan permohonan Cuti Tahunan sebagai berikut :</font>
		       </td>
		    </tr>
		</table>
		</table>
		<table>
			<tr >
				<td>Periode Cuti Tahunan</td>
				<td width="545">: <b>{{date('Y')}}</b></td>
			</tr>
			<tr>
				<td>Tanggal Pelaksanaan Cuti</td>
				<td width="525">: <b>{{$pengajuan_cuti->tanggal_pengajuan->format('d M Y')}}</b></td>
			</tr>
			<tr>
				<td>Lama Cuti</td>
				<td width="525">: <b>{{$pengajuan_cuti->lama_cuti}} Hari</b></td>
			</tr>
                  <tr>
				<td>Keterangan</td>
				<td width="100">: <b>{{$pengajuan_cuti->keterangan}}</b></td>
			</tr>
                  <tr>
				<td>Alamat</td>
				<td width="100">: <b>{{$pengajuan_cuti->alamat}}</b></td>
			</tr>
		</table>
		<table width="720">
			<tr>
		       <td>
			       <font size="2">Demikian surat permohonan cuti diajukan, atas perhatiannya diucapkan terima kasih.
</font>
		       </td>
		    </tr>
		</table>
		<br>
		<table width="625">
			<tr>
				<td width="430"><br><br><br><br></td>
				<td class="text" align="center"><br>Pandaan <br> Karyawan Yang Bersangkutan<br><br><br><br>{{$pengajuan_cuti->nama_karyawan}}</td>
			</tr>
	     </table>
	</center>
</body>
</html>