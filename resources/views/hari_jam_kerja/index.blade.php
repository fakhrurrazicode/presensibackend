@extends('layouts.app')

@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <h4 class="page-title">{{ __('Hari Jam Kerja') }}</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item">
                            <a href="javascript: void(0);">Hari Jam Kerja</a>
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
                        {{-- <a href="{{route('hari_jam_kerja.create')}}" class="btn btn-primary btn-md"><i
                                class="fa fa-plus"></i>
                            Tambah Baru</a> --}}
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
                url: "{{url('hari_jam_kerja/paginated')}}",
                columns: [
                {
                    field: "id",
                    title: "Action",
                    class: "text-nowrap",
                    formatter: function (id, row, index) {
                    var html = `
                        <a href="${baseURL}/hari_jam_kerja/${id}/edit" class="btn btn-sm btn-info btn-edit" href="#" ><i class="fa fa-edit"></i></a>
                    `;

                    return html;
                    },
                },
                {
                    field: "hari_id",
                    title: "Hari ID",
                    sortable: true,
                },
                {
                    field: "nama_hari",
                    title: "Nama Hari",
                    sortable: true,
                },

                {field: 'jam_masuk_start', title: 'jam_masuk_start', sortable: true, },
                // {field: 'jam_masuk', title: 'jam_masuk', sortable: true, },
                {field: 'jam_masuk_end', title: 'jam_masuk_end', sortable: true, },

                {field: 'jam_keluar_start', title: 'jam_keluar_start', sortable: true, },
                // {field: 'jam_keluar', title: 'jam_keluar', sortable: true, },
                {field: 'jam_keluar_end', title: 'jam_keluar_end', sortable: true, },

                {field: 'libur', title: 'Libur', sortable: true, formatter: function(value, row, index){ return value ? '<i class="fa fa-check text-success">' : '<i class="fa fa-times text-danger">' } },

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
                    title: '<h4>Hapus Hari Jam Kerja</h4><hr />',
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
                            url: `${baseURL}/hari_jam_kerja/${data.id}`,
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