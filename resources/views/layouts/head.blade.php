<meta charset="utf-8">
<meta http-equiv="x-ua-compatible" content="ie=edge">
<meta name="description" content="">
<meta name="keywords" content="">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="csrf_token" value="{{ csrf_token() }}"/>

<!-- Fonts -->
<link rel="stylesheet" href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap">

<!-- Scripts -->
@vite(['resources/css/app.css', 'resources/js/app.js'])

<link rel="icon" href="{{ asset('favicon.png')}}" />

<!-- font awesome library -->
<link href="https://fonts.googleapis.com/css?family=Nunito+Sans:300,400,600,700,800" rel="stylesheet">


<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
<link href="/assets/nav/vendor/aos/aos.css" rel="stylesheet">
<link href="/assets/nav/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
<link href="/assets/nav/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
<link href="/assets/nav/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
<link href="/assets/nav/vendor/remixicon/remixicon.css" rel="stylesheet">
<link href="/assets/nav/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

@laravelViewsStyles(laravel-views,tailwindcss,livewire)
<link href="/assets/nav/css/style.css" rel="stylesheet">
<!-- Stack array for including inline css or head elements -->
@stack('head')


