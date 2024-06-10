@extends('layouts.master')
@section('title', 'Profile')

@section('css')
@endsection

@section('style')
@endsection

@section('breadcrumb-title')
    <h3>Profile</h3>
@endsection

@section('breadcrumb-items')
    <li class="breadcrumb-item">User Management</li>
    <li class="breadcrumb-item active">Profile</li>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-md-center">
            <!-- Zero Configuration  Starts-->
            <div class="col-sm-6">
                <div class="card">
                    <div class="card-header pb-0 card-no-border">
                        <h3>Profile {{ Auth::user()->name }}</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('myprofile.update',$user->id) }}" class="theme-form" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="mb-3 row">
                              <label class="col-sm-3 col-form-label" for="inputFullname">Fullname</label>
                              <div class="col-sm-9">
                                <input name="name" class="form-control" id="inputFullname" type="text" placeholder="Insert Fullname" value="{{ $user->name }}">
                              </div>
                            </div>
                            <div class="mb-3 row">
                              <label class="col-sm-3 col-form-label" for="inputEmail">Email</label>
                              <div class="col-sm-9">
                                <input name="email" class="form-control" id="inputEmail" type="email" placeholder="Email" value="{{ $user->email }}">
                              </div>
                            </div>

                            <div class="mb-3 row">
                                <div class="col-sm-12">
                                  <div class="mb-0">
                                    <div class="form-check form-check-inline checkbox checkbox-primary">
                                      <input class="form-check-input" id="inline-form-1" type="checkbox" value="1" name="change_password">
                                      <label class="form-check-label txt-primary" for="inline-form-1">Permintaan Ganti Password</label>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            <div id="formchangepassword" style="display: none;">
                                <div class="mb-3">
                                    <label class="col-form-label pt-0" for="oldPassword">Password Lama</label>
                                    <input name="password_old" class="form-control" id="oldPassword" type="password" placeholder="Password" autocomplete="false">
                                </div>
                                <div class="mb-3">
                                    <label class="col-form-label pt-0" for="newPassword">Password Baru</label>
                                    <input name="password" class="form-control" id="newPassword" type="password" placeholder="Password">
                                </div>
                                <div class="mb-3">
                                    <label class="col-form-label pt-0" for="passwordConfirm">Konfirmasi Password</label>
                                    <input name="password_confirmation" class="form-control" id="passwordConfirm" type="password" placeholder="Password">
                                </div>
                            </div>


                    </div>
                    <div class="card-footer text-end">
                        <button class="btn btn-primary">Update Profile</button>
                        <button class="btn btn-secondary">Cancel</button>
                      </div>

                    </form>
                </div>
            </div>
            <!-- Zero Configuration  Ends-->
        </div>
    </div>
    <!-- /Row -->
@endsection

@section('script')
    <script>
         $("#inline-form-1").change(function() {
        if($(this).prop('checked')) {
            $("#formchangepassword").show();  // checked
        } else {
            $("#formchangepassword").hide();  // unchecked
        }
    });
    </script>
@endsection
