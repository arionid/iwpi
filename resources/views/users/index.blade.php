@extends('layouts.master')
@section('title', 'Management User')

@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('adm-assets/css/vendors/datatables.css') }}">
@endsection

@section('style')
@endsection

@section('breadcrumb-title')
    <h3>Management User</h3>
@endsection

@section('breadcrumb-items')
    <li class="breadcrumb-item">Management User</li>
    <li class="breadcrumb-item active">List Management User</li>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <!-- Zero Configuration  Starts-->
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header pb-0 card-no-border">
                        <div class="header-top border-bottom pb-3">
                            <h5>Table Management User</h5>
                            <div class="card-header-right-icon create-right-btn"><a class="btn badge-light-primary f-w-500 f-12" href="{{ route('management-user.create') }}">Tambah +</a></div>
                          </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="display" id="basic-1">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @isset($data)
                                    @foreach ($data as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->email }}</td>
                                        <td>
                                            <ul class="action">
                                                <li class="edit"> <a href="{{ route('management-user.edit', $item->id) }}"><i class="icon-pencil-alt"></i></a>
                                                </li>
                                                <li class="delete"><a href="javascript:void(0);" onclick="formRemoveData({{ $item->id }});"><i class="icon-trash"></i></a></li>
                                            </ul>
                                        </td>
                                    </tr>
                                    @endforeach
                                    @else
                                    <tr>
                                        <td colspan="7">Data Management User is Empty</td>
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
@endsection

@section('script')
    <script src="{{ asset('adm-assets/js/datatable/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('adm-assets/js/datatable/datatables/datatable.custom.js') }}"></script>
    <script>
        function formRemoveData(dataid){
            $("#form-deleteData").attr('action', '{{ url('management-user') }}/'+dataid);
            if(confirm('Apakah anda yakin akan menghapus data ini?')) {
                $('#form-deleteData').submit();
            }
        }
    </script>
@endsection
