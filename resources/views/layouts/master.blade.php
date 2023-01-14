<!doctype html>
<head>
	
	<!-- initiate head with meta tags, css and script -->
	@include('layouts.head')
	<title>@yield('title','') | STAXO</title>

</head>
<body id="staxo" >
    <div class="wrapper">
    	<!-- initiate header-->
		<div class="container pb-5">
    		@include('layouts.header')
		</div>
    	<div class="mt-5 page-wrap">

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