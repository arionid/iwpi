@extends('layouts.master')
@section('title', 'Add Post')

@section('css')
<link rel="stylesheet" type="text/css" href="{{asset('adm-assets/css/vendors/select2.css')}}">
@endsection

@section('style')
@endsection

@section('breadcrumb-title')
<h3>Add Post</h3>
@endsection

@section('breadcrumb-items')
<li class="breadcrumb-item">Blog</li>
<li class="breadcrumb-item active">Add Post</li>
@endsection

@section('content')
<div class="container-fluid">
	<div class="row">
	  <div class="col-sm-12">
		<div class="card">
		  <div class="card-header">
			<h5>Form Post</h5>
		  </div>
		  <div class="card-body add-post">
			<form action="{{ route('blog.store') }}" method="POST" class="row" enctype="multipart/form-data" >
                @csrf
			  <div class="col-sm-12">
				<div class="mb-3">
				  <label for="inpTitle">Title:</label>
				  <input name="title" class="form-control @error('title') is-invalid @enderror" id="inpTitle" type="text" placeholder="Post Title" required="" value="{{ old('title') }}" onload="convertToSlug(this.value)" onkeyup="convertToSlug(this.value)">
				</div>
				<div class="mb-3">
				  <label>Slug:</label>
				  <input name="slug" class="form-control @error('slug') is-invalid @enderror" id="slug_title" type="text" placeholder="Post Slug" required="" value="{{ old('slug') }}">
				</div>
				<div class="mb-3">
				  <label for="inpTitle">Excerpt:</label>
                  <textarea name="excerpt" class="form-control" cols="10" rows="3">{!! old('excerpt') !!}</textarea>
				</div>
				<div class="mb-3">
				  <label>Type:</label>
				  <div class="m-checkbox-inline">
					<label for="edo-ani">
					  <input name="type" class="radio_animated" id="edo-ani" type="radio" value="Standard" checked="">Standard
					</label>
					<label for="edo-ani1">
					  <input name="type" class="radio_animated" id="edo-ani1" type="radio" value="Images" disabled>Image
					</label>
					<label for="edo-ani2">
					  <input name="type" class="radio_animated" id="edo-ani2" type="radio" value="Audio" disabled>Audio
					</label>
					<label for="edo-ani3">
					  <input name="type" class="radio_animated" id="edo-ani3" type="radio" value="Video" disabled>Video
					</label>
				  </div>
				</div>
				<div class="mb-3">
				  <div class="col-form-label">Category:
					<select name="categories" class="form-control">
					  @foreach ($category as $item)
                          <option value="{{ $item->id }}">{{ $item->name }}</option>
                      @endforeach
					</select>
				  </div>
				</div>
				<div class="email-wrapper">
				  <div class="theme-form">
					<div class="mb-3">
					  <label>Content:</label>
					  <textarea name="content" id="text-box" name="text-box" cols="10" rows="2">{!! old('content') !!}</textarea>
                      @error('content')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
					</div>
				  </div>
				</div>
                <div class="mb-3">
                    <label for="inpFeaturedImages">Featured Image:</label>
                    <input name="featured_img" class="form-control" id="inpFeaturedImages" type="file" required>
                    <small class="form-text text-muted" id="emailHelp">File Gambar yang di ijikan upload hanya file dengan extension <b>[.jpg, .jpeg, .png]</b> dengan ukuran file maksimal <b>2Mb</b></small>
                  </div>
			  </div>
			{{-- <form class="dropzone" id="singleFileUpload" action="/upload.php">
			  <div class="m-0 dz-message needsclick"><i class="icon-cloud-up"></i>
				<h6 class="mb-0">Drop files here or click to upload.</h6>
			  </div>
			</form> --}}
            <hr class="mt-4 mb-4">
            <h6>SEO Manager</h6>
            <div class="mb-3">
              <label for="inpMetaTitle">Meta Title:</label>
              <input name="meta_title" class="form-control" id="inpMetaTitle" type="text" placeholder="Meta Title" value="{{ old('meta_title') }}">
            </div>
            <div class="mb-3">
              <label for="inpMetaDesc">Meta Description:</label>
              <input name="meta_description" class="form-control" id="inpMetaDesc" type="text" placeholder="Meta Description" value="{{ old('meta_description') }}">
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
<script src="{{asset('adm-assets/js/editor/ckeditor/ckeditor.js')}}"></script>
<script src="{{asset('adm-assets/js/editor/ckeditor/adapters/jquery.js')}}"></script>
<script src="{{asset('adm-assets/js/select2/select2.full.min.js')}}"></script>
<script src="{{asset('adm-assets/js/select2/select2-custom.js')}}"></script>
{{-- <script src="{{asset('adm-assets/js/form-validation-custom.js')}}"></script> --}}
<script>
    CKEDITOR.replace( 'text-box', {
    on: {
        contentDom: function( evt ) {
            // Allow custom context menu only with table elemnts.
            evt.editor.editable().on( 'contextmenu', function( contextEvent ) {
                var path = evt.editor.elementPath();

                if ( !path.contains( 'table' ) ) {
                    contextEvent.cancel();
                }
            }, null, null, 5 );
        },
        ckfinder: {
                uploadUrl: '{{route('ckeditor.upload').'?_token='.csrf_token()}}',
            }
    }
} );
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
