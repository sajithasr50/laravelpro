<style>
	.bg-dark {
		background-color: #c2b415 !important;

	}
</style>

<header class="p-3 bg-dark text-white">
	<div class="container">
		<div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
			<a href="/" class="d-flex align-items-center mb-2 mb-lg-0 text-white text-decoration-none">
				<svg class="bi me-2" width="40" height="32" role="img" aria-label="Bootstrap">
					<use xlink:href="#bootstrap" />
				</svg>
			</a>

			<ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
				<li><a href="/" class="nav-link px-2 text-secondary"><img src="{!! url('images/bootstrap-logo.png') !!}" alt="" style="float:left;width:35px;height:35px;">&nbsp;<span style="font-size: 26px;
    padding-left: 10px;
    text-transform: uppercase;
    color: white;
    margin-top: 19px;">Admin Panel</span></a></li>


			</ul>

			<ul class="nav col-12 col-lg-auto mb-2 mb-md-0">

				@auth
				@if(auth()->user()->role == 1)
				<li><a href="{{ route('user.list') }}" class="nav-link px-2 text-white">Users</a></li>

				@endif

				<li><a href="{{ route('createform.index') }}" class="nav-link px-2 text-white">Create Form</a></li>
				<li><a href="{{ route('user.profile') }}" class="nav-link px-2 text-white">Profile</a></li>

				@endauth

			</ul>

			@auth
			<!-- <span style="color:maroon">{{auth()->user()->username}}&nbsp;&nbsp;</span> -->
			<div class="text-end">

				<a href="{{ route('logout.perform') }}" class="btn btn-outline-light me-2">Logout</a>
			</div>
			@endauth

			@guest
			<div class="text-end">
				<a href="{{ route('login.perform') }}" class="btn btn-outline-light me-2">Login</a>
				<a href="{{ route('register.perform') }}" class="btn btn-warning">Sign-up</a>
			</div>
			@endguest
		</div>
	</div>
</header>