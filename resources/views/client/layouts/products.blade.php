@extends('client.shared.master')
@section('content')
<body>
    <!-- Start All Title Box -->
    <div class="all-title-box">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h2>AEshop {{trans('message.slogin')}} 24/24</h2>
                    <h2>{{trans('message.Phone')}}: 0384443449</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('/home') }}">{{trans('message.Home')}}</a></li>
                        <li class="breadcrumb-item active">{{trans('message.Shop')}}</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- End All Title Box -->
    <!-- Start Shop Page  -->
    <div class="shop-box-inner">
        <div class="container">
            <div class="row">
            	<div class="col-xl-12 col-lg-12 col-sm-12 col-xs-12 sidebar-shop-left">
                 <div class="search-product">
                    <form action="{{url('product-all')}}" method="GET">
                        <input class="form-control" value="{{old('keyword')}}" name="keyword" placeholder="{{trans('message.Search')}}..." type="text">
                        <button type="submit"> <i class="fa fa-search"></i> </button>
                    </form>
                </div>
            </div>
            <div class="col-xl-3 col-lg-3 col-sm-12 col-xs-12 sidebar-shop-left">
                <div class="product-categories">
                    <div class="filter-sidebar-left">
                        <div class="title-left">
                            <h3>{{trans('message.cate')}}</h3>
                        </div>
                        <div class="list-group list-group-collapse list-group-sm list-group-tree" id="list-group-men" data-children=".sub-men">
                            @foreach($categories as $key => $item)
                            <a href="{{url('product-all?category_id='.$item->id)}}" class="list-group-item list-group-item-action">{{$item->name}}</a>
                            @endforeach
                        </div>
                    </div>
                    <div class="filter-brand-left">
                        <div class="title-left">
                            <h3>{{trans('message.brand')}}</h3>
                        </div>
                        <div class="brand-box">
                            @foreach($brands as $key => $item)
                            <a href="{{url('product-all?brand_id='.$item->id)}}" class="list-group-item list-group-item-action">{{$item->name}}</a>
                            @endforeach
                        </div>
                    </div>
                    <!-- start prices -->
                    <div class="filter-brand-left mt-2">
                        <div class="title-left">
                            <h3>Khoảng Giá</h3>
                        </div>
                        <div class="">
                            <div class="">
                                <div class="s">
                                    <form action="{{url('product-all')}}" method="GET">
                                        <input name='min_price' type="text" maxlength="13" class="s" placeholder="₫ TỪ" >
                                        <div class=""></div>
                                        <input name="max_price" type="text" maxlength="13" class="shopee-price-range-filter__input" placeholder="₫ ĐẾN" ></div></div>
                                        <button type="submit" class="">Áp dụng</button></div>
                                    </form>                                    
                                </div>
                                <!--  -->
                                <div class="filter-brand-left">
                                    <div class="baner-box">
                                        <img src="{{asset('/images/ban.jpg')}}">
                                    </div>
                                </div>
                                <!--  -->
                                <!--  -->
                            </div>
                        </div>
                        <div class="col-xl-9 col-lg-9 col-sm-12 col-xs-12 shop-content-right">
                            <div class="right-product-box">
                                <div class="row product-categorie-box">
                                    <div class="tab-content">
                                        <div role="tabpanel" class="tab-pane fade show active" id="grid-view">
                                            <div class="row">
                                                @foreach($products as $key => $item)
                                                <div class="col-sm-6 col-md-6 col-lg-4 col-xl-4">
                                                    <div class="products-single fix">
                                                        <div class="card">
                                                            <div class="box-img-hover">
                                                                <img src="{{asset('images/'.$item->url_image)}}" class="img-fluid" alt="Image">
                                                                <div class="mask-icon">
                                                                    <ul>
                                                                        <li><a href="{{url('/product-detail?id='.$item->id)}}" data-toggle="tooltip" data-placement="right" title="{{trans('message.View')}}"><i class="fas fa-eye"></i></a></li>
                                                                    </ul>
                                                                    <a class="cart" href="{{ url('/add-to-cart?product_id='.$item->id.'&quantity=1') }}">{{trans('message.Add to Cart')}}</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="why-text">
                                                            <h4>{{Illuminate\Support\Str::limit($item->name, 28)}}</h4>
                                                            @if($item->promotion_price != null)
                                                            <div>
                                                                <h5 style="float: left;padding-right: 10px;">{{$item->promotion_price}}₫ </h5>
                                                                <h5 class="text-secondary"><strike>₫{{$item->price}}</strike></h5>
                                                            </div>
                                                            @else
                                                            <h5>{{$item->price}}</h5>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Shop Page -->
            @endsection
