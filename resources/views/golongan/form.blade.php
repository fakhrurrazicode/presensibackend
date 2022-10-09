<form action="{{ isset($golongan) ? route('golongan.update', $golongan->id) : route('golongan.store') }}" method="POST">

    @csrf
    
    @if(isset($golongan))
        @method('PUT')
    @endif

    <div class="mb-3">
        <label for="golongan" class="form-label">Golongan</label>
        <input type="text" class="form-control @error('golongan') is-invalid @enderror" id="golongan" name="golongan" value="{{old('golongan', isset($golongan) ? $golongan->golongan : null)}}" placeholder="Golongan" >
        @error('golongan') <div class="invalid-feedback">{{ $message }}</div> @enderror

    </div>
    <div class="mb-3">
        <label for="nama_pangkat" class="form-label">Nama Pangkat</label>
        <input type="text" class="form-control @error('nama_pangkat') is-invalid @enderror" id="nama_pangkat" name="nama_pangkat" value="{{old('nama_pangkat', isset($golongan) ? $golongan->nama_pangkat : null)}}" placeholder="Nama Pangkat" >
        @error('nama_pangkat') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>



    <div class="d-flex justify-content-between">
        <a href="{{route('golongan.index')}}" class="btn btn-secondary"><i class="fa fa-times"></i> Batal</a>
        <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Submit</button>
    </div>
</form>