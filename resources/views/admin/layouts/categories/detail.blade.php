@extends('admin.shared.main')
@section('title')
Categories
@endsection
@section('content')
<div class="content_yield">
	<table class="table table_xk table-hover table-bordered">
		<thead class="thead_green">
			<tr>
				<th class="text-center">Id</th>
				<th class="text-center">Name</th>
				<th class="text-center">ParentId</th>
				<th class="text-center">Display Order</th>
				<th class="text-center">Description</th>
				<th class="text-center">Slug</th>
				<th class="text-center">Action</th>
			</tr>
		</thead>
		<tbody>
			<!-- Loop -->
			@foreach($categories as $key => $category)
			<tr>
				<td class="text-center">{{++$key}}</td>
				<td class="text-center">{{ $category->name }}</td>
				<td class="text-center">{{ $category->parent_id }}</td>
				<td class="text-center">{{ $category->display_order }}</td>
				<td class="text-center">{{ $category->description }}</td>
				<td class="text-center">{{ $category->slug }}</td>
			</tr>
			@endforeach
			<!-- End loop -->
		</tbody>
	</table>
	<a href="{{ route('category.index') }}" class="btn btn-primary"><i class="fas fa-arrow-left"></i> Back to list</a>
</div>
@endsection