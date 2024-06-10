
 <!-- latest jquery-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
 <!-- Bootstrap js-->
<script src="{{asset('adm-assets/js/bootstrap/bootstrap.bundle.min.js')}}"></script>
<!-- feather icon js-->
<script src="{{asset('adm-assets/js/icons/feather-icon/feather.min.js')}}"></script>
<script src="{{asset('adm-assets/js/icons/feather-icon/feather-icon.js')}}"></script>
<!-- scrollbar js-->
<script src="{{asset('adm-assets/js/scrollbar/simplebar.js')}}"></script>
<script src="{{asset('adm-assets/js/scrollbar/custom.js')}}"></script>
<!-- Sidebar jquery-->
<script src="{{asset('adm-assets/js/config.js')}}"></script>
<script id="menu" src="{{asset('adm-assets/js/sidebar-menu.js')}}"></script>
<script src="{{asset('adm-assets/js/notify/bootstrap-notify.min.js')}}"></script>
@yield('script')


<!-- Plugins JS Ends-->
<script src="{{asset('adm-assets/js/script.js')}}"></script>
{{-- <script src="{{asset('assets/js/theme-customizer/customizer.js')}}"></script> --}}


{{-- @if(Route::current()->getName() == 'index')
	<script src="{{asset('assets/js/layout-change.js')}}"></script>
@endif --}}


{{-- @if(Route::currentRouteName() == 'home')
<script>
	new WOW().init();
</script>

@endif --}}
@if ($errors->any())
<script>

	$.notify({
	   title:'Notification',
	   message:'{{ implode(",", $errors->all()) }}'
	},
	{
	   type:'danger',
	   allow_dismiss:false,
	   newest_on_top:false ,
	   mouse_over:true,
	   showProgressbar:true,
	   spacing:10,
	   timer:4000,
	   placement:{
		 from:'bottom',
		 align:'center'
	   },
	   offset:{
		 x:30,
		 y:30
	   },
	   delay:1000 ,
	   z_index:10000,
	   animate:{
		 enter:'animated bounce',
		 exit:'animated bounce'
	 }
   });
</script>
@elseif($message = Session::get('success'))

<script>

	$.notify({
	   title:'Notification',
	   message:'{!! $message !!}'
	},
	{
	   type:'success',
	   allow_dismiss:false,
	   newest_on_top:false ,
	   mouse_over:true,
	   showProgressbar:true,
	   spacing:10,
	   timer:4000,
	   placement:{
		 from:'top',
		 align:'center'
	   },
	   offset:{
		 x:30,
		 y:30
	   },
	   delay:1000 ,
	   z_index:10000,
	   animate:{
		 enter:'animated bounce',
		 exit:'animated bounce'
	 }
   });
</script>
@endif
