@extends('layouts.master')
@section('title', 'Data Pengaduan')

@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('adm-assets/css/vendors/datatables.css') }}">
@endsection

@section('style')
@endsection

@section('breadcrumb-title')
    <h3>Data Pengaduan</h3>
@endsection

@section('breadcrumb-items')
    <li class="breadcrumb-item">Data Pengaduan</li>
    <li class="breadcrumb-item active">List Pengaduan</li>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <!-- Zero Configuration  Starts-->
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header pb-0 card-no-border">
                        <h3>Table Pengaduan</h3>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="display" id="basic-1">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Jenis Pengaduan</th>
                                        <th>Kategori Terlapor</th>
                                        <th>Nama Terlapor</th>
                                        <th>Unit DJP</th>
                                        <th>Status</th>
                                        <th>Tgl Pelaporan</th>
                                        <th colspan="2">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @isset($data)
                                    @foreach ($data as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->jenis_pengaduan }}</td>
                                        <td>{{ $item->kategori }}</td>
                                        <td>{{ $item->fullname }}</td>
                                        <td>{{ $item->unit_djp }}</td>
                                        <td class="d-flex align-items-center">
                                            @if($item->status == 1)
                                                <i class="font-success" data-feather="check-circle"></i><span class="font-success p-l-5"> Publish</span>
                                            @else
                                                <i class="font-danger" data-feather="alert-triangle"></i><span class="font-danger p-l-5"> Unpublish</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if(\Carbon\Carbon::parse($item->created_at) >= \Carbon\Carbon::now()->subDays(2))
                                            {{ \Carbon\Carbon::parse($item->created_at)->diffForHumans() }}
                                            @else
                                            {{ \Carbon\Carbon::parse($item->created_at)->format('F, d Y H:i') }}
                                            @endif
                                        </td>
                                        <td>

                                            <div class="media-body text-end switch-sm">
                                                <label class="switch" data-container="body" data-bs-toggle="tooltip" data-bs-placement="top" title="Clik untuk mengganti status data laporan ini, publish/unpublish">
                                                  <input type="checkbox" onchange="changeStatus({{ $item->id }})" @if($item->status == 1) checked="" @endif><span class="switch-state"></span>
                                                </label>
                                              </div>
                                        </td>
                                        <td>
                                            <ul class="action">
                                                <li class="edit"> <a href="{{ route('pengaduan-yellow-page.show', $item->id) }}"><i class="icon-file"></i></a>
                                                </li>
                                                <li class="delete"><a href="javascript:void(0);" onclick="formRemoveData({{ $item->id }});"><i class="icon-trash"></i></a></li>
                                            </ul>
                                        </td>
                                    </tr>
                                    @endforeach
                                    @else
                                    <tr>
                                        <td colspan="7">Data Blog is Empty</td>
                                    </tr>
                                    @endisset

                                </tbody>
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

<form method='post' action='{{ route('pengaduan-yellow-page.publish-status') }}' id="form-changestatus">
    @csrf
    @method('post')
    <input type="hidden" name="id" id="dataPelapor" />
</form>

@endsection

@section('script')
    <script src="{{ asset('adm-assets/js/datatable/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('adm-assets/js/datatable/datatables/datatable.custom.js') }}"></script>
    <script src="{{ asset('adm-assets/js/tooltip-init.js') }}"></script>
    <script>
        function formRemoveData(dataid){
            $("#form-deleteData").attr('action', '{{ url('/adm/pengaduan-yellow-page') }}/'+dataid);
            if(confirm('Apakah anda yakin akan menghapus data ini?')) {
                $('#form-deleteData').submit();
            }
        }

        function changeStatus(dataid){
            if(confirm('Apakah anda yakin akan menampilkan data ini di website utama?')) {
                $('#dataPelapor').val(dataid);
                $('#form-changestatus').submit();
            }
        }
    </script>
@endsection
