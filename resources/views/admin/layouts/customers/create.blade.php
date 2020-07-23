@extends('admin.shared.main')
@section('title')
Add new Customer
@endsection
@section('content')
<div class="content_yield">
	{{ Form::open(['route' => 'customer.create', 'method' => 'post','enctype '=>'multipart/form-data','class' => 'col-md-12 row']) }}
	<div class="col-md-12 m-auto">
		<h3 class="mb-5 font-weight-bold">Customer</h3>		
		<div class="col-lg-10 col-md-12 col-sm-12 row">
			<div class="form-group">
				{{ Form::label('full_name: ','',['class' => 'font-weight-bold']) }}
				{!! Form::text('full_name', null, [
					'class' => 'form-control',
					'placeholder'=>"Name Brand"
				])
				!!}

				<span class="text-danger">{{ $errors->first('full_name')}}</span>
			</div>
			<div class="form-group">
				{{ Form::label('Address: ','',['class' => 'font-weight-bold']) }}
				{!! Form::textarea('address', null, [
					'class' => 'form-control',
					'placeholder'=>"Address"
				])
				!!}
				<span class="text-danger">{{ $errors->first('address')}}</span>
			</div>
			<div class="form-group">
				{{ Form::label('Phone No: ','',['class' => 'font-weight-bold']) }}
				{!! Form::text('phone_no', null, [
					'class' => 'form-control','onKeyPress'=>'return isNumberKey(event)',
					'placeholder'=>"Phone No"
				])
				!!}
				<span class="text-danger">{{ $errors->first('phone_no')}}</span>
			</div>
			<div class="form-group">
				{{ Form::label('email: ','',['class' => 'font-weight-bold']) }}
            	{{ Form::text('email', null, ['class' => 'form-control','placeholder'=>"email" ]) }}
            	<br>            	
            	<span class="text-danger">{{ $errors->first('email')}}</span>
			</div>
			<div class="form-group">
				{{ Form::label('slug: ','',['class' => 'font-weight-bold']) }}
            	{{ Form::text('slug', null, ['class' => 'form-control','placeholder'=>"slug" ]) }}
            	<br>            	
            	<span class="text-danger">{{ $errors->first('slug')}}</span>
			</div>
			<div class="form-group text-right">
				<a class="btn btn-info mt-3" href="{{ route('customer.index') }}" title="back"><i class="fas fa-arrow-left"> Back to list</i></a>
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