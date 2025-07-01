@extends('layouts.master')
@section('title', 'Tambah Data Menu Download')

@section('css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endsection

@section('style')
    <style>
        .select2 {
            width: 100% !important;
        }

        .select2-container .select2-selection--single {
            border-color: #ced4da;
        }
    </style>
@endsection

@section('breadcrumb-title')
    <h3>Tambah Data Menu Download</h3>
@endsection

@section('breadcrumb-items')
    <li class="breadcrumb-item">Menu Download</li>
    <li class="breadcrumb-item active">Tambah Data</li>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-md-center">
            <div class="col-sm-8">
                <div class="card">
                    <div class="card-header">
                        <h5>Form Tambah Data</h5>
                    </div>
                    <div class="card-body add-post">
                        <form method="POST" action="{{ route('menu-download.store') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Nama Dokumen<span class="text-danger fw-bold">*</span></label>

                                <div class="col-sm-10">
                                    <div class="form-group {{ $errors->has('nama') ? ' has-error' : '' }}">
                                        <input type="text" name="nama_file" placeholder="Masukkan Nama Dokumen" class="form-control fw-bold" value="{{ old('nama_file') }}" required>
                                        @if ($errors->has('nama_file'))
                                            <div class="invalid-feedback">{{ $errors->first('nama_file') }}</div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Unggah Dokumen<span class="text-danger fw-bold">*</span></label>
                                <div class="col-sm-10">
                                    <div class="form-group {{ $errors->has('dokumen') ? ' has-error' : '' }}">
                                        <input type="file" name="dokumen" class="form-control" required>
                                        <small class="form-text text-danger">File yang diijinkan
                                            adalah file dokumen dengan ekstensi [.pdf/.zip] dengan ukuran maksimal 10MB.</small>
                                        @if ($errors->has('dokumen'))
                                            <div class="invalid-feedback">{{ $errors->first('dokumen') }}</div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Deskripsi</label>
                                <div class="col-sm-10">
                                    <div class="form-group {{ $errors->has('deskripsi') ? ' has-error' : '' }}">
                                        <textarea name="deskripsi" class="form-control" rows="5"></textarea>
                                        @if ($errors->has('deskripsi'))
                                            <div class="invalid-feedback">{{ $errors->first('deskripsi') }}</div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-md-2 col-form-label py-2">Status<span class="text-danger fw-bold">*</span></label>
                                <div class="col-md-10 ps-3">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="status" value="1" id="statusPublish"
                                            @if (old('status') == '1') checked @endif>
                                        <label class="form-check-label" for="statusPublish">
                                            Publish
                                        </label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="status" value="0" id="statusUnpublish"
                                            @if (old('status') == '0') checked @endif>
                                        <label class="form-check-label" for="statusUnpublish">
                                            Unpublish
                                        </label>
                                    </div>
                                </div>
                                @if ($errors->has('status'))
                                    <div class="invalid-feedback">{{ $errors->first('status') }}</div>
                                @endif
                            </div>
                            <div class="col-12 pt-2 text-end">
                                <button class="btn btn-primary" type="submit">Submit Data</button>
                                <button class="btn btn-light" type="reset">Cancel</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{ asset('adm-assets/js/editor/ckeditor/ckeditor.js') }}"></script>
    <script src="{{ asset('adm-assets/js/editor/ckeditor/adapters/jquery.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            $('.select2').select2();
        });

        function removeOptions(selectbox, judul) {
            var i;
            for (i = selectbox.options.length - 1; i >= 0; i--) {
                selectbox.remove(i);
            }
        }
        $('#in_province_id').change(function() {
            var prov = document.getElementById("in_province_id").value;
            $.ajax({
                type: 'POST',
                url: "{{ config('nnd.link-online') . '/list-region' }}",
                data: {
                    "_token": "{{ csrf_token() }}",
                    "id": prov,
                    "category": 'regency'
                },
                success: function(data) {
                    select = document.getElementById('in_regency_id');
                    removeOptions(select, 'Pilih Kota/Kabupaten');
                    $.each(data, function(index, data) {
                        option = document.createElement('option');
                        option.value = data.kode;
                        option.text = data.nama;
                        select.selectedIndex = "0";
                        select.add(option);
                    });
                }
            });

            $("#in_regency_id").focus();
            $('#in_regency_id').prop('disabled', false);
            document.getElementById('in_regency_id').selectedIndex = "1";
        });
    </script>
@endsection
