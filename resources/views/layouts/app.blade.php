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
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&family=Playfair+Display:ital,wght@0,400..900;1,400..900&display=swap" rel="stylesheet">

    <!-- JAVASCRIPT -->
    <script src={{asset("js/assets/jquery.min.js")}}></script>
    <script src={{asset("js/assets/jquery-ui.js")}}></script>
    <script src={{asset("js/assets/bootstrap.bundle.min.js")}}></script>

    <!-- Bootstrap Css -->
    <link href={{asset("assets_1/css/bootstrap.min.css")}} id="bootstrap-style" rel="stylesheet" type="text/css"></link>
    <!-- Icons Css -->
    <link href={{asset("assets_1/css/icons.min.css")}} rel="stylesheet" type="text/css"></link>
    <!-- App Css-->
    <link href={{asset("assets_1/css/app.min.css")}} id="app-style" rel="stylesheet" type="text/css"></link>
    <!-- Style Css-->
    <link href={{asset("css/style.css")}} id="app-style" rel="stylesheet" type="text/css"></link>
    <link href={{asset("css/jquery-ui.css")}} id="app-style" rel="stylesheet" type="text/css"></link>

    @stack("styles")

</head>
<body>
<!-- Begin page -->
<div id="layout-wrapper">


    <header id="page-topbar">
        <div class="navbar-header">
            <div class="d-flex">
                <!-- LOGO -->
                <div class="navbar-brand-box">
                    <a href="{{route('dashboard')}}" class="logo ">
                                <span class="logo-sm">
                                    <img src="{{asset('images/logo-main.png')}}" alt="logo-sm" height="50">
                                </span>
                        <span class="logo-lg">
                                    <img src="{{asset('images/logo-main.png')}}" alt="logo-dark" height="60">
                                </span>
                    </a>
                </div>

                <button type="button" class="btn btn-sm px-3 font-size-24 header-item waves-effect"
                        id="vertical-menu-btn">
                    <i class="ri-menu-2-line align-middle"></i>
                </button>
            </div>

            <div>
                <div>{{Auth::user()->name}}</div>
                <div class="text-sm">{{Auth::user()->email}}</div>
            </div>


        </div>
    </header>

    <!-- ========== Left Sidebar Start ========== -->
    <div class="vertical-menu">

        <div data-simplebar class="h-100">

            <!--- Sidemenu -->
            <div id="sidebar-menu">
                <!-- Left Menu Start -->
                <ul class="metismenu list-unstyled" id="side-menu">
                    <li class="menu-title">Menu</li>

                    <!--                    <li>
                        <a href="{{route('dashboard')}}" class=" waves-effect">
                            <i class="ri-dashboard-line"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>-->

                    <li>
                        <a href="{{route('sermons.index')}}" class=" waves-effect">
                            <i class=" ri-book-open-line"></i>
                            <span>Sermons</span>
                        </a>
                    </li>

                    <li>
                        <a href="{{route('series.index')}}" class=" waves-effect">
                            <i class="ri-book-3-line"></i>
                            <span>Series</span>
                        </a>
                    </li>

                    <li>
                        <a href="{{route('authors.index')}}" class=" waves-effect">
                            <i class="ri-team-line "></i>
                            <span>Ministers</span>
                        </a>

                    <li>
                        <a href="{{route('prayers.index')}}" class=" waves-effect">
                            <i class="ri-file-list-3-line"></i>
                            <span>Prayer Points</span>
                        </a>
                    </li>

                    <li>
                        <a href="{{route('events.index')}}" class=" waves-effect">
                            <i class="ri-calendar-line"></i>
                            <span>Events</span>
                        </a>
                    </li>

                    <li>
                        <a href="{{route('downloads.index')}}" class=" waves-effect">
                            <i class="ri-download-line"></i>
                            <span>Downloads</span>
                        </a>
                    </li>

                    <li>
                        <a href="javascript: void(0);" class="has-arrow waves-effect">
                            <i class="ri-book-line"></i>
                            <span>Pages</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            <li><a href="{{route('pages.announcements')}}">Announcements</a></li>
                            <li><a href="{{route('pages.fundraising')}}">Fundraising</a></li>
                        </ul>
                    </li>


                    <li>
                        <a href="javascript: void(0);" class="has-arrow waves-effect">
                            <i class="ri-account-circle-line"></i>
                            <span>Profile</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            <form id="logout" method="post" action="{{route('logout')}}">
                                @csrf
                                <li><a href="{{route('register')}}">Add User</a></li>
                                <li><a href="{{route('change.password.view')}}">Change Password</a></li>
                                <li>
                                    <a href="javascript:{}"
                                       onclick="document.getElementById('logout').submit();">Logout</a>
                                </li>
                            </form>
                        </ul>
                    </li>

                    <li class="menu-title">Cell System</li>

                    <li>
                        <a href="{{route('members.index')}}" class=" waves-effect">
                            <i class="ri-user-shared-line"></i>
                            <span>Members</span>
                        </a>
                    </li>

                    <li>
                        <a href="{{route('cells.index')}}" class=" waves-effect">
                            <i class="ri-home-3-line"></i>
                            <span>Cells</span>
                        </a>
                    </li>

                </ul>
            </div>
            <!-- Sidebar -->
        </div>
    </div>
    <!-- Left Sidebar End -->


    <!-- ============================================================== -->
    <!-- Start right Content here -->
    <!-- ============================================================== -->
    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">
                <div class="row">
                    @if($message=Session::get('success'))
                        <div style="width:100%" class="alert alert-success alert-dismissible fade show" role="alert">
                            <button type="button" class="btn-close" data-dismiss="alert" aria-label="Close"><span
                                        aria-hidden="true">×</span></button>
                            <strong>Success!</strong> {{$message}}
                        </div>
                    @endif
                    @if($message=Session::get('info'))
                        <div style="width:100%" class="alert alert-info alert-dismissible fade show" role="alert">
                            <button type="button" class="btn-close" data-dismiss="alert" aria-label="Close"><span
                                        aria-hidden="true">×</span></button>
                            <strong>Information!</strong> {{$message}}
                        </div>
                    @endif
                    @if($message=Session::get('error'))
                        <div style="width:100%" class="alert alert-danger alert-dismissible fade show" role="alert">
                            <button type="button" class="btn-close" data-dismiss="alert" aria-label="Close"><span
                                        aria-hidden="true">×</span></button>
                            <strong>Error!</strong> {{$message}}
                        </div>
                    @endif
                    @if($message=Session::get('warning'))
                        <div style="width:100%" class="alert alert-warning alert-dismissible fade show" role="alert">
                            <button type="button" class="btn-close" data-dismiss="alert" aria-label="Close"><span
                                        aria-hidden="true">×</span></button>
                            <strong>Warning!</strong> {{$message}}
                        </div>
                    @endif

                </div>

                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                            <div>
                                <h4 class="mb-sm-0 heading-font">{{$heading}}</h4>
                                <ol class="breadcrumb m-0">
                                    {{$breadcrumbs}}
                                </ol>
                            </div>


                            <div class="page-title-right">
                                {{$action}}
                            </div>

                        </div>
                    </div>
                </div>
                <!-- end page title -->

                <!-- Main Section -->
                {{$slot}}
                <!-- End Main Section -->

            </div>

        </div>
        <!-- End Page-content -->

        <footer class="footer">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-6">
{{--                        <script>document.write(new Date().getFullYear())</script>--}}
                        2024 © ICA APP
                    </div>
                    <!--                    <div class="col-sm-6">
                                            <div class="text-sm-end d-none d-sm-block">
                                                Created with <i class="mdi mdi-heart text-danger"></i> by <a href="#" target="_blank">Kunozga Mlowoka</a>
                                            </div>
                                        </div>-->
                </div>
            </div>
        </footer>

    </div>
    <!-- end main content-->

</div>
<!-- END layout-wrapper -->

<!-- JAVASCRIPT -->
<script src={{asset("js/assets/metisMenu.min.js")}}></script>
<script src={{asset("js/assets/simplebar.min.js")}}></script>
<script src={{asset("js/assets/waves.min.js")}}></script>

<!-- App js -->
<script src={{asset("js/assets/app.js")}}></script>

{{--CKEditor--}}
<script src="{{asset('ckeditor/ckeditor.js')}}"></script>

@stack('scripts')

</body>
</html>
