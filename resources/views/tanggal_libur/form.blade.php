<form
    action="{{ isset($tanggal_libur) ? route('tanggal_libur.update', $tanggal_libur->id) : route('tanggal_libur.store') }}"
    method="POST">

    @csrf

    @if(isset($tanggal_libur))
    @method('PUT')
    @endif




    <div class="mb-3">
        <label for="tanggal_start" class="form-label">Tanggal Start</label>
        <input type="date" class="form-control @error('tanggal_start') is-invalid @enderror" id="tanggal_start"
            name="tanggal_start"
            value="{{old('tanggal_start', isset($tanggal_libur) ? $tanggal_libur->tanggal_start : null)}}"
            placeholder="Tanggal Start">
        @error('tanggal_start') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="mb-3">
        <label for="tanggal_end" class="form-label">Tanggal End</label>
        <input type="date" class="form-control @error('tanggal_end') is-invalid @enderror" id="tanggal_end"
            name="tanggal_end"
            value="{{old('tanggal_end', isset($tanggal_libur) ? $tanggal_libur->tanggal_end : null)}}"
            placeholder="Tanggal End">
        @error('tanggal_end') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="mb-3">
        <label for="dalam_rangka" class="form-label">Dalam Rangka</label>
        <input type="text" class="form-control @error('dalam_rangka') is-invalid @enderror" id="dalam_rangka"
            name="dalam_rangka"
            value="{{old('dalam_rangka', isset($tanggal_libur) ? $tanggal_libur->dalam_rangka : null)}}"
            placeholder="Dalam Rangka">
        @error('dalam_rangka') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>


    <div class="mb-3">
        <label for="catatan" class="form-label">Catatan</label>
        <textarea type="text" class="form-control @error('catatan') is-invalid @enderror" id="catatan" name="catatan"
            placeholder="Catatan">{{old('catatan', isset($tanggal_libur) ? $tanggal_libur->catatan : null)}}</textarea>
        @error('catatan') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>




    <div class="d-flex justify-content-between">
        <a href="{{route('tanggal_libur.index')}}" class="btn btn-secondary"><i class="fa fa-times"></i> Batal</a>
        <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Submit</button>
    </div>
</form>