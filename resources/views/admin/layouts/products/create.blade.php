@extends('admin.shared.main')
@section('title')
Add new product
@endsection
@section('content')
<div class="content_yield">
	{{ Form::open(['route' => 'product.store', 'method' => 'post','enctype '=>'multipart/form-data','class' => 'col-md-12 row']) }}
	<div class="col-md-12 m-auto">
		<h3 class="mb-5 font-weight-bold">Product</h3>		
		<div class="col-lg-10 col-md-12 col-sm-12 row">
			<div class="form-group">
				{{ Form::label('Name: ','',['class' => 'font-weight-bold']) }}
				{!! Form::text('name', null, [
				'class' => 'form-control',
				'placeholder'=>"Name Product"
				])
				!!}
				<span class="text-danger">{{ $errors->first('name')}}</span>
			</div>
			<div class="form-group">
				<b>{{ Form::label('Product: ')}}</b>
				{{ Form::checkbox('is_new')}}
				{{ Form::label('New')}}

				{{ Form::checkbox('is_hot')}}
				{{ Form::label('Hot')}}
			</div>
			<div class="form-group">
				{{ Form::label('Code: ','',['class' => 'font-weight-bold']) }}
				{!! Form::text('code',uniqid(), [
				'class' => 'form-control',
				'readonly'=>'readonly',
				'placeholder'=>"Code"
				])
				!!}
				<span class="text-danger">{{ $errors->first('code')}}</span>
			</div>
			<div class="form-group">
				{{ Form::label('Description: ','',['class' => 'font-weight-bold']) }}
				{!! Form::textarea('description', null, [
				'class' => 'form-control',
				'id'=>'editor1',
				'placeholder'=>"Description"
				])
				!!}
				<span class="text-danger">{{ $errors->first('description')}}</span>
			</div>
			
			<div class="form-group">
				{{ Form::label('Detail: ','',['class' => 'font-weight-bold']) }}
				{!! Form::textarea('detail', null, [
				'class' => 'form-control',
				'placeholder'=>"Detail"
				])
				!!}
				<span class="text-danger">{{ $errors->first('detail')}}</span>
			</div>
			<div class="form-group">
				{{ Form::label('Image: ','',['class' => 'font-weight-bold']) }}
				{{ Form::file('url_image', null, ['class' => 'form-control' ]) }}
				<br>
				<span class="text-danger">{{ $errors->first('url_image')}}</span>
			</div>
			<div class="form-group">
				{{ Form::label('Price: ','',['class' => 'font-weight-bold']) }}
				{!! Form::number('price', null, [
				'class' => 'form-control','onKeyPress'=>'return isNumberKey(event)',
				'placeholder'=>"Price"
				])
				!!}
				<span class="text-danger">{{ $errors->first('price')}}</span>
			</div>
			<div class="form-group">
				{{ Form::label('Promotion Price: ','',['class' => 'font-weight-bold']) }}
				{!! Form::number('promotion_price', null, [
				'class' => 'form-control','onKeyPress'=>'return isNumberKey(event)',
				'placeholder'=>"Promotion Price"
				])
				!!}
				<span class="text-danger">{{ $errors->first('promotion_price')}}</span>
			</div>
			<div class="form-group">
				{{ Form::label('Quantity: ','',['class' => 'font-weight-bold']) }}
				{!! Form::number('quantity', null, [
				'class' => 'form-control','onKeyPress'=>'return isNumberKey(event)',
				'placeholder'=>"Quantity"
				])
				!!}
				<span class="text-danger">{{ $errors->first('quantity')}}</span>
			</div>
			<div class="form-group">
				{{ Form::label('Brand: ','',['class' => 'font-weight-bold']) }}
				{{ Form::select('brand_id', $brands, null,['class' => 'form-control','placeholder'=>"Choose Brand"]) }}

				<span class="text-danger">{{ $errors->first('brand_id')}}</span>
			</div>
			<div class="form-group">
				{{ Form::label('Category: ','',['class' => 'font-weight-bold']) }}
				{{ Form::select('category_id', $categories, null,['class' => 'form-control','placeholder'=>"Choose Category"]) }}
				
				<span class="text-danger">{{ $errors->first('category_id')}}</span>
			</div>
			<div class="form-group text-right">
				<a class="btn btn-info mt-3" href="{{ route('product.index') }}" title="back"><i class="fas fa-arrow-left"> Back to list</i></a>
				{{ Form::submit('Save',['class' => 'font-weight-bold text-white btn bg-color-green mt-3']) }}
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