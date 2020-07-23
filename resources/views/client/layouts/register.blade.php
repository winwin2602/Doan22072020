@extends('client.shared.master')
@section('content')
<div class="container">
	<div class="modal-body">
	<form method="POST" action="{{ route('client.register') }}">
		@csrf
		<div class="row">
			<div class="col-md-6 nph-rg">
				<div class="form-group">
					<input id="name" type="text" placeholder="{{trans('regis.name')}}" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" autocomplete="name" autofocus>

					@error('name')
					<span class="invalid-feedback" role="alert">
						<strong>{{ $message }}</strong>
					</span>
					@enderror
				</div>

				<div class="form-group">
					<input id="email" type="" placeholder="{{trans('regis.email')}}" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" autocomplete="email">

					@error('email')
					<span class="invalid-feedback" role="alert">
						<strong>{{ $message }}</strong>
					</span>
					@enderror
				</div>

				<div class="form-group">
					<input id="password" type="password" placeholder="{{trans('regis.password')}}" class="form-control @error('password') is-invalid @enderror" name="password" autocomplete="new-password">

					@error('password')
					<span class="invalid-feedback" role="alert">
						<strong>{{ $message }}</strong>
					</span>
					@enderror
				</div>

				<div class="form-group">
					<input id="" placeholder="{{trans('regis.password-confirm')}}" type="password" class="form-control" name="password_confirmation" autocomplete="new-password">
					@error('password')
					<span class="invalid-feedback" role="alert">
						<strong>{{ $message }}</strong>
					</span>
					@enderror
				</div>

			</div>
			<div class="col-md-6 nph-rg">
				<div class="form-group">
					<input id="full_name" type="text" placeholder="{{trans('regis.full name')}}" class="form-control @error('full_name') is-invalid @enderror" name="full_name" value="{{ old('full_name') }}" autocomplete="full_name" autofocus>

					@error('full_name')
					<span class="invalid-feedback" role="alert">
						<strong>{{ $message }}</strong>
					</span>
					@enderror
				</div>
				<div class="form-group">
					<input id="address" type="text" placeholder="{{trans('regis.address')}}" class="form-control @error('address') is-invalid @enderror" name="address" value="{{ old('address') }}" autocomplete="address" autofocus>

					@error('address')
					<span class="invalid-feedback" role="alert">
						<strong>{{ $message }}</strong>
					</span>
					@enderror
				</div>
				<div class="form-group">
					<input id="phone_no" type="text" placeholder="{{trans('regis.phone')}}" class="form-control @error('phone_no') is-invalid @enderror" name="phone_no" onKeyPress = "return isNumberKey(event)" value="{{ old('phone_no') }}" autocomplete="phone_no" autofocus>

					@error('phone_no')
					<span class="invalid-feedback" role="alert">
						<strong>{{ $message }}</strong>
					</span>
					@enderror
				</div>
				<div class="form-group">
					<!-- <label class="form-check-label"><input type="checkbox" required="required" checked="checked"> I accept the <a href="#">Terms of Use</a> &amp; <a href="#">Privacy Policy</a></label> -->
					<label class="form-check-label"><input type="checkbox" required="required" checked="checked"><a href="#">{{trans('regis.accept')}}</a></label>
				</div>
				<!-- button -->
				<div class="form-group">
					<button type="submit" class="btn btn-primary btn-lg btn-block login-btn">
						<!-- {{ __('Register') }} -->
	
						{{trans('regis.Register')}}
					</button>
				</div>    
			</div>
		</div>
							
	</form>
</div>
</div>
@endsection