@extends('client.shared.master')
@section('content')
<div class="cart-box-main">
    <div class="container">
        <form class="row my-5 wuc-ph" action="{{url('payment')}}" method="get" >
            <div class="col-lg-3 col-sm-3 ">
                <h3 class="wuc-Customers font-weight-bold text-center text-info"> {{trans('message.Customer info')}}</h3>
                <div class="coupon-box">
                    <div class="d-flex">
                        <h4 class="font-weight-bold">{{trans('message.Full Name')}}:</h4>
                        <div class="ml-auto ">{{$customer->full_name}}</div>
                    </div>
                    <div class="d-flex">
                        <h4 class="font-weight-bold">{{trans('message.Address')}}:</h4>
                        <div class="ml-auto "> {{$customer->address}} </div>
                    </div>
                    <div class="d-flex">
                        <h4 class="font-weight-bold">{{trans('message.Phone No')}}:</h4>
                        <div class="ml-auto "> {{$customer->phone_no}} </div>
                    </div>
                    <div class="d-flex">
                        <h4 class="font-weight-bold">{{trans('message.Email')}}:</h4>
                        <div class="ml-auto "> {{$customer->email}} </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-sm-6">
                <div class="update-box">
                    <h3 class="wuc-Customers font-weight-bold text-center text-info">{{trans('message.ORDER SUMMARY')}}</h3>
                    <table class="table">
                        <thead>
                        <tr>
                            <th>{{trans('message.Images')}}</th>
                            <th>{{trans('message.Product Name')}}</th>
                            <th>{{trans('message.Price')}}</th>
                            <th>{{trans('message.Quantity')}}</th>
                            <th>{{trans('message.Total')}}</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $totalAmount = 0 ?>
                        @if(session('cart'))
                            @foreach(session('cart') as $key => $item)
                                <input type="hidden" name="product_id[]" value="{{$item['id']}}">
                                <input type="hidden" name="quantity[]" value="{{$item['quantity']}}">
                                <input type="hidden" name="price[]" value="{{$item['price']}}">
                                <p style="display: none">{{$totalAmount += $item['quantity'] * $item['price']}}</p>
                                <input type="hidden" name="total_amount" value="{{$totalAmount}}">
                                <tr>
                                    <td class="thumbnail-img">
                                        <a href="#">
                                            <img class="img-fluid" src="{{asset('images/'.$item['image'])}}" width="80" />
                                        </a>
                                    </td>
                                    <td class="name-pr">
                                        <a href="#">{{$item['name']}}</a>
                                    </td>
                                    <td class="price-pr">
                                        <p>${{$item['price']}}</p>
                                    </td>
                                    <td class="quantity-box">
                                        <p>{{$item['quantity']}}</p>
                                    </td>
                                    <td class="total-pr">
                                        <p>${{$item['price'] * $item['quantity']}}</p>
                                    </td>
                                </tr>
                            @endforeach
                            @else
                                <tr>
                                    <td colspan="6">
                                        <p class="text-danger text-center">{{trans('message.Cart is empty')}}</p>
                                    </td>
                                </tr>
                            @endif
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="4" class="text-right font-weight-bold">{{trans('message.Total amount')}}</td>
                                <td colspan="1">${{$totalAmount ?? 0}}</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
            <div class="col-lg-3 col-sm-3">
                <div class="update-box">
                    <h3 class="wuc-Customers font-weight-bold text-center text-info">{{trans('message.PAYMENT METHOD')}}</h3>
                    <input type="radio" name="payment_method" id="cod" value="1" checked/>
                    <label for="cod">{{trans('message.Cash')}}</label> <br>
                    <input type="radio" name="payment_method" id="momo" value="2"/>
                    <label for="momo">{{trans('message.Momo')}}</label>
                </div>
            </div>
            <div class="col-12 shopping-box">
                    <button type="submit" class="btn btn-success" style="float: right;">{{trans('message.Pay')}}</button>
                </div>
        </form>
    </div>
</div>

@endsection