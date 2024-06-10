@extends('layouts.master')
@section('title', 'Blog')

@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('adm-assets/css/vendors/datatables.css') }}">
@endsection

@section('style')
@endsection

@section('breadcrumb-title')
    <h3>Blog</h3>
@endsection

@section('breadcrumb-items')
    <li class="breadcrumb-item">Blog</li>
    <li class="breadcrumb-item active">List Article</li>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <!-- Zero Configuration  Starts-->
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header pb-0 card-no-border">
                        <h3>Table Article</h3>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="display" id="basic-1">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Title</th>
                                        <th>Categories</th>
                                        <th>Author</th>
                                        <th>Status</th>
                                        <th>Publish Date</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @isset($data)
                                    @foreach ($data as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->title }}</td>
                                        <td>{{ $item->categories }}</td>
                                        <td>{{ $item->author->name ?? 'system' }}</td>
                                        <td class="d-flex align-items-center">
                                            @if($item->status == 1)
                                                <i class="font-success" data-feather="check-circle"></i><span class="font-success p-l-5"> Publish</span>
                                            @else
                                                <i class="font-danger" data-feather="alert-triangle"></i><span class="font-danger p-l-5"> Draft</span>
                                            @endif
                                        </td>
                                        <td>{{ \Carbon\Carbon::parse($item->published_at)->format('F, d Y') }}</td>
                                        <td>
                                            <ul class="action">
                                                <li class="edit"> <a href="{{ route('blog.edit', $item->id) }}"><i class="icon-pencil-alt"></i></a>
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
@endsection

@section('script')
    <script src="{{ asset('adm-assets/js/datatable/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('adm-assets/js/datatable/datatables/datatable.custom.js') }}"></script>
    <script>
        function formRemoveData(dataid){
            $("#form-deleteData").attr('action', '{{ url('/adm/blog') }}/'+dataid);
            if(confirm('Apakah anda yakin akan menghapus data ini?')) {
                $('#form-deleteData').submit();
            }
        }
    </script>
@endsection
