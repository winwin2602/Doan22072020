@extends('admin.shared.main')
@section('title')
    Chi tiết đơn hàng
@endsection
@section('content')
    <div class="content_yield">
        <div class="row">
            <h3 class="col-md-8 page_title">Chi tiết đơn hàng</h3>
            <div class="col-md-4">
                @if(Session::has('message'))
                    <div id="div-alert" style="position:absolute; right: 10px;" class="float-right mt-2 alert alert-success alert-dismissible show" role="alert" style="position: absolute;">
                        <strong>{{ Session::get('message') }}</strong>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @elseif(Session::has('err'))
                    <div id="div-alert" style="position:absolute; right: 10px;" class="float-right mt-2 alert alert-success alert-dismissible show" role="alert" style="position: absolute;">
                        <strong>{{ Session::get('err') }}</strong>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
            </div>

        </div>

        <table class="table table_xk table-hover table-bordered">
            <thead class="thead_green">
            <tr>
                <th class="text-center">STT</th>
                <th class="text-center">Tên sản phẩm</th>
                <th class="text-center">Hình ảnh</th>
                <th class="text-center">Số lượng</th>
                <th class="text-center">Giá</th>
                <th class="text-center">Thành tiền</th>
            </tr>
            </thead>
            <tbody>
            <p style="display: none;">{{$total_amount = 0}}</p>
            @foreach($order_details as $key => $item)
                <p style="display: none;">{{$total_amount += $item->quantity * ($item->products->promotion_price ?? $item->products->price)}}
                </p>
                <tr>
                    <td class="text-center">{{++$key}}</td>
                    <td class="text-center">{{$item->products->name}}</td>
                    <td class="text-center"><img src="{{asset('images/'.$item->products->url_image)}}" width="50" height="50"></td>
                    <td class="text-center">{{$item->quantity}}</td>
                    <td class="text-center">${{$item->products->promotion_price ?? $item->products->price}}</td>
                    <td class="text-center">${{$item->quantity * ($item->products->promotion_price ?? $item->products->price)}}</td>
                </tr>
            @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="5" class="text-right">Tổng thành tiền</td>
                    <td colspan="1" class="text-center">${{$total_amount}}</td>
                </tr>
            </tfoot>
        </table>
    </div>
@endsection
