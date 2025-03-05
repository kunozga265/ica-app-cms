<x-guest-layout>

    <x-slot name="title">
        Prayer Points // {{$prayer->title}} // {{date('M d, Y',$prayer->date)}}
    </x-slot>


        <!-- breadcrumb-area -->
        <div class="breadcrumb-area">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="breadcrumb-content">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                                    <li class="breadcrumb-item"><a href="{{route('prayer-points')}}">Prayer Points</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">{{$prayer->title}}</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- breadcrumb-area-end -->

        <!-- blog-details-area -->
        <section class="blog-details-area pb-100">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-1">
                        <div class="blog-details-social">
                            <ul class="list-wrap">
                                <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                                <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                                <li><a href="#"><i class="fab fa-linkedin-in"></i></a></li>
                                <li><a href="#"><i class="fab fa-behance"></i></a></li>
                                <li><a href="#"><i class="fas fa-share"></i></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-xl-8 col-lg-9">
                        <div class="blog-details-wrap">
                            <ul class="tgbanner__content-meta list-wrap">
                                <li>{{date('M d, Y',$prayer->date)}}</li>
{{--                                <li>0 comments</li>--}}
                            </ul>
                            <h2 class="title">{{$prayer->title}}</h2>


                            <div class="blog-details-content">
                                {!! $prayer->body !!}
                            </div>
                            <div class="blog-details-bottom">
                                <div class="row align-items-baseline">
                                    <div class="col-xl-6 col-md-7">
{{--                                        <div class="blog-details-tags">--}}
{{--                                            <ul class="list-wrap mb-0">--}}
{{--                                                <li><a href="#">technology</a></li>--}}
{{--                                                <li><a href="#">finance</a></li>--}}
{{--                                                <li><a href="#">business</a></li>--}}
{{--                                            </ul>--}}
{{--                                        </div>--}}
                                    </div>
                                    <div class="col-xl-6 col-md-5">
                                        <div class="blog-details-share">
                                            <h6 class="share-title">Share Now:</h6>
                                            <ul class="list-wrap mb-0">
                                                <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                                                <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                                                <li><a href="#"><i class="fab fa-linkedin-in"></i></a></li>
                                                <li><a href="#"><i class="fab fa-behance"></i></a></li>
                                                <li><a href="#"><i class="fab fa-youtube"></i></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="blog-prev-next-posts">
                                <div class="row">
                                    <div class="col-xl-6 col-lg-8 col-md-6">
                                        <div class="pn-post-item">
                                            @if(isset($prev))
                                            <div class="content">
                                                <span>Prev Post</span>
                                                <h5 class="title tgcommon__hover"><a href="{{route('prayer',['id'=>$prev->id])}}">{{$prev->title}}</a></h5>
                                            </div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-xl-6 col-lg-8 col-md-6">
                                        <div class="pn-post-item next-post">
                                            @if(isset($next))
                                            <div class="content">
                                                <span>Next Post</span>
                                                <h5 class="title tgcommon__hover"><a href="{{route('prayer',['id'=>$next->id])}}">{{$next->title}}</a></h5>
                                            </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-2 ">
                        <aside class="blog-sidebar">

                        </aside>
                    </div>
                </div>
            </div>
        </section>
        <!-- blog-details-area-end -->

    <!-- footer-area -->
    <footer class="footer-area footer-style-three white-bg">
        <div class="container">
            <div class="footer__logo-wrap">
                <div class="row align-items-center">
                    <div class="col-lg-3 col-md-4">
                        <div class="footer__logo logo">
                            <a href="{{route('home')}}" class="logo-dark"><img src="{{asset('images/logo-main.png')}}" alt="Logo"></a>
                            <a href="{{route('home')}}" class="logo-light"><img src="{{asset('images/logo-main.png')}}" alt="Logo"></a>
                        </div>
                    </div>
                    <div class="col-lg-9 col-md-8">
                        <div class="footer__social">
                            <ul class="list-wrap">
                                <li><a href="#"><i class="fab fa-facebook-f"></i> Facebook</a></li>
                                <li><a href="#"><i class="fab fa-twitter"></i> Twitter </a></li>
                                <li><a href="#"><i class="fab fa-youtube"></i> Youtube </a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="footer__copyright">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="copyright__text">
                            <p>Copyright <span>ICA</span> - <script>document.write(new Date().getFullYear())</script>. All Rights Reserved</p>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="copyright__menu">
                            <ul class="list-wrap">
                                <li><a href="#">Contact Us</a></li>
                                {{--                            <li><a href="#">Terms of Use</a></li>--}}
                                {{--                            <li><a href="#">Advertise</a></li>--}}
                                {{--                            <li><a href="#">Store</a></li>--}}
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- footer-area-end -->




</x-guest-layout>