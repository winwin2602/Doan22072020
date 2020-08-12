<ul class="sidebar" >
	<!-- Dash board -->
	<div class="dash_board">
		<div class="dash_board_ava">
			<img src="{{ asset('images/sunflower.png') }}" alt="#">
		</div>
		<a class="dash_board_link" href="{{ url('admin/dashboard') }}"> Trang chủ </a>
	</div>
	<!-- Manage list -->
	<li class="list_item">
		<a class="item_link" href="{{ route('brand.index') }}">Nhãn hàng</a>
	</li>
	<li class="list_item">
		<a class="item_link" href="{{ route('category.index') }}">Thể loại</a>
	</li>
	<li class="list_item">
		<a class="item_link" href="{{ route('product.index') }}">Sản phẩm</a>
	</li>
    <li class="list_item">
        <a class="item_link" href="{{ route('order.index') }}">ĐƠn hàng</a>
    </li>
    <li class="list_item">
        <a class="item_link" href="{{ route('customer.index') }}">Khách hàng</a>
    </li>
	<li class="list_item">
		<a class="item_link" href="{{ route('user.index') }}">Người dùng</a>
	</li>
	<li class="list_item">
		<a class="item_link" href="{{ route('role.index') }}">Phân quyền</a>
	</li>
    <li class="list_item">
        <a class="item_link" href="{{ route('slide.index') }}">Hiệu ứng</a>
    </li>
</ul>
