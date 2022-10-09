@extends('layouts.app')

@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-md-8 col-lg-6 mx-auto">
            <div class="page-title-box">
                <h4 class="page-title">{{ __('Ubah Hari & Jam Kerja') }}</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item">
                            <a href="javascript: void(0);">Hari & Jam Kerja</a>
                        </li>
                        <li class="breadcrumb-item active">
                            {{ __('Edit') }}
                        </li>
                    </ol>
                </div>
            </div>

            <div class="card">

                <div class="card-body">
                    @include('hari_jam_kerja.form', ['hari_jam_kerja' => $hari_jam_kerja])
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