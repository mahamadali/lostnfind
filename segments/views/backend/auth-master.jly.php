<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>@plot('title')</title>
        @plot('styles')
        <!-- plugins:css -->
      <link rel="stylesheet" href="{{ url('assets/vendors/feather/feather.css') }}">
      <link rel="stylesheet" href="{{ url('assets/vendors/ti-icons/css/themify-icons.css') }}">
      <link rel="stylesheet" href="{{ url('assets/vendors/css/vendor.bundle.base.css') }}">
      <!-- endinject -->
      <!-- Plugin css for this page -->
      <!-- End plugin css for this page -->
      <!-- inject:css -->
      <link rel="stylesheet" href="{{ url('assets/css/vertical-layout-light/style.css') }}">
      <!-- endinject -->
      <link rel="shortcut icon" href="{{ url('assets/images/favicon.png') }}" />
    </head>
    <body>
        @plot('content')
        <script src="{{ url('assets/vendors/js/vendor.bundle.base.js') }}"></script>
        <script src="{{ url('assets/js/off-canvas.js') }}"></script>
        <script src="{{ url('assets/js/hoverable-collapse.js') }}"></script>
        <script src="{{ url('assets/js/template.js') }}./"></script>
        <script src="{{ url('assets/js/settings.js') }}"></script>
        <script src="{{ url('assets/js/todolist.js') }}"></script>
        @plot('scripts')
    </body>
</html>