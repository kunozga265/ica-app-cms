<!doctype html>
<html class="no-js" lang="en">



<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="description" content="International Christian Assembly">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{$title}}</title>

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{asset('/favicon.png')}}">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">


    <!-- CSS here -->
    <link rel="stylesheet" href="{{asset('assets/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/animate.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/magnific-popup.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/fontawesome-all.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/imageRevealHover.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/swiper-bundle.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/flaticon.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/slick.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/spacing.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/main.css')}}">
</head>

<body>

<!-- preloader -->
<div id="preloader">
    <div id="loading-center">
        <div id="loading-center-absolute">
            <div class="object" id="object_one"></div>
            <div class="object" id="object_two"></div>
            <div class="object" id="object_three"></div>
        </div>
    </div>
</div>
<!-- preloader-end -->

<!-- Scroll-top -->
<button class="scroll__top scroll-to-target" data-target="html">
    <i class="fas fa-angle-up"></i>
</button>
<!-- Scroll-top-end-->

<!-- header-area -->
<header>
    <div class="header__top">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-4 col-md-6 col-sm-6 order-2 order-lg-0">
                    <div class="header__top-search">
                        <form action="#">
                            <input type="text" placeholder="Search here...">
                        </form>
                    </div>
                </div>
                <div class="col-lg-4 col-md-3 order-0 order-lg-2 d-none d-md-block">
                    <div class="header__top-logo logo text-lg-center">
                        <a href="{{route('home')}}" class="logo-dark"><img src="{{asset('images/logo-main.png')}}" alt="Logo"></a>
                        <a href="{{route('home')}}" class="logo-light"><img src="{{asset('images/logo-main.png')}}" alt="Logo"></a>
                    </div>
                </div>
                <div class="col-lg-4 col-md-3 col-sm-6 order-3 d-none d-sm-block">
                    <div class="header__top-right">
                        <ul class="list-wrap">
                            <li class="news-btn"><a href="#" class="btn">
                                    <span
                                            class="btn-text">Download</span>
                                    <i class="fas fa-download"></i>
                                </a></li>
{{--                            <li class="lang">--}}
{{--                                <div class="dropdown">--}}
{{--                                    <button class="dropdown-toggle" type="button" id="dropdownMenuButton1"--}}
{{--                                            data-bs-toggle="dropdown" aria-expanded="false">--}}
{{--                                        ENG--}}
{{--                                    </button>--}}
{{--                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">--}}
{{--                                        <li><a class="dropdown-item" href="#">SPA</a></li>--}}
{{--                                        <li><a class="dropdown-item" href="#">GRE</a></li>--}}
{{--                                        <li><a class="dropdown-item" href="#">CIN</a></li>--}}
{{--                                        <li><a class="dropdown-item" href="#">CIN</a></li>--}}
{{--                                    </ul>--}}
{{--                                </div>--}}
{{--                            </li>--}}
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="header-fixed-height"></div>
    <div id="sticky-header" class="tg-header__area">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="tgmenu__wrap">
                        <nav class="tgmenu__nav">
                            <div class="logo d-block d-md-none">
                                <a href="{{route('home')}}" class="logo-dark"><img src="{{asset('images/logo-main.png')}}" alt="Logo"></a>
                                <a href="{{route('home')}}" class="logo-light"><img src="{{asset('images/logo-main.png')}}"
                                                                               alt="Logo"></a>
                            </div>
                            <div class="mobile-nav-toggler"><i class="flaticon-menu-bar"></i></div>
{{--                            <div class="offcanvas-toggle">--}}
{{--                                <a href="#"><i class="flaticon-menu-bar"></i></a>--}}
{{--                            </div>--}}
                            <div class="tgmenu__navbar-wrap tgmenu__main-menu d-none d-lg-flex">
                                <ul class="navigation">
                                    <li class="active "><a href="{{route('home')}}">Home</a>
                                    </li>
                                    <li><a href="{{route('sermons')}}">Sermons</a></li>
                                    <li><a href="{{route('prayer-points')}}">Prayer Points</a></li>
                                    <li><a href="{{route('give')}}">Give</a></li>
                                </ul>
                            </div>
                            <div class="tgmenu__action">
                                <ul class="list-wrap">
                                    <li class="mode-switcher">
                                        <nav class="switcher__tab">
                                            <span class="switcher__btn light-mode"><i class="flaticon-sun"></i></span>
                                            <span class="switcher__mode"></span>
                                            <span class="switcher__btn dark-mode"><i class="flaticon-moon"></i></span>
                                        </nav>
                                    </li>
                                    <li class="user"><a href="{{route("login")}}"><i class="far fa-user"></i></a></li>
{{--                                    <li class="header-cart"><a href="#"><i class="far fa-shopping-basket"></i></a></li>--}}
                                </ul>
                            </div>
                        </nav>

                    </div>
                    <!-- Mobile Menu  -->
                    <div class="tgmobile__menu">
                        <nav class="tgmobile__menu-box">
                            <div class="close-btn"><i class="fas fa-times"></i></div>
                            <div class="nav-logo">
                                <a href="{{route('home')}}" class="logo-dark"><img src="{{asset('images/logo-main.png')}}" alt="Logo"></a>
                                <a href="{{route('home')}}" class="logo-light"><img src="{{asset('images/logo-main.png')}}"
                                                                               alt="Logo"></a>
                            </div>
                            <div class="tgmobile__search">
                                <form action="#">
                                    <input type="text" placeholder="Search here...">
                                    <button><i class="far fa-search"></i></button>
                                </form>
                            </div>
                            <div class="tgmobile__menu-outer">
                                <!--Here Menu Will Come Automatically Via Javascript / Same Menu as in Header-->
                            </div>
                            <div class="social-links">
                                <ul class="list-wrap">
                                    <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                                    <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                                    <li><a href="#"><i class="fab fa-instagram"></i></a></li>
                                    <li><a href="#"><i class="fab fa-linkedin-in"></i></a></li>
                                    <li><a href="#"><i class="fab fa-youtube"></i></a></li>
                                </ul>
                            </div>
                        </nav>
                    </div>
                    <div class="tgmobile__menu-backdrop"></div>
                    <!-- End Mobile Menu -->
                </div>
            </div>
        </div>
    </div>

    <!-- offCanvas-area -->
    <div class="offCanvas__wrap">
        <div class="offCanvas__body">
            <div class="offCanvas__toggle"><i class="flaticon-addition"></i></div>
            <div class="offCanvas__content">
                <div class="offCanvas__logo logo">
                    <a href="{{route('home')}}" class="logo-dark"><img src="{{asset('images/logo-main.png')}}" alt="Logo"></a>
                    <a href="{{route('home')}}" class="logo-light"><img src="{{asset('images/logo-main.png')}}" alt="Logo"></a>
                </div>
                <p>Change how the world works with Biotellus, made for ecology.</p>
                <ul class="offCanvas__instagram list-wrap">
                    <li><a href="{{asset('assets/img/blog/blog01.jpg')}}" class="popup-image"><img src="{{asset('assets/img/blog/blog01.jpg')}}"
                                                                                      alt="img"></a></li>
                    <li><a href="{{asset('assets/img/blog/blog02.jpg')}}" class="popup-image"><img src="{{asset('assets/img/blog/blog02.jpg')}}"
                                                                                      alt="img"></a></li>
                    <li><a href="{{asset('assets/img/blog/blog03.jpg')}}" class="popup-image"><img src="{{asset('assets/img/blog/blog03.jpg')}}"
                                                                                      alt="img"></a></li>
                    <li><a href="{{asset('assets/img/blog/blog04.jpg')}}" class="popup-image"><img src="{{asset('assets/img/blog/blog04.jpg')}}"
                                                                                      alt="img"></a></li>
                    <li><a href="{{asset('assets/img/blog/blog05.jpg')}}" class="popup-image"><img src="{{asset('assets/img/blog/blog05.jpg')}}"
                                                                                      alt="img"></a></li>
                    <li><a href="{{asset('assets/img/blog/blog06.jpg')}}" class="popup-image"><img src="{{asset('assets/img/blog/blog06.jpg')}}"
                                                                                      alt="img"></a></li>
                </ul>
            </div>
            <div class="offCanvas__contact">
                <h4 class="title">Get In Touch</h4>
                <ul class="offCanvas__contact-list list-wrap">
                    <li><i class="fas fa-envelope-open"></i><a href="mailto:info@webmail.com">info@webmail.com</a></li>
                    <li><i class="fas fa-phone"></i><a href="tel:88899988877">888 999 888 77</a></li>
                    <li><i class="fas fa-map-marker-alt"></i> 12/A, New Booston, NYC</li>
                </ul>
                <ul class="offCanvas__social list-wrap">
                    <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                    <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                    <li><a href="#"><i class="fab fa-linkedin-in"></i></a></li>
                    <li><a href="#"><i class="fab fa-youtube"></i></a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="offCanvas__overlay"></div>
    <!-- offCanvas-area-end -->

</header>
<!-- header-area-end -->

<!-- main-area -->
<main>
   <div class="container">
       <div class="row">
           @if($message=Session::get('success'))
               <div style="width:100%" class="alert alert-success alert-dismissible fade show" role="alert">
{{--                   <button type="button" class="btn-close" data-dismiss="alert" aria-label="Close"><span--}}
{{--                               aria-hidden="true">×</span></button>--}}
                   <strong>Success!</strong> {{$message}}
               </div>
           @endif
           @if($message=Session::get('info'))
               <div style="width:100%" class="alert alert-info alert-dismissible fade show" role="alert">
{{--                   <button type="button" class="btn-close" data-dismiss="alert" aria-label="Close"><span--}}
{{--                               aria-hidden="true">×</span></button>--}}
                   <strong>Information!</strong> {{$message}}
               </div>
           @endif
           @if($message=Session::get('error'))
               <div style="width:100%" class="alert alert-danger alert-dismissible fade show" role="alert">
{{--                   <button type="button" class="btn-close" data-dismiss="alert" aria-label="Close"><span--}}
{{--                               aria-hidden="true">×</span></button>--}}
                   <strong>Error!</strong> {{$message}}
               </div>
           @endif
           @if($message=Session::get('warning'))
               <div style="width:100%" class="alert alert-warning alert-dismissible fade show" role="alert">
{{--                   <button type="button" class="btn-close" data-dismiss="alert" aria-label="Close"><span--}}
{{--                               aria-hidden="true">×</span></button>--}}
                   <strong>Warning!</strong> {{$message}}
               </div>
           @endif

       </div>
   </div>
{{ $slot }}




</main>
<!-- main-area-end -->




<!-- JS here -->
<script src="{{asset('assets/js/vendor/jquery-3.6.0.min.js')}}"></script>
<script src="{{asset('assets/js/bootstrap.min.js')}}"></script>
<script src="{{asset('assets/js/isotope.pkgd.min.js')}}"></script>
<script src="{{asset('assets/js/imagesloaded.pkgd.min.js')}}"></script>
<script src="{{asset('assets/js/jquery.magnific-popup.min.js')}}"></script>
<script src="{{asset('assets/js/jquery.marquee.min.js')}}"></script>
<script src="{{asset('assets/js/imageRevealHover.js')}}"></script>
<script src="{{asset('assets/js/swiper-bundle.js')}}"></script>
<script src="{{asset('assets/js/TweenMax.min.js')}}"></script>
<script src="{{asset('assets/js/slick.min.js')}}"></script>
<script src="{{asset('assets/js/ajax-form.js')}}"></script>
<script src="{{asset('assets/js/wow.min.js')}}"></script>
<script src="{{asset('assets/js/main.js')}}"></script>
</body>


</html>