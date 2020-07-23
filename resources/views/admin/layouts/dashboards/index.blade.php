@extends('admin.shared.main')
@section('title')
weaShopOnline - Dashboard
@endsection
@section('content')
	<div class="content_yield">
		<h2 class="title">Dashboard</h2>
		<div class="col-xs-12 col-sm-4">
			<div class="total product_total">
				<div class="icon">
					<i class="fa fa-list"></i>
				</div>
				<div class="info">
					<h6>Total product</h6>
					<h3>{{$total_product}}</h3>
				</div>
			</div>
		</div>
		<div class="col-xs-12 col-sm-4">
			<div class="total customer_total">
				<div class="icon">
					<i class="fa fa-user"></i>
				</div>
				<div class="info">
					<h6>Total customer</h6>
					<h3>{{$total_customer}}</h3>
				</div>
			</div>
		</div>
		<div class="col-xs-12 col-sm-4">
			<div class="total revenue_total">
				<div class="icon">
					<i class="fa fa-cart-plus"></i>
				</div>
				<div class="info">
					<h6>Total order</h6>
					<h3>{{$total_order}}</h3>
				</div>
			</div>
		</div>
	</div>
@endsection