@extends('layouts.master')
@section('title', 'Add Categories')

@section('css')
<link rel="stylesheet" type="text/css" href="{{asset('adm-assets/css/vendors/select2.css')}}">
@endsection

@section('style')
@endsection

@section('breadcrumb-title')
<h3>Add Categories</h3>
@endsection

@section('breadcrumb-items')
<li class="breadcrumb-item">Categories</li>
<li class="breadcrumb-item active">Add Categories</li>
@endsection

@section('content')
<div class="container-fluid">
	<div class="row">
	  <div class="col-sm-12">
		<div class="card">
		  <div class="card-header">
			<h5>Form Categories</h5>
		  </div>
		  <div class="card-body add-post">
			<form action="{{ route('categories.store') }}" method="POST" class="row" enctype="multipart/form-data" >
                <input type="hidden" name="model" value="Article">
                @csrf
			  <div class="col-sm-12">
				<div class="mb-3">
				  <label for="inpTitle">Name:</label>
				  <input name="name" class="form-control @error('title') is-invalid @enderror" id="inpTitle" type="text" placeholder="Post Title" required="" value="{{ old('title') }}" onload="convertToSlug(this.value)" onkeyup="convertToSlug(this.value)">
				</div>
				<div class="mb-3">
				  <label>Slug:</label>
				  <input name="slug" class="form-control @error('slug') is-invalid @enderror" id="slug_title" type="text" placeholder="Post Slug" required="" value="{{ old('slug') }}">
				</div>

                <div class="mb-3">
                    <label for="inpFeaturedImages">Image Icon:</label>
                    <input name="icon" class="form-control" id="inpFeaturedImages" type="file">
                    <small class="form-text text-muted" id="emailHelp">File Gambar yang di ijikan upload hanya file dengan extension <b>[.jpg, .jpeg, .png]</b> dengan ukuran file maksimal <b>2Mb</b></small>
                  </div>
			  </div>

			<div class="btn-showcase text-end">
			  <button class="btn btn-primary" type="submit">Post</button>
			  <input class="btn btn-light" type="reset" value="Discard">
			</div>

			</form>
		  </div>
		</div>
	  </div>
	</div>
  </div>
@endsection

@section('script')
<script>
  $("#inpTitle").keyup(function() {
  var str = $(this).val();
  str = str.replace(/[`~!@#$%^&*()_\-+=\[\]{};:'"\\|\/,.<>?\s]/g, ' ')
             .toLowerCase();
    // trim spaces at start and end of string
    str = str.replace(/^\s+|\s+$/gm,'');
    // replace space with dash/hyphen
    str = str.replace(/\s+/g, '-');
  $("#slug_title").val(str);
});
</script>
@endsection
