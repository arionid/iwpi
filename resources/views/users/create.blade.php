@extends('layouts.master')
@section('title', 'Add User')

@section('css')
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/select2.css')}}">
@endsection

@section('style')
@endsection

@section('breadcrumb-title')
<h3>Add User</h3>
@endsection

@section('breadcrumb-items')
<li class="breadcrumb-item">Management User</li>
<li class="breadcrumb-item active">Add User</li>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row justify-content-md-center">
        <div class="col-sm-8">
            <div class="card">
                <div class="card-header">
                    <h5>Form Add User</h5>
                </div>
                <div class="card-body add-post">
                    <form method="POST" action="{{ route('management-user.store') }}">
                        @csrf
                        <div class="row mb-3">
                            <label for="inputNama" class="col-sm-2 col-form-label">Nama Lengkap <span
                                    class="text-danger">*</span></label>
                            <div class="col-sm-10">
                                <input type="text" name="name"
                                        class="form-control  @error('name') is-invalid @enderror"
                                        value="{{ old('name') }}" id="inputNama" required autofocus>
                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="inputEmail" class="col-sm-2 col-form-label">Email <span
                                    class="text-danger">*</span></label>
                            <div class="col-sm-10">
                                <input type="email" name="email"
                                    class="form-control  @error('email') is-invalid @enderror"
                                    value="{{ old('email') }}" id="inputEmail" required>
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="password" class="col-sm-2 col-form-label">Password <span
                                    class="text-danger">*</span></label>
                            <div class="col-sm-10">
                                <input type="password" name="password"
                                    class="form-control  @error('password') is-invalid @enderror"
                                    value="{{ old('password') }}" id="password">
                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror

                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="password" class="col-sm-2 col-form-label">Confirm Password <span
                                    class="text-danger">*</span></label>
                            <div class="col-sm-10">
                                <input type="password" name="password_confirmation"
                                    class="form-control  @error('password') is-invalid @enderror"
                                    value="{{ old('password') }}" id="password">
                                @error('password_confirmation')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror

                            </div>
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
