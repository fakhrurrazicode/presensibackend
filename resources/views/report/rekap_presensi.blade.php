<?php 
use App\Models\Bidang;
?>
@extends('layouts.app')

@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-md-8 col-lg-6 mx-auto">
            <div class="page-title-box">
                <h4 class="page-title">{{ __('Rekapitulasi Presensi') }}</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item">
                            <a href="javascript: void(0);">Rekapitulasi Presensi</a>
                        </li>
                        <li class="breadcrumb-item active">
                            {{ __('Index') }}
                        </li>
                    </ol>
                </div>
            </div>

            <div class="card">

                <div class="card-body">
                    <form method="GET" action="{{route('report.rekap_presensi.generate')}}" target="_blank">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="mb-3">
                                    <label for="tanggal" class="form-label">Tanggal</label>
                                    <input type="date" class="form-control" id="tanggal" name="tanggal"
                                        value="{{date('Y-m-d')}}">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="mb-3">
                                    <label for="bidang_id" class="form-label">Bidang</label>
                                    <select class="form-control" id="bidang_id" name="bidang_id">
                                        <option value="">Semua Bidang</option>
                                        @foreach(Bidang::all() as $bidang)
                                        <option value="{{$bidang->id}}">{{$bidang->nama}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-end">
                            <button type="submit" class="ms-1 btn btn-danger" name="export_as_pdf">Export to
                                PDF</button>
                            <button type="submit" class="ms-1 btn btn-success" name="export_as_spreadsheet">Export to
                                Spreadsheet</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection