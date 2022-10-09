<?php 
use App\Models\Bidang;
?>
@extends('layouts.app')

@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <h4 class="page-title">{{ __('Presensi') }}</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item">
                            <a href="javascript: void(0);">Presensi</a>
                        </li>
                        <li class="breadcrumb-item active">
                            {{ __('Index') }}
                        </li>
                    </ol>
                </div>
            </div>

            <div class="card">

                <div class="card-body">

                    @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>Sukses</strong> {{session('success')}}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @endif
                    <div id="table-data-toolbar">
                        <form>
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
                                        <select class="form-select" id="bidang_id" name="bidang_id">
                                            <option value="">Semua Bidang</option>
                                            @foreach(Bidang::all() as $bidang)
                                            <option value="{{$bidang->id}}">{{$bidang->nama}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                            </div>


                        </form>
                    </div>
                    <table id="table-data"></table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection


@section('scripts')
<script>
    $(function(){

        $('#tanggal').on('change', function(){
            tableData.bootstrapTable('refresh');
        });

        $('#bidang_id').on('change', function(){
            tableData.bootstrapTable('refresh');
        });

            const tableConfig = {
                toolbar: "#table-data-toolbar",
                classes: "table table-striped table-no-bordered",
                search: true,
                showRefresh: true,
                iconsPrefix: "fa",
                // showToggle: true,
                // showColumns: true,
                // showExport: true,
                // showPaginationSwitch: true,
                pagination: true,
                pageList: [10, 25, 50, 100, "ALL"],
                showFooter: true,
                sidePagination: "server",
                url: "{{url('presensi/paginated')}}",
                queryParams: function(params){
                    params.tanggal = $('#tanggal').val();
                    params.bidang_id = $('#bidang_id').val();
                    return params;
                },
                columns: [
                {
                    field: "id",
                    title: "Action",
                    class: "text-nowrap",
                    formatter: function (id, row, index) {
                    var html = `
                        <a href="${baseURL}/presensi/${id}/edit" class="btn btn-sm btn-info btn-edit" href="#" ><i class="fa fa-edit"></i></a>
                        <a href="${baseURL}/presensi/${id}" data-data='${JSON.stringify(row)}' class="btn btn-sm btn-danger btn-delete" href="#" ><i class="fa fa-trash"></i></a>
                    `;

                    return html;
                    },
                },


                {field: 'pegawai.nama', title: 'Pegawai', sortable: true},
                {field: 'bidang.nama', title: 'Bidang', sortable: true},
                {field: 'checked_in_at', title: 'Checked in at', sortable: true},
                {field: 'checked_in_latitude', title: 'Checked in Latitude', sortable: true},
                {field: 'checked_in_longitude', title: 'Checked in Longitude', sortable: true},
                {field: 'checked_in_image_url', title: 'Checked in Image', formatter: function(value, row, index){
                    return `<image src="${value}" style="width: 100px;" />`
                }},
                {field: 'checked_out_at', title: 'Checked out at', sortable: true},
                {field: 'checked_out_latitude', title: 'Checked out Latitude', sortable: true},
                {field: 'checked_out_longitude', title: 'Checked out Longitude', sortable: true},
                {field: 'checked_out_image_url', title: 'Checked out Image', formatter: function(value, row, index){
                    return `<image src="${value}" style="width: 100px;" />`
                }},
                
                {
                    field: "created_at",
                    title: "Created at",
                    sortable: true,
                },
                {
                    field: "updated_at",
                    title: "Updated at",
                    sortable: true,
                },
                ],
            };
            var tableData = $("#table-data").bootstrapTable(tableConfig);
            $(document).on('click', '.btn-delete', function(e){
                e.preventDefault();
                const data = $(this).data('data');
                Swal.fire({
                    title: '<h4>Hapus Presensi</h4><hr />',
                    html: `<p>Apakah anda yakin ingin menghapus data <strong>${data.nama}</strong></p>`,
                    showCancelButton: true,
                    cancelButtonText: 'Batal',
                    confirmButtonText: 'Hapus',
                    customClass: {
                        confirmButton: 'btn btn-danger mx-1',
                        cancelButton: 'btn btn-secondary mx-1'
                    },
                    buttonsStyling: false,
                }).then((result) => {
                    /* Read more about isConfirmed, isDenied below */
                    if (result.isConfirmed) {
                        $.ajax({
                            url: `${baseURL}/presensi/${data.id}`,
                            type: 'DELETE',
                            success: function(result){
                                console.log(result);
                                if(result.status == true){
                                    tableData.bootstrapTable('refresh');
                                }
                            }
                        })
                    } 
                })
            });
            
            
        });
</script>
@endsection