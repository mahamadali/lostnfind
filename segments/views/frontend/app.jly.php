<html>
    <head>
        <title>@plot('title')</title>
        <meta charset="utf-8">
        <meta content="width=device-width, initial-scale=1.0" name="viewport">
        <meta content="{{ setting('app.title') }}" name="description">
        <meta content="" name="keywords">

        <!-- Favicons -->
        <link href="assets/img/favicon.png" rel="icon">
        <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

        <!-- Google Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,600;1,700&family=Poppins:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&family=Inter:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet">

        <!-- Vendor CSS Files -->
        <link href="{{ url('assets/frontend/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
        <link href="{{ url('assets/frontend/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
        <link href="{{ url('assets/frontend/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
        <link href="{{ url('assets/frontend/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
        <link href="{{ url('assets/frontend/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">
        <link href="{{ url('assets/frontend/vendor/aos/aos.css') }}" rel="stylesheet">

        <!-- Template Main CSS File -->
        <link href="{{ url('assets/frontend/css/main.css') }}" rel="stylesheet">
        @plot('styles')
    </head>
    <body>
        @include('frontend/layouts/header')
        @plot('hero')
        <main id="main">
        @plot('content')
        </main>
        @include('frontend/layouts/footer')
        <a href="#" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

        <div id="preloader"></div>

        <!-- Vendor JS Files -->
        <script src="{{ url('assets/frontend/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ url('assets/frontend/vendor/purecounter/purecounter_vanilla.js') }}"></script>
        <script src="{{ url('assets/frontend/vendor/glightbox/js/glightbox.min.js') }}"></script>
        <script src="{{ url('assets/frontend/vendor/swiper/swiper-bundle.min.js') }}"></script>
        <script src="{{ url('assets/frontend/vendor/aos/aos.js') }}"></script>
        <script src="{{ url('assets/frontend/vendor/php-email-form/validate.js') }}"></script>

        <!-- Template Main JS File -->
        <script src="{{ url('assets/frontend/js/main.js') }}"></script>
        @plot('scripts')
    </body>
</html>