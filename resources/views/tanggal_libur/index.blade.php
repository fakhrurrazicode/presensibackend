@extends('layouts.app')

@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <h4 class="page-title">{{ __('Tanggal Libur') }}</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item">
                            <a href="javascript: void(0);">Tanggal Libur</a>
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
                        <a href="{{route('tanggal_libur.create')}}" class="btn btn-primary btn-md"><i
                                class="fa fa-plus"></i>
                            Tambah Baru</a>
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
                url: "{{url('tanggal_libur/paginated')}}",
                columns: [
                {
                    field: "id",
                    title: "Action",
                    class: "text-nowrap",
                    formatter: function (id, row, index) {
                    var html = `
                        <a href="${baseURL}/tanggal_libur/${id}/edit" class="btn btn-sm btn-info btn-edit" href="#" ><i class="fa fa-edit"></i></a>
                        <a href="${baseURL}/tanggal_libur/${id}" data-data='${JSON.stringify(row)}' class="btn btn-sm btn-danger btn-delete" href="#" ><i class="fa fa-trash"></i></a>
                        `;

                    return html;
                    },
                },
                
                {field: 'tanggal_start', title: 'Tanggal', sortable: true, formatter: function(value, row, index) {
                    let html = '';
                    let tanggal_start = row.tanggal_start;
                    let tanggal_end = row.tanggal_end;
                    html += `${moment(tanggal_start).format('L')}`;
                    if(tanggal_end){
                        html += ` s/d ${moment(tanggal_end).format('L')}`;
                    }


                    return html;
                }},
                {field: 'dalam_rangka', title: 'Dalam Rangka', sortable: true,},
                {field: 'catatan', title: 'Catatan', sortable: true,},
                
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
                    title: '<h4>Hapus Tanggal Libur</h4><hr />',
                    html: `<p>Apakah anda yakin ingin menghapus data <strong>${data.dalam_rangka}</strong></p>`,
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
                            url: `${baseURL}/tanggal_libur/${data.id}`,
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