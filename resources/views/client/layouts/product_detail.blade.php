@extends('client.shared.master')
@section('content')
<!-- Start All Title Box -->
<div class="all-title-box">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h2>{{trans('message.Shop Detail')}}</h2>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">{{trans('message.Shop')}}</a></li>
                    <li class="breadcrumb-item active">{{trans('message.Shop Detail')}} </li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- End All Title Box -->

<!-- Start Shop Detail  -->
<div class="shop-detail-box-main">
    <div class="container">
        <div class="row">
            <div class="col-xl-5 col-lg-5 col-md-6">
                <div id="carousel-example-1" class="single-product-slider carousel slide" data-ride="carousel">
                    <div class="card">
                        <div class="carousel-inner" role="listbox">
                            <div class="carousel-item active">
                                <img class="d-block w-100" src="{{asset('images/'.$product->url_image)}}">
                            </div>
                            <div class="carousel-item"> <img class="d-block w-100" src="{{asset('images/'.$product->url_image)}}" alt="Second slide"> </div>
                            <div class="carousel-item"> <img class="d-block w-100" src="{{asset('images/'.$product->url_image)}}" alt="Third slide"> </div>
                        </div>

                        <a class="carousel-control-prev" href="#carousel-example-1" role="button" data-slide="prev">
                            <i class="fa fa-angle-left" aria-hidden="true"></i>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#carousel-example-1" role="button" data-slide="next">
                            <i class="fa fa-angle-right" aria-hidden="true"></i>
                            <span class="sr-only">Next</span>
                        </a>

                    </div>
                </div>
            </div>
            <div class="col-xl-7 col-lg-7 col-md-6">
                <div class="single-product-details">
                    <h2>{{$product->name}}</h2>
                    @if($product->promotion_price != null)
                    <h4> <strike class="text-secondary">${{$product->price}}</strike> ${{$product->promotion_price}}</h4>
                    @else
                    <h4>{{$product->price}}</h4>
                    @endif

                    <div class="row ml-0">
                        <a class="btn-sm btn-group btn-group-sm btn-info" data-toggle="tooltip" data-placement="top" title="Categorry Name" href="{{url('product-all?category_id='.$category->id)}}">{{$category->name}}</a>

                        <a class="btn-sm btn-group btn-group-sm btn-success ml-1
                        " data-toggle="tooltip" data-placement="top" title="Brand Name" href="{{url('product-all?brand_id='.$brand->id)}}">{{$brand->name}}</a>
                    </div>

                    <h4>{{trans('message.Short Description')}}:</h4>
                    <p>{{$product->detail}}</p>
                    <h4>{{trans('message.Detail')}}:</h4>
                    <p>{!! $product->description !!}</p>
                    <div class="price-box-bar">
                        <div class="cart-and-bay-btn">
                            @if($quantity > 0)
                                <a id="div-cart" class="btn hvr-hover " data-fancybox-close=""
                                   href="{{ url('/add-to-cart?product_id='.$product->id.'&quantity=1') }}">{{trans('message.Add to Cart')}}</a>
                                <span class="ml-3">Hàng còn: {{$quantity}}</span>
                            @else
                                <a id="div-cart" class="btn hvr-hover disabled" data-fancybox-close=""
                                   href="{{ url('/add-to-cart?product_id='.$product->id.'&quantity=1') }}">{{trans('message.Add to Cart')}}</a>
                                <span class="ml-3 text-danger">Hàng còn: {{$quantity}}</span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Cart -->

@endsection
