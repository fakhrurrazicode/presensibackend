<style>
    *,
    *:before,
    *:after {
        -webkit-box-sizing: border-box;
        -moz-box-sizing: border-box;
        box-sizing: border-box;
    }
</style>

<div>
    <h3 style="margin: 0; padding: 0;">Rekapitulasi Presensi</h3>
    <h5 style="margin: 0; padding: 0;">Tanggal: {{date('d-m-Y', strtotime($tanggal))}}</h5>
</div>
<table border="1" style="width: 100%; font-size: 10px;" cellspacing="0">
    <thead>
        <tr>
            <th>NIP</th>
            <th>Nama</th>
            <th>Bidang</th>
            <th>Checked in at</th>
            <th>Checked in Image</th>
            <th>Checked out at</th>
            <th>Checked out Image</th>
            <th>Created at</th>
            <th>Updated at</th>
        </tr>
    </thead>
    <tbody>
        @foreach($list_presensi as $presensi)
        <tr>
            <td>{{$presensi->pegawai->nip}}</td>
            <td>{{$presensi->pegawai->nama}}</td>
            <td>{{$presensi->bidang->nama}}</td>
            <td>{{$presensi->checked_in_at}}</td>
            <td>
                @if($presensi->checked_in_image)
                <img src="{{public_path('/storage/' . $presensi->checked_in_image)}}" style="width: 150px;" alt="">
                @endif
            </td>
            <td>{{$presensi->checked_out_at}}</td>
            <td>
                @if($presensi->checked_out_image)
                <img src="{{public_path('/storage/' . $presensi->checked_out_image)}}" style="width: 150px;" alt="">
                @endif
            </td>
            <td>{{$presensi->created_at}}</td>
            <td>{{$presensi->updated_at}}</td>
        </tr>
        @endforeach
    </tbody>
</table>