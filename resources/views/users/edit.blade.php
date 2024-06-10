@extends('layouts.master')
@section('title', 'Edit Categories')

@section('css')
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/select2.css')}}">
@endsection

@section('style')
<style>
    .img-thumbnail {
        height: 150px !important;
    }
</style>
@endsection

@section('breadcrumb-title')
<h3>Edit Categories</h3>
@endsection

@section('breadcrumb-items')
<li class="breadcrumb-item">Categories</li>
<li class="breadcrumb-item active">Edit Categories</li>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row justify-content-md-center">
        <div class="col-sm-8">
            <div class="card">
                <div class="card-header">
                    <h5>Edit Article {{ $data->title }}</h5>
                </div>
                <div class="card-body add-post">
                    <form method="POST" action="{{ route('management-user.update', $data->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row mb-3">
                            <label for="inputNama" class="col-sm-2 col-form-label">Nama Lengkap <span class="text-danger">*</span></label>
                            <div class="col-sm-10">
                                <input type="text" name="name" class="form-control  @error('name') is-invalid @enderror" value="{{ $data->name }}" id="inputNama" required autofocus>
                                @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="inputEmail" class="col-sm-2 col-form-label">Email <span class="text-danger">*</span></label>
                            <div class="col-sm-10">
                                <input type="email" name="email" class="form-control  @error('email') is-invalid @enderror" value="{{ $data->email }}" id="inputEmail" required>
                                @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-12 mb-3">
                                <input name="changepassword" type="checkbox" id="checkboxChangePassword" class="form-controll mt-3 text-primary">
                                <label class="form-check-label" for="checkboxChangePassword">
                                    Ganti Password
                                </label>
                            </div>
                            <label for="password" class="col-sm-2 col-form-label">Password <span class="text-danger">*</span></label>
                            <div class="col-sm-10">
                                <input type="password" name="password" class="form-control  @error('password') is-invalid @enderror" id="password" autocomplete="off" readonly>
                                @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                @enderror

                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="password" class="col-sm-2 col-form-label">Confirm Password <span class="text-danger">*</span></label>
                            <div class="col-sm-10">
                                <input type="password" name="password_confirmation" class="form-control  @error('password') is-invalid @enderror" value="{{ old('password') }}" id="confirm_password" readonly>
                                @error('password_confirmation')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                @enderror

                            </div>
                        </div>

                        <div class="col-12 pt-2 text-end">
                            <button class="btn btn-primary" type="submit">Submit Data</button>
                            <a href="javascript:void();" class="btn btn-light" onclick="history.back()">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script  type="text/javascript">
$(document).ready(function() {
    $("#checkboxChangePassword").click(function(){
        if($("#checkboxChangePassword").is(':checked')){
            $("#password").prop("readonly",false);
            $("#confirm_password").prop("readonly",false);
        }else{
            $("#password").prop("readonly",true);
            $("#confirm_password").prop("readonly",true);
        }
    });
});
</script>
@endsection
