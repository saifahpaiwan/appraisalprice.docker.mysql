<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Project Name') }}</title>

    <!-- App css -->
    <link href="{{ asset('template/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" id="bootstrap-stylesheet" />
    <link href="{{ asset('template/css/icons.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('template/css/app.css') }}" rel="stylesheet" type="text/css" id="app-stylesheet" />
    <style>
        a {
            text-decoration: inherit !important;
        }
        main {
            margin-top: 150px;
        }
    </style>
</head>

<body>

    <body>
        <main>
            <div class="row justify-content-center">
                <div class="col-md-8">
                    @yield('content')
                </div>
            </div> 
        </main>
        <script src="{{ asset('template/js/vendor.min.js') }}"></script>
        <script src="{{ asset('template/js/app.min.js') }}"></script>
    </body>
    <script>
        $("form").submit(function(event) {

        });
    </script>

</html>