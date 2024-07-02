<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Halaman Dashboard Administrator IWPI">
    <meta name="author" content="nndproject">
    <meta name="robots" content="noindex">
    <meta name="googlebot" content="noindex">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('favicon/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon/favicon-16x16.png') }}">
    <link rel="manifest" href="{{ asset('favicon/site.webmanifest') }}">
    <link rel="mask-icon" href="{{ asset('favicon/safari-pinned-tab.svg') }}" color="#5bbad5">
    <meta name="msapplication-TileColor" content="#603cba">
    <meta name="theme-color" content="#ffffff">
     <title>@yield('title') - {{ config('app.name') }}</title>
    <!-- Google font-->
    <link href="https://fonts.googleapis.com/css?family=Rubik:400,400i,500,500i,700,700i&amp;display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,500,500i,700,700i,900&amp;display=swap" rel="stylesheet">

    @include('layouts.authentication.css')
    @yield('style')
  </head>
  <body>
    <!-- login page start-->
    @if ($message = Session::get('success'))
    <div class="alert alert-warning alert-dismissible fade show" role="alert"><i data-feather="bell"></i>
        <p>Success Notification ! {{ $message }}</p>
        <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    {{-- @elseif ($errors->any())
    <div class="alert alert-danger d-block alert-dismissible fade show" role="alert">
      <h5 class="alert-heading">PERINGATAN!</h5>
      <p>Pastikan seluruh data telah terisi dengan benar.</p>
      <hr>
      <ul class="list-group list-group-numbered">
        @foreach ($errors->all() as $error)
            <li class="alert-text">{{$error}}</li>
        @endforeach
      </ul>
      <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
    </div> --}}
    @endif
    @yield('content')

    <!-- latest jquery-->
    @include('layouts.authentication.script')
  </body>
</html>
