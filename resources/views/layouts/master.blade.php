<!doctype html>
<head>
	
	@include('layouts.head')
	<title>@yield('title','') | ParcelMarket</title>

</head>
<body id="staxo" class="font-sans antialiased">
	<div class="min-h-screen bg-gray-100">

		@if (Request::is('/') || Request::is('product/*') || Request::is('confirm') || Request::is('stripepay') 
		|| Request::is('login') || Request::is('register') || Request::is('reset-password') || Request::is('verify-email')
		|| Request::is('forgot-password') || Request::is('confirm-password'))
			@include('layouts.guest-nav')
		@else
			@include('layouts.navigation')
		@endif

		<div class="wrapper">

			<div class="mt-1 page-wrap">

				<div class="main-content">
					@yield('content')
				</div>

				@include('layouts.footer')

			</div>
		</div>

		@include('layouts.script')
	</div>	
</body>
</html>