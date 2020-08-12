<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>@yield('title')</title>
	<!-- jQuery -->
	<script type="text/javascript" src="{{asset('js/jquery-3.5.1.min.js')}}"></script>
	<!-- Boostrap Js -->
	<script type="text/javascript" src="{{asset('admin/js/bootstrap.min.js')}}"></script>
	<!-- Custom Js -->
	<script type="text/javascript" src="{{asset('admin/js/custom.js')}}"></script>
	<!-- Bootstrap Css -->
	<link rel="stylesheet" href="{{asset('admin/css/bootstrap.min.css')}}">
	<!-- Font awesome -->
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.13.0/css/all.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<!-- Font Family -->
	<link href="https://fonts.googleapis.com/css2?family=Raleway&display=swap" rel="stylesheet">
	<!-- Style Css -->
	<link rel="stylesheet" href="{{asset('admin/css/style.css')}}">
	<!-- Responsive Css -->
	<link rel="stylesheet" href="{{asset('admin/css/responsive.css')}}">
</head>
<body>
	<!-- Page -->
	<div id="admin_layout">
		<!-- Sidebar -->
		@include('admin.shared.sidebar')
		<!-- End Sidebar -->

		<!-- Content -->
		<div class="content">
			<!-- NavBar -->
			@include('admin.shared.header')
			<!-- End NavBar -->
			<!-- Content Area -->
			<div class="container">
				<!-- Yield content -->
				@yield('content')
				<!-- End Yield content -->
			</div>
			<!-- End Content Area -->
		</div>
		<!-- End Content -->
	</div>
</body>
</html>
