@extends('admin.shared.main')
@section('title')
    Cập nhật
@endsection
@section('content')
<div class="content_yield">
	{{ Form::open(['route'=>['product.update',$product->id],'method'=>'put','enctype '=>'multipart/form-data','class' => 'col-md-12 row']) }}
	<div class="col-md-12 m-auto">
		<h3 class="mb-5 font-weight-bold">Sản phẩm</h3>
		<div class="col-lg-10 col-md-12 col-sm-12 row">
			<div class="form-group">
				{{ Form::label('Tên sản phẩm: ','',['class' => 'font-weight-bold']) }}
				{!! Form::text('name', $product->name, [
				'class' => 'form-control',
				'placeholder'=>"Tên sản phẩm"
				])
				!!}
				<span class="text-danger">{{ $errors->first('name')}}</span>
			</div>
			<div class="form-group">
				<b>{{ Form::label('Sản phẩm: ')}}</b>
				{{ Form::checkbox('is_new', null, $product->is_new == 1 ? true : false,['id'=>'is_new'])}}
				{{ Form::label('New')}}

				{{ Form::checkbox('is_hot', null, $product->is_hot == 1 ? true : false,['id'=>'is_hot'])}}
				{{ Form::label('Hot')}}
			</div>
			<div class="form-group">
				{{ Form::label('Code: ','',['class' => 'font-weight-bold']) }}
				{!! Form::text('code',$product->code, [
				'class' => 'form-control',
				'readonly'=>'readonly',
				'placeholder'=>"Code"
				])
				!!}
				<span class="text-danger">{{ $errors->first('code')}}</span>
			</div>
			<div class="form-group">
				{{ Form::label('Mô tả: ','',['class' => 'font-weight-bold']) }}
				{!! Form::textarea('description', $product->description, [
				'class' => 'form-control','id'=>'editor1',
				'placeholder'=>"Description"
				])
				!!}
				<span class="text-danger">{{ $errors->first('description')}}</span>
			</div>

			<div class="form-group">
				{{ Form::label('Chi tiết: ','',['class' => 'font-weight-bold']) }}
				{!! Form::textarea('detail', $product->detail, [
				'class' => 'form-control',
				'rows' => '5',
				'placeholder'=>"Chi tiết"
				])
				!!}
				<span class="text-danger">{{ $errors->first('detail')}}</span>
			</div>
			<div class="form-group">
				{{ Form::label('Hình ảnh: ','',['class' => 'font-weight-bold']) }}
				{{ Form::file('url_image', ['class' => 'form-control' ]) }}
				<input type="hidden" value="{{$product->url_image}}" name="image"><br>
				<span class="text-danger">{{ $errors->first('url_image')}}</span>
			</div>
			<div class="form-group">
				{{ Form::label('Giá: ','',['class' => 'font-weight-bold']) }}
				{!! Form::number('price', $product->price, [
				'class' => 'form-control','onKeyPress'=>'return isNumberKey(event)',
				'placeholder'=>"Giá"
				])
				!!}
				<span class="text-danger">{{ $errors->first('price')}}</span>
			</div>
			<div class="form-group">
				{{ Form::label('Giá khuyến mãi: ','',['class' => 'font-weight-bold']) }}
				{!! Form::number('promotion_price', $product->promotion_price, [
				'class' => 'form-control','onKeyPress'=>'return isNumberKey(event)',
				'placeholder'=>"Giá khuyến mãi"
				])
				!!}
				<span class="text-danger">{{ $errors->first('promotion_price')}}</span>
			</div>
			<div class="form-group">
				{{ Form::label('Số lượng: ','',['class' => 'font-weight-bold']) }}
				{!! Form::number('quantity', $product->quantity, [
				'class' => 'form-control','onKeyPress'=>'return isNumberKey(event)',
				'placeholder'=>"Số lượng"
				])
				!!}
				<span class="text-danger">{{ $errors->first('quantity')}}</span>
			</div>
			<div class="form-group">
				{{ Form::label('Nhãn hiệu: ','',['class' => 'font-weight-bold']) }}
				{{ Form::select('brand_id', $brands, $product->brand_id,['class' => 'form-control','placeholder'=>"Chọn nhãn hiệu"]) }}

				<span class="text-danger">{{ $errors->first('brand_id')}}</span>
			</div>
			<div class="form-group">
				{{ Form::label('Thể loại: ','',['class' => 'font-weight-bold']) }}
				{{ Form::select('category_id', $categories, $product->category_id,['class' => 'form-control','placeholder'=>"Chọn thể loại"]) }}

				<span class="text-danger">{{ $errors->first('category_id')}}</span>
			</div>
			<div class="form-group text-right">
				<a class="btn btn-info mt-3" href="{{ route('product.index') }}" title="back"><i class="fas fa-arrow-left"></i> Xem danh sách</a>
				{{ Form::submit('Lưu',['class' => 'font-weight-bold text-white btn bg-color-green mt-3']) }}
			</div>
		</div>
	</div>
	{{ Form::close() }}
</div>
<script language='javascript'>
 function isNumberKey(evt)
 {
 	var charCode = (evt.which) ? evt.which : event.keyCode
 	if (charCode > 31 && (charCode < 48 || charCode > 57))
 		return false;
 		return true;
 }
 </script>
<script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
<script> CKEDITOR.replace('editor1'); </script>
@endsection
