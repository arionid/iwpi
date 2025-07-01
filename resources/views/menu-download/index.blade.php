@extends('layouts.master')
@section('title', 'Menu Download')

@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('adm-assets/css/vendors/datatables.css') }}">
@endsection

@section('style')
@endsection

@section('breadcrumb-title')
    <h3>Menu Download</h3>
@endsection

@section('breadcrumb-items')
    <li class="breadcrumb-item">Menu Download</li>
    <li class="breadcrumb-item active">List Data</li>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <!-- Zero Configuration  Starts-->
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="display" id="datatable1">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Nama Dokumen</th>
                                        <th>File Path</th>
                                        <th>Keterangan</th>
                                        <th>Status</th>
                                        <th>Created At</th>
                                        <th>#</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse  ($data as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $item->nama }}</td>
                                            <td>{{ '/' . $item->file }}</td>
                                            <td>{{ $item->jenis }}</td>
                                            <td class="d-flex align-items-center">
                                                @if ($item->status == 1)
                                                    <i class="font-success" data-feather="check-circle"></i><span class="font-success p-l-5"> Publish</span>
                                                @else
                                                    <i class="font-danger" data-feather="alert-triangle"></i><span class="font-danger p-l-5"> Unpublish</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if (\Carbon\Carbon::parse($item->created_at) >= \Carbon\Carbon::now()->subDays(2))
                                                    {{ \Carbon\Carbon::parse($item->created_at)->diffForHumans() }}
                                                @else
                                                    {{ \Carbon\Carbon::parse($item->created_at)->format('F, d Y H:i') }}
                                                @endif
                                            </td>
                                            <td>
                                                <ul class="action">
                                                    <li class="edit"> <a href="{{ route('menu-download.edit', $item->id) }}"><i class="icon-pencil"></i></a></li>
                                                    <li class="delete"><a href="javascript:void(0);" onclick="formRemoveData({{ $item->id }});"><i class="icon-trash"></i></a></li>
                                                </ul>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <th>-</th>
                                            <th>-</th>
                                            <th>-</th>
                                            <th>-</th>
                                            <th>-</th>
                                            <th>-</th>
                                            <th>-</th>
                                        </tr>
                                    @endforelse
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>#</th>
                                        <th>Nama Dokumen</th>
                                        <th>File Path</th>
                                        <th>Keterangan</th>
                                        <th>Status</th>
                                        <th>Created At</th>
                                        <th>#</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Zero Configuration  Ends-->
        </div>
    </div>
    <!-- /Row -->

    <form id="form-deleteData" action="#" method="POST">
        @csrf
        @method('DELETE')
        <input type="submit" value="submit" style="display: none;">
    </form>

@endsection

@section('script')
    <script src="{{ asset('adm-assets/js/datatable/datatables/jquery.dataTables.min.js') }}"></script>
    <script>
        function formRemoveData(dataid) {
            $("#form-deleteData").attr('action', '{{ url('/adm/menu-download') }}/' + dataid);
            if (confirm('Apakah anda yakin akan menghapus data ini?')) {
                $('#form-deleteData').submit();
            }
        }
        $(document).ready(function() {
            $('#datatable1').DataTable();
        });
    </script>
@endsection
