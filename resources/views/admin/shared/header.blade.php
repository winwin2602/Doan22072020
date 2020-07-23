<nav class="topbar">
	<!-- Search Form -->
	<form class="search_form">
		<div class="input-group">
		</div>
	</form>
	<!-- Admin Icon -->
	<div class="admin_profile">
		@if(Auth::guard('admin')->check())
		<a class="nav-link dropdown-toggle" href="#">{{ Auth::guard('admin')->user()->name }}</a>
		<div class="logout_button">
			<a class="dropdown-item" href="{{ route('admin.logout') }}"
			onclick="event.preventDefault();
			document.getElementById('logout-form').submit();">
		{{ __('Logout') }}</a>
			<form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
				@csrf
			</form>
		</div>
		@endif
	</div>
</nav>