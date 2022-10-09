<form action="{{ isset($bidang) ? route('bidang.update', $bidang->id) : route('bidang.store') }}" method="POST">

    @csrf

    @if (isset($bidang))
        @method('PUT')
    @endif


    <div class="mb-3">
        <label for="nm_bidang" class="form-label">Nama Bidang</label>
        <input type="text" class="form-control @error('nm_bidang') is-invalid @enderror" id="nm_bidang" name="nm_bidang"
            value="{{ old('nm_bidang', isset($bidang) ? $bidang->nm_bidang : null) }}" placeholder="Nama Bidang">
        @error('nm_bidang')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="singkatan" class="form-label">Singkatan</label>
        <input type="text" class="form-control @error('singkatan') is-invalid @enderror" id="singkatan"
            name="singkatan" value="{{ old('singkatan', isset($bidang) ? $bidang->singkatan : null) }}"
            placeholder="Singkatan">
        @error('singkatan')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror

    </div>



    <div class="d-flex justify-content-between">
        <a href="{{ route('bidang.index') }}" class="btn btn-secondary"><i class="fa fa-times"></i> Batal</a>
        <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Submit</button>
    </div>
</form>
