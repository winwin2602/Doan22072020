@extends('client.shared.master')
@section('content')
@if(Session::has('message'))
    <div id="div-alert" class="float-right mt-2 alert alert-success alert-dismissible show" role="alert"
         style="position: fixed; top: 10px; right: 20px;">
        <strong>{{ Session::get('message') }}</strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@elseif(Session::has('err'))
    <div id="div-alert" style="position:fixed; right: 10px;" class="float-right mt-2 alert alert-danger alert-dismissible show" role="alert" style="position: absolute;">
        <strong>{{ Session::get('err') }}</strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif
<script>
    setTimeout(function() {
        var element = document.getElementById("div-alert");
        element.classList.add("fade");
    }, 2000)
</script>
 <div class="cart-box-main">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="table-main table-responsive">
                        <div class="wuc-boder">
                        	<table class="table">
                            <thead>
                                <tr>
                                    <th>{{trans('message.Images')}}</th>
                                    <th>{{trans('message.Product Name')}}</th>
                                    <th>{{trans('message.Price')}}</th>
                                    <th>{{trans('message.Quantity')}}</th>
                                    <th>{{trans('message.Total')}}</th>
                                    <th>{{trans('message.Remove')}}</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $total = 0 ?>
                                @if(session('cart'))
                                    @foreach(session('cart') as $key => $item)
                                        <tr>
                                            <td class="thumbnail-img">
                                                <a href="#">
                                                    <img class="img-fluid" src="{{asset('images/'.$item['image'])}}" alt="" />
                                                </a>
                                            </td>
                                            <td class="name-pr">
                                                <a href="#">{{$item['name']}}</a>
                                            </td>
                                            <td class="price-pr">
                                                <p>₫{{$item['price']}}</p>
                                            </td>
                                            <td class="quantity-box">
                                                <input type="number" size="4" name="quantity[]" value="{{$item['quantity']}}"
                                                       min="0" step="1" class="change_quantity c-input-text qty text"
                                                       id="product_quantity{{$item['id']}}" data-columns="{{$item['id']}}"
                                                        style="width: 80px;">
                                            </td>
                                            <td class="total-pr">
                                                <p>₫{{$item['price'] * $item['quantity']}}</p>
                                            </td>
                                            <td class="remove-pr">
                                                <button value="{{$item['id']}}" class="btn btn-danger btn-sm remove-from-cart" >
                                                    X
                                                </button>
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
                        </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row my-5">
                <div class="col-lg-6 col-sm-6">
                    <div class="coupon-box">
                        <div class="input-group input-group-sm">
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-sm-6">
                    <div class="update-box">
                        <a href="{{ url('/checkout') }}"><input value="{{trans('message.Check Out')}}" type="submit"></a>
                    </div>
                </div>
            </div>
        </div>
 </div>
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="exampleModalLabel">{{trans('message.Are you sure you want to remove product form cart')}}?</h4>
                </button>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn" data-dismiss="modal">{{trans('message.No')}}</button>
                <button type="button" class="btn btn-danger delete">{{trans('message.Yes')}}</button>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script_cart')
<script>
    $('.remove-from-cart').click(function(){
        $('#exampleModal').modal('show'); 
        $("#bodycontent").css({"padding-right": "0px" });
    });
    $(".remove-from-cart").click(function(e) {
        var id = $(this).val();
        $(".delete").click(function(){
            $.ajax({
                url: '{{ url('remove-from-cart') }}',
                method: "DELETE",
                data: {_token: '{{ csrf_token() }}', id: id},
                success: function (response) {
                    window.location.reload();
                }
            });
        });
    });

    $(".change_quantity").change(function(e){
        var id = this.dataset.columns;
        var quantity = parseInt($(this).val());
        if (quantity < 0 || quantity > 50 ) {
            alert('Quantity must be greater than 0 and less than 50');
        }else{
            $.ajax({
                url: '{{ url('update-cart') }}',
                method: "PATCH",
                data: {_token: '{{ csrf_token() }}', id: id, quantity: quantity},
                success: function (response) {
                    window.location.reload();
                }
            });
        }
    });
</script>
@endsection