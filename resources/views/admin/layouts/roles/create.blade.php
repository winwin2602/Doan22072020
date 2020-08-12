@extends('admin.shared.main')
@section('title')
    Thêm mới
@endsection
@section('content')
    <div class="content_yield">
        {{ Form::open(['route' => 'role.store', 'method' => 'post','class' => 'col-md-12 row']) }}
        <div class="col-md-12 m-auto">
            <h3 class="mb-5 font-weight-bold">Role</h3>
            <div class="col-lg-10 col-md-12 col-sm-12 row">
                <div class="form-group">
                    {{ Form::label('Name: ','',['class' => 'font-weight-bold']) }}
                    {!! Form::text('name', null, [
                        'class' => 'form-control',
                        'placeholder'=>"Name"
                    ])
                    !!}
                    <span class="text-danger">{{ $errors->first('name')}}</span>
                </div>
                <div class="form-group">
                    {{ Form::label('Display Name: ','',['class' => 'font-weight-bold']) }}
                    {!! Form::text('display_name', null, [
                        'class' => 'form-control',
                        'placeholder'=>"Display Name"
                    ])
                    !!}
                    <span class="text-danger">{{ $errors->first('display_name')}}</span>
                </div>
                <div class="form-group">
                    <label for="">Permission:</label>
                    <div class="role_group">
                    @foreach($permissions as $key => $permission)
                        <div class="col-2">
                            <input type="checkbox" id="per_{{$key}}" class="form-check-input" name="permission[]" value="{{ $permission->id }}">
                            <label class="form-check-label" for="per_{{$key}}" >{{ $permission->display_name }}</label>
                        </div>
                    @endforeach
                    </div>
                </div>
                <div class="form-group text-right">
                    <a class="btn btn-info mt-3" href="{{ route('role.index') }}" title="back"><i class="fas fa-arrow-left"> Back to list</i></a>
                    {{ Form::submit('Save',['class' => 'font-weight-bold text-white btn bg-color-green mt-3']) }}
                </div>
            </div>
        </div>
        {{ Form::close() }}
    </div>
@endsection
