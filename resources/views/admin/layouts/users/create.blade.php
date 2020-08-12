@extends('admin.shared.main')
@section('title')
    Thêm mới
@endsection
@section('content')
    <div class="content_yield">
        {{ Form::open(['route' => 'user.store', 'method' => 'post','class' => 'col-md-12 row']) }}
        <div class="col-md-12 m-auto">
            <h3 class="mb-5 font-weight-bold">Người dùng</h3>
            <div class="col-lg-10 col-md-12 col-sm-12 row">
                <div class="form-group">
                    {{ Form::label('Tên người dùng: ','',['class' => 'font-weight-bold']) }}
                    {!! Form::text('name', null, [
                        'class' => 'form-control',
                        'placeholder'=>"Tên người dùng"
                    ])
                    !!}
                    <span class="text-danger">{{ $errors->first('name')}}</span>
                </div>
                <div class="form-group">
                    {{ Form::label('Địa chỉ Email: ','',['class' => 'font-weight-bold']) }}
                    {!! Form::text('email', null, [
                        'class' => 'form-control',
                        'placeholder'=>"Địa chỉ Email"
                    ])
                    !!}
                    <span class="text-danger">{{ $errors->first('email')}}</span>
                </div>
                <div class="form-group">
                	{{ Form::label('Mật khẩu: ','',['class' => 'font-weight-bold']) }}
	     			{{ Form::password('password',['placeholder'=>'Mật khẩu','class' => ' form-control'])}}
	     			<span class="text-danger">{{ $errors->first('password')}}</span>
                </div>
                <div class="form-group">
                	{{ Form::label('Xác nhận mật khẩu: ','',['class' => 'font-weight-bold']) }}
	     			{{ Form::password('password_confirmation',['placeholder'=>'Xác nhận mật khẩu','class' => 'form-control'])}}
                </div>
                <select class="form-control" style="margin-bottom: 20px;" name="roles[]" multiple="multiple">
                    @foreach($roles as $role)
                        <option value="{{ $role->id }}">{{ $role->display_name }}</option>
                    @endforeach

                </select>
                <div class="form-group text-right">
                    <a class="btn btn-info mt-3" href="{{ route('user.index') }}" title="back"><i class="fas fa-arrow-left"> Xem danh sách</i></a>
                    {{ Form::submit('Lưu',['class' => 'font-weight-bold text-white btn bg-color-green mt-3']) }}
                </div>
            </div>
        </div>
        {{ Form::close() }}
    </div>
@endsection
