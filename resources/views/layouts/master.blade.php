<!doctype html>
<head>
	
	@include('layouts.head')
	<title>@yield('title','') | STAXO</title>

</head>
<body id="staxo" class="font-sans antialiased">
	<div class="min-h-screen bg-gray-100">

		@if (Request::is('/') || Request::is('product/*'))
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