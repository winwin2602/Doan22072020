@extends('client.shared.master')
@section('content')
<div class="col-md-12">
    <div class="col-md-6 modal-body nph-lg text-center">
    <form method="POST" action="{{ route('client.login') }}">
        @csrf
        <div class="form-group">
            <input id="email" placeholder="{{trans('regis.email')}}" type="" class="form_custom form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" autocomplete="email" autofocus>

            @error('email')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="form-group">
            <input id="password" placeholder="{{trans('regis.password')}}" type="password" class="form_custom form-control @error('password') is-invalid @enderror" name="password" autocomplete="current-password">

            @error('password')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>        
        <div class="form-group">
            <button type="submit" class="btn btn-primary submit_button btn-lg btn-block login-btn">
                {{trans('regis.login')}}
               <!--  {{ __('Login') }} -->
                
            </button>
        </div>
    </form>
    <div class="err-login text-center">
        @if(Session::has('error'))
        {{ Session::get('error') }}
        @endif
    </div>
</div>
</div>

@endsection