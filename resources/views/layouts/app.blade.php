<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Department page</title>
    <!-- Google Font: Source Sans Pro -->
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
		<!-- Font Awesome -->
		<link rel="stylesheet" href="{{ asset('admin-assets/plugins/fontawesome-free/css/all.min.css')}}">
		<!-- Theme style -->
		<link rel="stylesheet" href="{{asset('admin-assets/css/adminlte.min.css')}}">

		<link rel="stylesheet" href="{{ asset('admin-assets/plugins/dropzone/min/dropzone.min.css') }}">

		<link rel="stylesheet" href="{{ asset('admin-assets/plugins/summernote/summernote.min.css') }}">

		<link rel="stylesheet" href="{{ asset('admin-assets/plugins/select2/css/select2.min.css') }}">

		<link rel="stylesheet" href="{{ asset('admin-assets/css/datetimepicker.css') }}">
		

		<link rel="stylesheet" href="{{ asset('admin-assets/css/custom.css')}}">

		<meta name="csrf-token" content="{{ csrf_token() }}">
  </head>
  <body>


	{{-- Main SEction --}}

    {{-- <div class="content-wrapper"> --}}

        @yield('content')

    {{-- </div> --}}


	{{-- End Main Section  --}}



    <!-- ./wrapper -->
		<!-- jQuery -->
		<script src="{{ asset('admin-assets/plugins/jquery/jquery.min.js') }}"></script>
		<!-- Bootstrap 4 -->
		<script src="{{ asset('admin-assets/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
		<!-- AdminLTE App -->
		<script src="{{ asset('admin-assets/js/adminlte.min.js')}}"></script>

		<script src="{{ asset('admin-assets/plugins/dropzone/min/dropzone.min.js') }}"></script>

		<script src="{{ asset('admin-assets/plugins/summernote/summernote.min.js') }}"></script>

		<script src="{{ asset('admin-assets/plugins/select2/js/select2.min.js') }}"></script>

		<script src="{{ asset('admin-assets/js/datetimepicker.js') }}"></script>



		<!-- AdminLTE for demo purposes -->
		<script src="{{ asset('admin-assets/js/demo.js')}}"></script>
    <script type="text/javascript">
      
		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}

		});

        $(document).ready(function(){
			$(".summernote").summernote({
				height:250
			});
		});
    </script>

@yield('customJs')
   
  </body>
  
</html>