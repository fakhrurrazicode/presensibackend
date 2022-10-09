<form
    action="{{ isset($hari_jam_kerja) ? route('hari_jam_kerja.update', $hari_jam_kerja->id) : route('hari_jam_kerja.store') }}"
    method="POST">

    @csrf

    @if(isset($hari_jam_kerja))
    @method('PUT')
    @endif

    <div class="mb-3">
        <label for="hari_id" class="form-label">Hari ID</label>
        <input readonly="" type="text" class="form-control @error('hari_id') is-invalid @enderror" id="hari_id"
            name="hari_id" value="{{old('hari_id', isset($hari_jam_kerja) ? $hari_jam_kerja->hari_id : null)}}"
            placeholder="Kode">
        @error('hari_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="mb-3">
        <label for="nama_hari" class="form-label">Nama Hari</label>
        <input readonly="" type="text" class="form-control @error('nama_hari') is-invalid @enderror" id="nama_hari"
            name="nama_hari" value="{{old('nama_hari', isset($hari_jam_kerja) ? $hari_jam_kerja->nama_hari : null)}}"
            placeholder="Nama Hari">
        @error('nama_hari') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="mb-3">
        <label for="jam_masuk_start" class="form-label">Jam Masuk Start</label>
        <input type="time" class="form-control @error('jam_masuk_start') is-invalid @enderror" id="jam_masuk_start"
            name="jam_masuk_start"
            value="{{old('jam_masuk_start', isset($hari_jam_kerja) ? $hari_jam_kerja->jam_masuk_start : null)}}"
            placeholder="Jam Masuk Start">
        @error('jam_masuk_start') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="mb-3">
        <label for="jam_masuk_end" class="form-label">Jam Masuk End</label>
        <input type="time" class="form-control @error('jam_masuk_end') is-invalid @enderror" id="jam_masuk_end"
            name="jam_masuk_end"
            value="{{old('jam_masuk_end', isset($hari_jam_kerja) ? $hari_jam_kerja->jam_masuk_end : null)}}"
            placeholder="Jam Masuk End">
        @error('jam_masuk_end') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="mb-3">
        <label for="jam_keluar_start" class="form-label">Jam Keluar Start</label>
        <input type="time" class="form-control @error('jam_keluar_start') is-invalid @enderror" id="jam_keluar_start"
            name="jam_keluar_start"
            value="{{old('jam_keluar_start', isset($hari_jam_kerja) ? $hari_jam_kerja->jam_keluar_start : null)}}"
            placeholder="Jam Keluar Start">
        @error('jam_keluar_start') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="mb-3">
        <label for="jam_keluar_end" class="form-label">Jam Keluar End</label>
        <input type="time" class="form-control @error('jam_keluar_end') is-invalid @enderror" id="jam_keluar_end"
            name="jam_keluar_end"
            value="{{old('jam_keluar_end', isset($hari_jam_kerja) ? $hari_jam_kerja->jam_keluar_end : null)}}"
            placeholder="Jam Keluar End">
        @error('jam_keluar_end') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="mb-3 form-check">
        <input type="checkbox" class="form-check-input" id="libur" name="libur" value="1" {{ old('libur',
            isset($hari_jam_kerja) ? $hari_jam_kerja->libur : null) ? 'checked' : '' }}>
        <label class="form-check-label" for="libur">Hari Libur?</label>
    </div>




    <div class="d-flex justify-content-between">
        <a href="{{route('hari_jam_kerja.index')}}" class="btn btn-secondary"><i class="fa fa-times"></i> Batal</a>
        <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Submit</button>
    </div>
</form>