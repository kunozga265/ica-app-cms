<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->

        <!-- Bootstrap Css -->
        <link href={{asset("assets/css/bootstrap.min.css")}} id="bootstrap-style" rel="stylesheet" type="text/css"></link>
        <!-- Icons Css -->
        <link href={{asset("assets/css/icons.min.css")}} rel="stylesheet" type="text/css"></link>
        <!-- App Css-->
        <link href={{asset("assets/css/app.min.css")}} id="app-style" rel="stylesheet" type="text/css"></link>
        <!-- Style Css-->
        <link href={{asset("css/style.css")}} id="app-style" rel="stylesheet" type="text/css"></link>

    </head>
    <body>
        <div class="">
            {{ $slot }}
        </div>

        <!-- JAVASCRIPT -->
        <script src={{asset("js/assets/jquery.min.js")}}></script>
        <script src={{asset("js/assets/bootstrap.bundle.min.js")}}></script>
        <script src={{asset("js/assets/metisMenu.min.js")}}></script>
        <script src={{asset("js/assets/simplebar.min.js")}}></script>
        <script src={{asset("js/assets/waves.min.js")}}></script>

        <!-- App js -->
        <script src={{asset("js/assets/app.js")}}></script>
    </body>
</html>
