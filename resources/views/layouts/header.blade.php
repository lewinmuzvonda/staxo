    @push('head')
  
    @endpush

    <header style="background-color: black" id="header" class="fixed-top d-flex align-items-center">
        <div class="container">
        <div style="background-color: black" class="header-container d-flex align-items-center justify-content-between">
            <div>
                <h1 class="bg-primary p-4 text-light"><a class="text-light" href="/"><span>STAXO | LEWIN</span></a></h1>
            </div>

            <nav id="navbar" class="navbar text-light">
                <ul>
                    <li><a class="text-primary" href="/">Home</a></li>
                    <li><a class="text-primary" href="/admin">Manage Products</a></li>
                    <li><a class="text-primary" href="/admin/categories">Manage Categories</a></li>
                    <li><a class="text-primary" href="/cart">Cart</a></li>
                    <li><a class="text-primary" href="/login">LOGIN</a></li>
                </ul>
                <i class="bi bi-list mobile-nav-toggle"></i>
            </nav>
        </div>
        </div>
    </header>

    @push('script')

        <script src="nav/vendor/purecounter/purecounter_vanilla.js"></script>
        <script src="nav/vendor/aos/aos.js"></script>
        <script src="nav/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="nav/vendor/glightbox/js/glightbox.min.js"></script>
        <script src="nav/vendor/isotope-layout/isotope.pkgd.min.js"></script>
        <script src="nav/vendor/swiper/swiper-bundle.min.js"></script>
        <script src="nav/vendor/php-email-form/validate.js"></script>
        <script src="nav/js/main.js"></script>
    @endpush