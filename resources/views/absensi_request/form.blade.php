<?php
use App\Models\Bidang;
use App\Models\Pegawai;
use App\Models\Golongan;
?>
<form
    action="{{ isset($absensi_request) ? route('absensi_request.update', $absensi_request->id) : route('absensi_request.store') }}"
    method="POST" enctype="multipart/form-data">

    @csrf

    @if (isset($absensi_request))
        @method('PUT')
    @endif

    <div class="mb-3">
        <label for="pegawai_id" class="form-label">Pegawai</label>
        <select class="form-control @error('pegawai_id') is-invalid @enderror" id="pegawai_id" name="pegawai_id"
            placeholder="Pegawai">
            @foreach (Pegawai::all() as $pegawai)
                <option
                    {{ old('pegawai_id', isset($absensi_request) ? $absensi_request->pegawai_id : null) == $pegawai->id
                        ? 'selected=""'
                        : '' }}
                    value="{{ $pegawai->id }}">{{ $pegawai->nip . ' - ' . $pegawai->nama }}</option>
            @endforeach
        </select>
        @error('pegawai_id')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>





    <div class="mb-3">
        <label for="type" class="form-label">Jenis Pengajuan Absensi</label>
        <select class="form-control @error('type') is-invalid @enderror" id="type" name="type"
            placeholder="Jenis Pengajuan Absensi">
            @foreach (config('app.absensi_request.type') as $key => $text)
                <option
                    {{ old('type', isset($absensi_request) ? $absensi_request->type : null) == $key ? 'selected=""' : '' }}
                    value="{{ $key }}">{{ $text }}</option>
            @endforeach
        </select>
        @error('type')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="keterangan" class="form-label">Keterangan</label>
        <textarea class="form-control @error('keterangan') is-invalid @enderror" id="keterangan" name="keterangan"
            placeholder="Keterangan">{{ old('keterangan', isset($absensi_request) ? $absensi_request->keterangan : date('Y-m-d')) }}</textarea>
        @error('keterangan')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="request_date" class="form-label">Tanggal Yang di Ajukan</label>
        <input type="date" class="form-control @error('request_date') is-invalid @enderror" id="request_date"
            name="request_date"
            value="{{ old('request_date', isset($absensi_request) ? $absensi_request->request_date : date('Y-m-d')) }}"
            placeholder="Tanggal Yang di Ajukan">
        @error('request_date')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3 d-flex justify-content-between">
        <div>
            <label for="attachment_file" class="form-label">File Pendukung</label>
            <div class="input-group w-100">
                <input type="file" class="form-control @error('attachment_file') is-invalid @enderror"
                    style="flex: 1" id="attachment_file" name="attachment_file" placeholder="File Pendukung">
                @if (isset($absensi_request) && $absensi_request->attachment_file)
                    <a target="_blank" href="{{ $absensi_request->attachment_file_url }}" class="btn btn-info"><i
                            class="fa fa-download"></i> Download/Lihat File Sebelumnya</a>
                @endif
            </div>
            @error('attachment_file')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

    </div>


    <div class="d-flex justify-content-between">
        <a href="{{ route('absensi_request.index') }}" class="btn btn-secondary"><i class="fa fa-times"></i> Batal</a>
        <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Submit</button>
    </div>
</form>


@section('scripts')
    <script></script>
@append
