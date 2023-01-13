<!doctype html>
<head>
	<title>@yield('title','') | STAXO</title>
	<!-- initiate head with meta tags, css and script -->
	@include('layouts.head')

</head>
<body id="staxo" >
    <div class="wrapper">
    	<!-- initiate header-->
    	{{-- @include('include.header') --}}
    	<div class="page-wrap">

	    	<div class="main-content">
	    		<!-- yeild contents here -->
	    		@yield('content')
	    	</div>

	    	<!-- initiate footer section-->
	    	@include('layouts.footer')

    	</div>
    </div>

	<!-- initiate scripts-->
	@include('layouts.script')	
</body>
</html>