@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <h4 class="page-title">{{ __('Absensi Request') }}</h4>
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item">
                                <a href="javascript: void(0);">Absensi Request</a>
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
                                <strong>Sukses</strong> {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @endif
                        <div id="table-data-toolbar">
                            <a href="{{ route('absensi_request.create') }}" class="btn btn-primary btn-md"><i
                                    class="fa fa-plus"></i>
                                Tambah Baru</a>
                        </div>
                        <table id="table-data"></table>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="modal-approval" tabindex="-1" aria-labelledby="modal-approvalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <form class="modal-content" id="form-approval">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal-approvalLabel">Persetujuan Pengajuan Absensi</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <dl class="row">
                        <dt class="col-sm-3 text-end">NIP</dt>
                        <dd class="col-sm-9" id="dd-pegawai-nip">Lorem ipsum dolor sit amet consectetur adipisicing.</dd>

                        <dt class="col-sm-3 text-end">Nama</dt>
                        <dd class="col-sm-9" id="dd-pegawai-nama">Lorem ipsum dolor sit amet consectetur adipisicing.</dd>

                        <dt class="col-sm-3 text-end">Kode Bidang</dt>
                        <dd class="col-sm-9" id="dd-bidang-kode">Lorem ipsum dolor sit amet consectetur adipisicing.</dd>

                        <dt class="col-sm-3 text-end">Nama Bidang</dt>
                        <dd class="col-sm-9" id="dd-bidang-nama">Lorem ipsum dolor sit amet consectetur adipisicing.</dd>

                        <hr>

                        <dt class="col-sm-3 text-end">Jenis Pengajuan Absensi</dt>
                        <dd class="col-sm-9" id="dd-ar-type">Lorem ipsum dolor sit amet consectetur adipisicing.</dd>

                        <dt class="col-sm-3 text-end">Pengajuan Untuk Tanggal</dt>
                        <dd class="col-sm-9" id="dd-ar-request-date">Lorem ipsum dolor sit amet consectetur adipisicing.
                        </dd>

                        <dt class="col-sm-3 text-end">Lampiran File Pendukung</dt>
                        <dd class="col-sm-9" id="dd-ar-attachment-file">Lorem ipsum dolor sit amet consectetur adipisicing.
                        </dd>

                        <hr>

                        <input type="hidden" name="id" id="id" value="">



                        <div class="mb-2 row">
                            <label for="approval" class="col-sm-3 col-form-label text-md-end">Persetujuan</label>
                            <div class="col-sm-9">
                                <div class="form-check form-check-inline pt-1">
                                    <input class="form-check-input" type="radio" name="approval" id="approval-true"
                                        value="1">
                                    <label class="form-check-label" for="approval-true"><span
                                            class="text-success">Setujui</span></label>
                                </div>
                                <div class="form-check form-check-inline pt-1">
                                    <input class="form-check-input" type="radio" name="approval" id="approval-false"
                                        value="0">
                                    <label class="form-check-label" for="approval-false"><span
                                            class="text-danger">Tolak</span></label>
                                </div>
                            </div>
                        </div>

                        <div class="mb-2 row" id="row-alasan-penolakan" style="display: none">
                            <label for="alasan_penolakan" class="col-sm-3 col-form-label text-md-end">Alasan
                                Penolakan</label>
                            <div class="col-sm-7">
                                <textarea class="form-control" name="alasan_penolakan" id="alasan_penolakan" cols="30" rows="5"></textarea>
                            </div>
                        </div>




                    </dl>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
@endsection


@section('scripts')
    <script>
        $(function() {
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
                url: "{{ url('absensi_request/paginated') }}",
                columns: [{
                        field: "id",
                        title: "Action",
                        class: "text-nowrap",
                        formatter: function(id, row, index) {
                            var html =
                                `<a href="${baseURL}/absensi_request/${id}/edit" class="btn btn-sm btn-info btn-edit" href="#" ><i class="fa fa-edit"></i></a> `;
                            html +=
                                `<a href="${baseURL}/absensi_request/${id}" data-data='${JSON.stringify(row)}' class="btn btn-sm btn-danger btn-delete" href="#" ><i class="fa fa-trash"></i></a> `;
                            if (row.approval === null) {
                                html +=
                                    `<a href="${baseURL}/absensi_request/${id}" data-data='${JSON.stringify(row)}' class="btn btn-sm btn-primary btn-approval" href="#" ><i class="fa fa-times text-danger"></i> <i class="fa fa-check text-success"></i> Persetujuan</a> `;
                            }



                            return html;
                        },
                    },


                    {
                        field: 'type',
                        title: 'Jenis Absensi Request',
                        sortable: true
                    },
                    {
                        field: 'request_date',
                        title: 'Untuk Tanggal',
                        sortable: true
                    },
                    {
                        field: 'approval',
                        title: 'Persetujuan',
                        sortable: true,
                        formatter: function(value, row, index) {
                            if (value === null) {
                                return '<span class="badge bg-warning">Belum setujui</span>'
                            } else {
                                if (value === 1) {
                                    return '<span class="badge bg-success">Disetujui</span>'
                                }

                                if (value === 0) {
                                    return '<span class="badge bg-danger">Ditolak</span>'
                                }
                            }
                        }
                    },
                    {
                        field: 'attachment_file',
                        title: 'Lampiran File Pendukung',
                        sortable: true,
                        formatter: function(value, row, index) {
                            // return row.attachment_file_url;
                            if (row.attachment_file_url) {
                                return `<a target="_blank"
                                                href="${row.attachment_file_url}"
                                                class="btn btn-info btn-xs" ><i class="fa fa-download"></i></a>`;
                            }
                            return '<i>Tidak ada file pendukung</i>';

                        }
                    },

                    {
                        field: 'pegawai.nip',
                        title: 'NIP',
                        sortable: true
                    },
                    {
                        field: 'pegawai.nama',
                        title: 'Nama',
                        sortable: true
                    },

                    {
                        field: 'bidang.kode',
                        title: 'Kode Bidang',
                        sortable: true
                    },
                    {
                        field: 'bidang.nama',
                        title: 'Nama Bidang',
                        sortable: true
                    },

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
            $(document).on('click', '.btn-delete', function(e) {
                e.preventDefault();
                const data = $(this).data('data');
                Swal.fire({
                    title: '<h4>Hapus Absensi Request</h4><hr />',
                    html: ` < p > Apakah anda yakin ingin menghapus data < strong > $ {
                                                        data.nama
                                                    } < /strong></p > `,
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
                            url: `
                                                $ {
                                                    baseURL
                                                }
                                                /absensi_request/$ {
                                                    data.id
                                                }
                                                `,
                            type: 'DELETE',
                            success: function(result) {
                                console.log(result);
                                if (result.status == true) {
                                    tableData.bootstrapTable('refresh');
                                }
                            }
                        })
                    }
                })
            });

            $(document).on('click', '.btn-approval', function(e) {
                e.preventDefault();
                const data = $(this).data('data');

                var form = $('#form-approval');

                form.find('#dd-pegawai-nip').html(data.pegawai.nip);
                form.find('#dd-pegawai-nama').html(data.pegawai.nama);
                form.find('#dd-bidang-kode').html(data.bidang.kode);
                form.find('#dd-bidang-nama').html(data.bidang.nama);
                form.find('#dd-ar-type').html(data.type);
                form.find('#dd-ar-request-date').html(data.request_date);
                form.find('#dd-ar-attachment-file').html(
                    `<a href="${data.attachment_file_url}"
                                                target="_blank"
                                                class="btn btn-info btn-md"><i class="fa fa-download"></i></a>`
                );

                form.find('#id').val(data.id);

                $('#modal-approval').modal('show');


            });

            $('#form-approval').on('submit', function(e) {
                e.preventDefault();

                var form = $('#form-approval');

                $.ajax({
                    type: 'POST',
                    url: baseURL + '/absensi_request/approval',
                    data: form.serialize(),
                    success: function(result) {
                        console.log(result);

                        form.trigger('reset');

                        $('#modal-approval').modal('hide');
                        tableData.bootstrapTable('refresh');
                    }
                });
            })


            $('input[type=radio][name=approval]').change(function() {
                if (this.value == '1') {
                    $('#row-alasan-penolakan').hide();
                    $('#alasan_penolakan').val('');
                } else if (this.value == '0') {
                    $('#row-alasan-penolakan').show();
                }
            });

        });
    </script>
@endsection
