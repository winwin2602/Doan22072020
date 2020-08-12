@extends('admin.shared.main')
@section('title')
    Thêm mới
@endsection
@section('content')
<div class="content_yield">
	{{ Form::open(['route' => 'category.create', 'method' => 'post','enctype '=>'multipart/form-data','class' => 'col-md-12 row']) }}
	<div class="col-md-12 m-auto">
		<h3 class="mb-5 font-weight-bold">Thể loại</h3>
		<div class="col-lg-10 col-md-12 col-sm-12 row">
			<div class="form-group">
				{{ Form::label('Tên thể loại: ','',['class' => 'font-weight-bold']) }}
				{!! Form::text('name', null, [
					'class' => 'form-control',
					'placeholder'=>"Tên thể loại"
				])
				!!}
				<span class="text-danger">{{ $errors->first('name')}}</span>
			</div>
			<div class="form-group">
				{{ Form::label('Mô tả: ','',['class' => 'font-weight-bold']) }}
				{!! Form::text('description', null, [
					'class' => 'form-control',
					'placeholder'=>"Mô tả"
				])
				!!}
				<span class="text-danger">{{ $errors->first('description')}}</span>
			</div>
			<div class="form-group text-right">
				<a class="btn btn-info mt-3" href="{{ route('category.index') }}" title="back"><i class="fas fa-arrow-left"> Xem danh sách</i></a>
				{{ Form::submit('Lưu',['class' => 'font-weight-bold text-white btn bg-color-green mt-3']) }}
			</div>
		</div>
	</div>
	{{ Form::close() }}
</div>
@endsection
