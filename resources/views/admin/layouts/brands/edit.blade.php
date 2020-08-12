@extends('admin.shared.main')
@section('title')
    Cập nhật
@endsection
@section('content')
<div class="content_yield">
	{{ Form::open(['route'=>['brand.update',$brand->id],'method'=>'put','enctype '=>'multipart/form-data','class' => 'col-md-12 row']) }}
	<div class="col-md-12 m-auto">
		<h3 class="mb-5 font-weight-bold">Nhãn hiệu</h3>
		<div class="col-lg-10 col-md-12 col-sm-12 row">
			<div class="form-group">
				{{ Form::label('Tên nhãn hiệu: ','',['class' => 'font-weight-bold']) }}
				{!! Form::text('name', $brand->name, [
					'class' => 'form-control',
					'placeholder'=>"Tên nhãn hiệu"
				])
				!!}
				<span class="text-danger">{{ $errors->first('name')}}</span>
			</div>
			<div class="form-group">
				{{ Form::label('Địa chỉ: ','',['class' => 'font-weight-bold']) }}
				{!! Form::text('address', $brand->address, [
					'class' => 'form-control',
					'placeholder'=>"Địa chỉ"
				])
				!!}
				<span class="text-danger">{{ $errors->first('address')}}</span>
			</div>
			<div class="form-group">
				{{ Form::label('Số điện thoại: ','',['class' => 'font-weight-bold']) }}
				{!! Form::text('phone_no', $brand->phone_no, [
					'class' => 'form-control','onKeyPress'=>'return isNumberKey(event)',
					'placeholder'=>"Số điện thoại"
				])
				!!}
				<span class="text-danger">{{ $errors->first('phone_no')}}</span>
			</div>
			<div class="form-group">
				{{ Form::label('Logo: ','',['class' => 'font-weight-bold']) }}
            	{{ Form::file('logo', ['class' => 'form-control' ]) }}
            	<input type="hidden" value="{{$brand->logo}}" name="image"><br>
            	<span class="text-danger">{{ $errors->first('logo')}}</span>
			</div>
			<div class="form-group text-right">
				<a class="btn btn-info mt-3" href="{{ route('brand.index') }}" title="back"><i class="fas fa-arrow-left"> Xem danh sách</i></a>
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
@endsection
