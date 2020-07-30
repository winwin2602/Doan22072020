<!-- Start Main Top -->
<div class="main-top">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <div class="text-slid-box">
                    <div id="offer-box" class="carouselTicker">
                        <ul class="offer-box">
                            <li>
                                <i class="fab fa-opencart"></i> {{trans('message.Sales Off 10%! Laptop Dell')}} 
                            </li>
                            <li>
                                <i class="fab fa-opencart"></i>{{trans('message.Sales 50% - 80% Combo keyboard')}} 
                            </li>
                            <li>
                                <i class="fab fa-opencart"></i>{{trans('message.off Mouse')}} 
                            </li>
                            <li>
                                <i class="fab fa-opencart"></i>{{trans('message.Off 50%!  buy Laptop Acer')}}
                            </li>
                            <li>
                                <i class="fab fa-opencart"></i>{{trans('message.Off 10%! buy Laptop Macbook')}} 
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <div class="right-phone-box">
                    <p>{{trans('message.call us')}}: <a href="#"> +(84) 0384443449</a></p>
                </div>
                <div class="custom-select-box">
                    <button>
                        <a href="{{ route('lang',['lang' => 'vi']) }}">VI</a>
                    </button>
                    <button>
                        <a href="{{ route('lang',['lang' => 'en' ]) }}">EN</a>
                    </button>
                </div>
                <div class="our-link">
                    <ul>
                        @if(Auth::check())
                            <li><a class="trigger-btn" href="#">{{ Auth::user()->name }}</a></li>
                            <li>
                                <a class="trigger-btn" href="{{ route('client.logout') }}">
                                    {{ __('Logout') }}
                                </a>
                            </li>
                            <form id="logout-form" action="{{ route('client.logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        @else
                            <li><a href="{{ url('/login') }}">{{trans('message.login')}}</a></li>
                            <li><a href="{{ url('/register') }}">{{trans('message.register')}}</a></li>
                        @endif
                    </ul>
                </div>
                    
        </div>
    </div>
    <!-- Start Side Menu -->
        <div class="side">
            <a href="#" class="close-side"><i class="fa fa-times"></i></a>
            <li class="cart-box">
                <ul class="cart-list">
                    @if(session('cart'))
                    <p style="display: none">{{$totalAmount = 0}}</p>
                    @foreach(session('cart') as $key => $item)
                    <p style="display: none;">{{$totalAmount += $item['quantity'] * $item['price']}}</p>
                    <li>
                        <a href="#" class="photo"><img src="{{asset('images/'.$item['image'])}}" class="cart-thumb" alt="" /></a>
                        <h6><a href="#">{{Illuminate\Support\Str::limit($item['name'], 15)}} </a></h6>
                        <p>{{$item['quantity']}}x - <span class="price">{{$item['price']}}</span></p>
                    </li>
                    <li class="total text-right">
                        <span><strong>{{trans('message.Total amount')}}</strong>: ${{$item['quantity'] * $item['price']}}</span>
                    </li>

                    @endforeach
                    @else
                        <h5 class="text-danger text-center" style="padding-top: 10px;">{{trans('message.Cart is empty')}}</h5>
                    @endif
                    <li class="total">
                        <a href="{{ url('/cart-page') }}" class="btn btn-default hvr-hover btn-cart">{{trans('message.VIEW CART')}}</a>
                        <span class="float-right"><h4>{{trans('message.Total')}}: ${{$totalAmount ?? 0}}</h4></span>
                    </li>
                </ul>
            </li>
        </div>
        <!-- End Side Menu -->
</div>
</div>
<!-- End Main Top -->
<!-- Start Main Top -->
<header class="main-header">
    <!-- Start Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light navbar-default bootsnav">
        <div class="container">
            <!-- Start Header Navigation -->
            <div class="navbar-header">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-menu" aria-controls="navbars-rs-food" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fa fa-bars"></i>
                </button>
                <a class="navbar-brand" href="{{ url('/home') }}"><img src="{{asset('front_assets/images/logo.png')}}" class="logo" alt=""></a>
            </div>
            <!-- End Header Navigation -->
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="navbar-menu">
                <ul class="nav navbar-nav ml-auto wuc-menu" data-in="fadeInDown" data-out="fadeOutUp">
                    <li class="menu_head nav-item active"><a class="nav-link" href="{{ url('/home') }}">{{trans('message.home')}}</a></li>
                    <li class="dropdown megamenu-fw">
                        <a href="{{ url('/product-all') }}" class="nav-link">{{trans('message.product')}}</a>
                    </li>
                    <li class="nav-item"><a class="nav-link" href="{{ url('/about-us') }}">{{trans('message.about us')}}</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ url('/contact-us') }}">{{trans('message.Contact Us')}}</a></li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
            <!-- Start Atribute Navigation -->
            <div class="attr-nav">
                <ul>
                    <li class="search"><a href="#"><i class="fa fa-search"></i></a></li>
                    <li class="side-menu"><a href="#" id="call_cart_js">
                        <i class="fa fa-shopping-bag"></i>
                        <span class="badge text-danger">{{session()->has('cart') ? count(session('cart')) : 0}}</span>
                    </a></li>
                    <li class="wuc-phone">
                        <a href="tel:1900636648" title="Điện thoại tư vấn" class="nph-phone"> <span class="ico fa fa-mobile"></span> <span class="val">1900 636 638</span> </a>
                    </li>
                </ul>

            </div>
            <!-- End Atribute Navigation -->
        </div>
    </nav>
    <!-- End Navigation -->
</header>
<!-- End Main Top -->
<!-- Start Top Search -->
<div class="top-search">
    <div class="container">
        <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-search"></i></span>
            <input type="text" class="form-control" placeholder="Search">
            <span class="input-group-addon close-search"><i class="fa fa-times"></i></span>
        </div>
    </div>
</div>
<!-- End Top Search -->