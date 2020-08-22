@extends('client.shared.master')
@section('content')
<!-- Start About Page  -->
<div class="about-box-main">
	<div class="container">
		<div class="row">
			<div class="col-lg-6">
				<h2 class="noo-sh-title">{{trans('message.We are')}} <span>PANDAShop</span></h2>
				<p>"{{trans('message.Sed ut')}}
				</p>
			</div>
			<div class="col-lg-6">
				<div class="banner-frame"> <img class="img-thumbnail img-fluid" src="{{asset('front_assets/images/about-img.jpg')}}" alt="" />
				</div>
			</div>
		</div>			
	</div>
</div>
<!-- End About Page -->									
@endsection