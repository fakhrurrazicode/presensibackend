@extends('layouts.app')

@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-md-8 col-lg-6 mx-auto">
            <div class="page-title-box">
                <h4 class="page-title">{{ __('Tambah User') }}</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item">
                            <a href="javascript: void(0);">User</a>
                        </li>
                        <li class="breadcrumb-item active">
                            {{ __('Create') }}
                        </li>
                    </ol>
                </div>
            </div>

            <div class="card">

                <div class="card-body">
                    @include('user.form')
                </div>
            </div>
        </div>
    </div>
</div>

@endsection


@section('scripts')
<script>
    $(function(){
      
        });
</script>
@endsection