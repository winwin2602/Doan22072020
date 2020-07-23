@extends('client.shared.master')
@section('content')
<!-- Start About Page  -->
<div class="about-box-main">
	<div class="container">
		<div class="row">
			<div class="col-lg-6">
				<h2 class="noo-sh-title">{{trans('message.We are')}} <span>AEShop</span></h2>
				<p>"{{trans('message.Sed ut')}}
				</p>
			</div>
			<div class="col-lg-6">
				<div class="banner-frame"> <img class="img-thumbnail img-fluid" src="{{asset('front_assets/images/about-img.jpg')}}" alt="" />
				</div>
			</div>
		</div>
		<!--  -->
		<div class="row my-4">
            <div class="col-12">
               	<h2 class="noo-sh-title">{{trans('message.Meet Our Team')}}</h2>
            </div>
        </div>
        <!--  -->
        <div class="col-sm-6 col-lg-3">
        	<div class="hover-team">
        		<div class="our-team"> <img src="{{asset('front_assets/images/img-1.jpg')}}" alt="" />
        			<div class="team-content">
        				<h3 class="title">Nguyễn Phúc Hội</h3> <span class="post">{{trans('message.Web Developer')}}</span> </div>
        				<ul class="social">
        					<li>
        						<a href="#" class="fab fa-facebook"></a>
        					</li>
        					<li>
        						<a href="#" class="fab fa-google-plus"></a>
        					</li>
        				</ul>
        				<div class="icon"> <i class="fa fa-plus" aria-hidden="true"></i> </div>
        			</div>
        		<div class="team-description">
        				<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent urna diam, maximus ut ullamcorper quis, placerat id eros. Duis semper justo sed condimentum rutrum. Nunc tristique purus turpis. Maecenas vulputate. </p>
        		</div>
        	<hr class="my-0"> </div>
        </div>
        <!--  -->
		
	</div>
</div>
<!-- End About Page -->									
@endsection