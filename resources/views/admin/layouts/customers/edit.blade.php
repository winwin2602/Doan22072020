@extends('admin.shared.main')
@section('title')
    Cập nhật
@endsection
@section('content')
<div class="content_yield">
	{{ Form::open(['route'=>['customer.update',$ctm->id],'method'=>'put','enctype '=>'multipart/form-data','class' => 'col-md-12 row']) }}
	<div class="col-md-12 m-auto">
		<h3 class="mb-5 font-weight-bold">Khách hàng</h3>
		<div class="col-lg-10 col-md-12 col-sm-12 row">
			<div class="form-group">
				{{ Form::label('Tên khách hàng: ','',['class' => 'font-weight-bold']) }}
				{!! Form::text('full_name',$ctm->full_name, [
					'class' => 'form-control',
					'placeholder'=>"Tên khách hàng"
				])
				!!}

			</div>
			<div class="form-group">
				{{ Form::label('Địa chỉ: ','',['class' => 'font-weight-bold']) }}
				{!! Form::text('address',$ctm->address, [
					'class' => 'form-control',
					'placeholder'=>"Địa chỉ"
				])
				!!}

			</div>
			<div class="form-group">
				{{ Form::label('Số điện thoại: ','',['class' => 'font-weight-bold']) }}
				{!! Form::text('phone_no',$ctm->phone_no, [
					'class' => 'form-control','onKeyPress'=>'return isNumberKey(event)',
					'placeholder'=>"Số điện thoại"
				])
				!!}

			</div>
			<div class="form-group">
				{{ Form::label('Địa chỉ Email: ','',['class' => 'font-weight-bold']) }}
            	{{ Form::text('email', $ctm->email, ['class' => 'form-control' ]) }}
            	<br>
            	<span class="text-danger">{{ $errors->first('email')}}</span>
			</div>
			<div class="form-group">
				{{ Form::label('Slug: ','',['class' => 'font-weight-bold']) }}
            	{{ Form::text('slug',$ctm->slug, ['class' => 'form-control' ]) }}
            	<br>

			</div>
			<div class="form-group text-right">
				<a class="btn btn-info mt-3" href="{{ route('customer.index') }}" title="back"><i class="fas fa-arrow-left"> Xem danh sách</i></a>
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
@endsection
