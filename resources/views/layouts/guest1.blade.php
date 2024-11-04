<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>ICA APP - {{$title}}</title>

        <!-- Favicon -->
        <link rel="icon" type="image/x-icon" href="{{asset('/favicon.png')}}">


        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

        <!-- Bootstrap Css -->
        <link href={{asset("assets_1/css/bootstrap.min.css")}} id="bootstrap-style" rel="stylesheet" type="text/css"></link>
        <!-- Icons Css -->
        <link href={{asset("assets_1/css/icons.min.css")}} rel="stylesheet" type="text/css"></link>
        <!-- Swiper Css-->
        <link href={{asset("assets_1/css/swiper.min.css")}} id="app-style" rel="stylesheet" type="text/css"></link>
        <!-- Line Awesome Css-->
        <link href={{asset("assets_1/css/line-awesome.css")}} id="app-style" rel="stylesheet" type="text/css"></link>
        <!-- MDI Css-->
        <link href="https://cdn.jsdelivr.net/npm/@mdi/font@6.x/css/materialdesignicons.min.css" rel="stylesheet">
        <link href={{asset("assets_1/css/icons.min.css")}} rel="stylesheet" type="text/css"></link>
        <!-- Main Css-->
        <link href={{asset("assets_1/css/main.css")}} id="app-style" rel="stylesheet" type="text/css"></link>
        <!-- Style Css-->
        <link href={{asset("assets_1/css/style.css")}} id="app-style" rel="stylesheet" type="text/css"></link>

    </head>
    <body>
    <!-- navbar -->
    <div id="navbar" class="navbar navbar-expand-lg justify-content-center">
        <div class="container">
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                {{--                <a href="#" class="navbar-brand"><img src="images/logo-main.png" alt=""></a>--}}
                <ul class="navbar-nav nav">
                    <li class="nav-item"><a class="nav-link" href="#">Home</a></li>
{{--                    <li class="nav-item"><a class="nav-link" href="#download">Download</a></li>--}}
                    <li class="nav-item"><a class="nav-link" href="#">Sermons</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Prayer Points</a></li>
                                        <li class="nav-item"><a class="nav-link" href="#">Give</a></li>
                </ul>
            </div>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <i class="la la-bars"></i>
            </button>
            <ul class="button-navbar">
                {{--                <li><button class="button"><i class="lab la-app-store"></i>App Store</button></li>--}}
                {{--                <li><button class="button"><i class="lab la-google-play"></i>Google Play</button></li>--}}
                {{--                <li><button class="button"><i class="mdi mdi-download"></i>Download</button></li>--}}
                @if(\Illuminate\Support\Facades\Auth::check())
                    <li><a href="{{route('dashboard')}}" class="button login"><i class="mdi mdi-monitor-dashboard"></i>Dashboard</a></li>
                @else
                    <li><a href="{{route('login')}}" class="button login"><i class="mdi mdi-arrow-right-circle"></i>Login</a></li>
                @endif
            </ul>
        </div>
    </div>
    <!-- end navbar -->

    {{ $slot }}

        <!-- footer -->
        <footer>
            <div class="content">
                <div class="container">
                    <div class="row">
                        <div class="col-md">
                            <img src="images/logo-main.png" alt="">
                            <p>The official app for International Christian Assembly. Keep up to date with our sermons, prayer points, announcements and events. Get connected today!</p>
                        </div>
                        <div class="col-md">
                            <h6>Contact us</h6>
                            <ul>
                                <li><i class="la la-phone"></i>  +265 99 774 85 84 </li>
                                <li><i class="la la-envelope"></i>contact@ica-app.com </li>
                                <li><i class="la la-map"></i>ICA, Chirambula Road, Lilongwe Malawi  </li>
                            </ul>
                        </div>
                        <div class="col-md">
                            <h6>Social Media</h6>
                            <ul>
                                <li><a href="https://web.facebook.com/ICALilongwe/" target="_blank"><i class="la la-facebook"></i> Facebook</a></li>
                                <li><a href="https://www.youtube.com/@icalilongwe6311" target="_blank"><i class="la la-youtube"></i> Youtube</a></li>
                                <li><a href="https://www.instagram.com/icalilongwe/" target="_blank"><i class="la la-instagram"></i> Instagram</a></li>
                                <li><a href="https://icamalawi.com" target="_blank"><i class="la la-github"></i> Church Website</a></li>
                            </ul>
                        </div>
{{--                        <div class="col-md">--}}
{{--                            <h6>Usefull Link</h6>--}}
{{--                            <ul>--}}
{{--                                <li><a href=""><i class="la la-user"></i> About</a></li>--}}
{{--                                <li><a href=""><i class="la la-rocket"></i> Features</a></li>--}}
{{--                                <li><a href=""><i class="la la-dollar"></i> Pricing</a></li>--}}
{{--                                <li><a href=""><i class="la la-envelope"></i> Contact</a></li>--}}
{{--                            </ul>--}}
{{--                        </div>--}}
                    </div>
                </div>
            </div>
        </footer>
        <!-- end footer -->

        <!-- footer copyright -->
        <div class="footer-cp">
            <div class="container">
                <div class="row">
                    <div class="col-md col-12">
                        Copyright © All Right Reserved
                    </div>
                    <div class="col-md col-12">
{{--                        <ul>--}}
{{--                            <li><a href="">Help & Center</a></li>--}}
{{--                            <li><a href="">Refund Request</a></li>--}}
{{--                        </ul>--}}
                    </div>
                </div>
            </div>
        </div>
        <!-- end footer copyright -->

        <!-- JAVASCRIPT -->
        <script src={{asset("js/assets_1/jquery.min.js")}}></script>
        <script src={{asset("js/assets_1/bootstrap.bundle.min.js")}}></script>
        <script src={{asset("js/assets_1/metisMenu.min.js")}}></script>
        <script src={{asset("js/assets_1/simplebar.min.js")}}></script>
        <script src={{asset("js/assets_1/waves.min.js")}}></script>

        <!-- App js -->
        <script src={{asset("js/assets_1/app.js")}}></script>
    </body>
</html>
