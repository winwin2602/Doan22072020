@extends('admin.shared.main')
@section('title')
Add new order
@endsection
@section('content')
<div class="content_yield">
    {{ Form::open(['url' => 'admin/order', 'method' => 'post','enctype '=>'multipart/form-data','class' => 'col-md-12 row']) }}
    <div class="col-md-12 m-auto">
        <h3 class="mb-5 font-weight-bold">Orders</h3>
        <div class="col-lg-10 col-md-12 col-sm-12 row">
            <div class="form-group">
                {{ Form::label('Product Name: ','',['class' => 'font-weight-bold']) }}
                {!! Form::text('product Name', null, [
                    'class' => 'form-control',
                    'placeholder'=>"Product Name"
                ])
                !!}
                <span class="text-danger">{{ $errors->first('product Name')}}</span>
            </div>
            <div class="form-group">
                {{ Form::label('Quantity: ','',['class' => 'font-weight-bold']) }}
                {!! Form::text('quantity', null, [
                    'class' => 'form-control',
                    'placeholder'=>"Quantity"
                ])
                !!}
                <span class="text-danger">{{ $errors->first('quantity')}}</span>
            </div>
            <div class="form-group">
                {{ Form::label('Customer Name: ','',['class' => 'font-weight-bold']) }}
                {!! Form::text('customer', null, [
                    'class' => 'form-control',
                    'placeholder'=>"Customer Name"
                ])
                !!}
                <span class="text-danger">{{ $errors->first('customer')}}</span>
            </div>
            <div class="form-group">
                {{ Form::label('Order Status: ','',['class' => 'font-weight-bold']) }}
                {!! Form::text('order_status', null, [
                    'class' => 'form-control',
                    'placeholder'=>"Order Status"
                ])
                !!}
                <span class="text-danger">{{ $errors->first('order_status')}}</span>
            </div>

            <div class="form-group">
                {{ Form::label('Payment Status: ','',['class' => 'font-weight-bold']) }}
                {{ Form::text('payment_status', null, ['class' => 'form-control' ]) }}
                <br>
                <span class="text-danger">{{ $errors->first('Payment Status')}}</span>
            </div>
            <div class="form-group">
                {{ Form::label('Total: ','',['class' => 'font-weight-bold']) }}
                {{ Form::text('Total', null, ['class' => 'form-control' ]) }}
                <br>
                <span class="text-danger">{{ $errors->first('Total')}}</span>
            </div>

            <div class="form-group text-right">
                <a class="btn btn-info mt-3" href="{{ route('brand.index') }}" title="back"><i class="fas fa-arrow-left"> Back to list</i></a>
                {{ Form::submit('Save',['class' => 'font-weight-bold text-white btn bg-color-green mt-3']) }}
            </div>
        </div>
    </div>
    {{ Form::close() }}
</div>
@endsection
