@extends('admin.shared.main')
@section('title')
weaShopOnline - Brands
@endsection
@section('content')
<div class="content_yield">
	<div class="row">
		<h3 class="page_title">Brands</h3>
		<div class="col-md-12">
			@if(Session::has('message'))
			<div id="div-alert" style="position:absolute; right: 10px;" class="float-right mt-2 alert alert-success alert-dismissible show" role="alert" style="position: absolute;">
				<strong>{{ Session::get('message') }}</strong>
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			@elseif(Session::has('err'))
			<div id="div-alert" style="position:absolute; right: 10px;" class="float-right mt-2 alert alert-success alert-dismissible show" role="alert" style="position: absolute;">
				<strong>{{ Session::get('err') }}</strong>
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			@endif			
		</div>

	</div>
	<a href="{{ route('brand.create') }}" class="btn bg-color-green add_new_button"><i class="fas fa-plus"></i> Add new</a>
	
	<table class="table table_xk table-hover table-bordered">
		<thead class="thead_green">
			<tr>
				<th class="text-center">Id</th>
				<th class="text-center">Name</th>
				<th class="text-center">Logo</th>
				<th class="text-center">Address</th>
				<th class="text-center">PhoneNo</th>
				<th class="text-center">Slug</th>
				<th class="text-center">Action</th>
			</tr>
		</thead>
		<tbody>
			<!-- Loop -->
			@foreach($brands as $key => $brand)
			<tr>
				<td class="text-center">{{++$key}}</td>
				<td class="text-center">
					<a href="">
						<h4>{{  $brand->name }}</h4>
					</a>
				</td>
				<td class="text-center">
					<img src="{{asset('images/'.$brand->logo)}}" width="50" height="50" alt="logo">
				</td>
				<td class="text-center">{{ $brand->address }}</td>
				<td class="text-center">{{ $brand->phone_no }}</td>
				<td class="text-center">{{ $brand->slug }}</td>
				<td class="text-center action_icon">
					<a href="{{route('brand.edit',$brand->id)}}"><i class="far fa-edit edit"></i></a>
					<a type="button" class="fas fa-trash-alt deletebutton text-danger btn" data-id="{{$brand->id}}" data-toggle="modal" data-target="#Modal"></a>
				</td>
			</tr>
			@endforeach
			<!-- End loop -->
		</tbody>
	</table>
</div>
{{Form::open(['route' => ['brand.delete'], 'method' => 'DELETE'])}}  
@include('admin.modal.modaldelete')
{{ Form::close() }}
<script>
	$(document).on('click','.deletebutton',function(){
		var id=$(this).attr('data-id');
		console.log(id);
		$('#id').val(id);
	});
</script>
<script>
	setTimeout(function() {
		var element = document.getElementById("div-alert");
   		element.classList.add("fade");
	}, 2000)
</script>
@endsection