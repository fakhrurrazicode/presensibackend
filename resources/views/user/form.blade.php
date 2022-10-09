<form action="{{ isset($user) ? route('user.update', $user->id) : route('user.store') }}" method="POST">

    @csrf

    @if(isset($user))
    @method('PUT')
    @endif

    <div class="mb-3">
        <label for="email" class="form-label">Email address</label>
        <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email"
            value="{{old('email', isset($user) ? $user->email : null)}}" placeholder="Email Address">
        @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror

    </div>
    <div class="mb-3">
        <label for="email" class="form-label">Name</label>
        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name"
            value="{{old('name', isset($user) ? $user->name : null)}}" placeholder="Name">
        @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>




    @if(!isset($user))
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

    <div class="mb-3 form-check">
        <input type="checkbox" class="form-check-input" id="is_admin" name="is_admin" value="1" {{ old('is_admin',
            isset($user) ? $user->is_admin : null) ? 'checked' : '' }}>
        <label class="form-check-label" for="is_admin">is admin?</label>
    </div>

    <div class="d-flex justify-content-between">
        <a href="{{route('user.index')}}" class="btn btn-secondary"><i class="fa fa-times"></i> Batal</a>
        <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Submit</button>
    </div>
</form>