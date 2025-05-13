@extends('layouts.master')
@section('title', 'Data Anggota Expired')

@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('adm-assets/css/vendors/datatables.css') }}">
@endsection

@section('style')
@endsection

@section('breadcrumb-title')
    <h3>Data Anggota</h3>
@endsection

@section('breadcrumb-items')
    <li class="breadcrumb-item">Data Anggota</li>
    <li class="breadcrumb-item active">Anggota Expired</li>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <!-- Zero Configuration  Starts-->
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="display" id="datatable">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>NPWP</th>
                                        <th>Layanan</th>
                                        <th>No. HP</th>
                                        <th>Provinsi</th>
                                        <th>Status</th>
                                        <th>#</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Zero Configuration  Ends-->
        </div>
    </div>
    <!-- /Row -->
@endsection

@section('script')
    <script src="{{ asset('adm-assets/js/datatable/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('adm-assets/js/datatable/datatables/datatable.custom.js') }}"></script>
    <script>
        $(document).ready(function() {
            var table = $('#datatable').DataTable({
                "lengthMenu": [
                    [25, 50, 75, 100],
                    [25, 50, 75, 100]
                ],
                "processing": true,
                "serverSide": true,
                "deferRender": true,
                "ajax": {
                    "url": "{{ route('register-anggota.dataJson') }}",
                    "type": "POST",
                    "data": {
                        "_token": "{{ csrf_token() }}",
                        'category': 'overdue'
                    },
                    "dataType": "JSON"
                },
                order: [
                    [0, "desc"]
                ],
                "columns": [{
                        "data": "i"
                    },
                    {
                        "data": "fullname"
                    },
                    {
                        "data": "npwp",
                        "class": "weight-600 txt-dark"
                    },
                    {
                        "data": "layanan",
                        "class": "weight-600 txt-primary"
                    },
                    {
                        "data": "phone",
                        "class": "weight-600 txt-primary"
                    },
                    {
                        "data": "provinsi_nama",
                        "searchable": false,
                        "orderable": false
                    },
                    {
                        "data": "status",
                        "searchable": false,
                        "orderable": false
                    },
                    {
                        "data": "action",
                        "searchable": false,
                        "orderable": false
                    }
                ]

            });

            table.on('draw.dt', function() {
                var info = table.page.info();
                table.column(0, {
                    search: 'applied',
                    order: 'applied',
                    page: 'applied'
                }).nodes().each(function(cell, i) {
                    cell.innerHTML = i + 1 + info.start;
                });
            });
        });
    </script>
@endsection
