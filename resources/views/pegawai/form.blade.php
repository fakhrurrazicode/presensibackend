<?php 
use App\Models\Bidang;
use App\Models\Golongan;
?>
<form action="{{ isset($pegawai) ? route('pegawai.update', $pegawai->id) : route('pegawai.store') }}" method="POST">

    @csrf

    @if(isset($pegawai))
    @method('PUT')
    @endif

    <div class="mb-3">
        <label for="nip" class="form-label">NIP</label>
        <input type="text" class="form-control @error('nip') is-invalid @enderror" id="nip" name="nip"
            value="{{old('nip', isset($pegawai) ? $pegawai->nip : null)}}" placeholder="NIP">
        @error('nip') <div class="invalid-feedback">{{ $message }}</div> @enderror

    </div>
    <div class="mb-3">
        <label for="nama" class="form-label">Nama</label>
        <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama" name="nama"
            value="{{old('nama', isset($pegawai) ? $pegawai->nama : null)}}" placeholder="Nama">
        @error('nama') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="mb-3">
        <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
        <select class="form-control @error('jenis_kelamin') is-invalid @enderror" id="jenis_kelamin"
            name="jenis_kelamin" placeholder="Jenis Kelamin">
            @foreach(config('app.jenis_kelamin') as $key => $jenis_kelamin)
            <option {{old('jenis_kelamin', isset($pegawai) ? $pegawai->jenis_kelamin : null) == $key ? 'selected=""' :
                ''}}
                value="{{$key}}">{{$jenis_kelamin}}</option>
            @endforeach
        </select>
        @error('jenis_kelamin') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="mb-3">
        <label for="tempat_lahir" class="form-label">Tempat Lahir</label>
        <input type="text" class="form-control @error('tempat_lahir') is-invalid @enderror" id="tempat_lahir"
            name="tempat_lahir" value="{{old('tempat_lahir', isset($pegawai) ? $pegawai->tempat_lahir : null)}}"
            placeholder="Tempat Lahir">
        @error('tempat_lahir') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="mb-3">
        <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
        <input type="date" class="form-control @error('tanggal_lahir') is-invalid @enderror" id="tanggal_lahir"
            name="tanggal_lahir" value="{{old('tanggal_lahir', isset($pegawai) ? $pegawai->tanggal_lahir : null)}}"
            placeholder="Tanggal Lahir">
        @error('tanggal_lahir') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>


    <div class="mb-3">
        <label for="golongan_id" class="form-label">Golongan</label>
        <select class="form-control @error('golongan_id') is-invalid @enderror" id="golongan_id" name="golongan_id"
            placeholder="Golongan">
            @foreach(Golongan::all() as $golongan)
            <option {{old('golongan_id', isset($pegawai) ? $pegawai->golongan_id : null) == $golongan->id ?
                'selected=""' :
                ''}}
                value="{{$golongan->id}}">{{$golongan->golongan . ' - '. $golongan->nama_pangkat}}</option>
            @endforeach
        </select>
        @error('golongan_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="mb-3">
        <label for="jabatan" class="form-label">Jabatan</label>
        <input type="text" class="form-control @error('jabatan') is-invalid @enderror" id="jabatan" name="jabatan"
            value="{{old('jabatan', isset($pegawai) ? $pegawai->jabatan : null)}}" placeholder="Jabatan">
        @error('jabatan') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="mb-3">
        <label for="bidang_id" class="form-label">Bidang</label>
        <select class="form-control @error('bidang_id') is-invalid @enderror" id="bidang_id" name="bidang_id"
            placeholder="Bidang">
            @foreach(Bidang::all() as $bidang)
            <option {{old('bidang_id', isset($pegawai) ? $pegawai->bidang_id : null) == $bidang->id ?
                'selected=""' :
                ''}}
                value="{{$bidang->id}}">{{$bidang->kode . ' - '. $bidang->nama}}</option>
            @endforeach
        </select>
        @error('bidang_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>


    <hr>

    <div class="mb-3">
        <label for="email" class="form-label">Email address</label>
        <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email"
            value="{{old('email', isset($pegawai->user) ? $pegawai->user->email : null)}}" placeholder="Email Address">
        @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror

    </div>




    @if(!isset($pegawai))
    <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <input type="password" class="form-control @error('password') is-invalid @enderror" id="password"
            name="password" placeholder="Password">
        @error('password') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>
    <div class="mb-3">
        <label for="password_confirmation" class="form-label">Password</label>
        <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror"
            id="password_confirmation" name="password_confirmation" placeholder="Password Confirmation">
        @error('password_confirmation') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>
    @endif



    <div class="d-flex justify-content-between">
        <a href="{{route('pegawai.index')}}" class="btn btn-secondary"><i class="fa fa-times"></i> Batal</a>
        <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Submit</button>
    </div>
</form>


@section('scripts')
<script>

</script>
@append