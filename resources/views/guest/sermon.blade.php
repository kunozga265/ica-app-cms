<x-guest-layout>

    <x-slot name="title">
        Sermons // {{$sermon->title}} // {{date('M d, Y',$sermon->published_at)}}
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
                                    <li class="breadcrumb-item"><a href="{{route('sermons')}}">Sermons</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">{{$sermon->title}}</li>
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
                    <div class="col-xl-8 col-lg-7">
                        <div class="blog-details-wrap">
                            <ul class="tgbanner__content-meta list-wrap">
                                <li>{{date('M d, Y',$sermon->published_at)}}</li>
                                <li>0 comments</li>
                            </ul>
                            <h2 class="title">{{$sermon->title}}</h2>
                            @if($sermon->series != null)
                                <div class="sub-title">{{$sermon->series->title}}</div>
                            @endif

                            <div class="blog-details-content">
                                {!! $sermon->body !!}
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
                                                <h5 class="title tgcommon__hover"><a href="{{route('sermon',['slug'=>$prev->slug])}}">{{$prev->title}}</a></h5>
                                            </div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-xl-6 col-lg-8 col-md-6">
                                        <div class="pn-post-item next-post">
                                            @if(isset($next))
                                            <div class="content">
                                                <span>Next Post</span>
                                                <h5 class="title tgcommon__hover"><a href="{{route('sermon',['slug'=>$next->slug])}}">{{$next->title}}</a></h5>
                                            </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-4 col-md-6">
                        <aside class="blog-sidebar">
                            <div class="widget sidebar-widget">
                                <div class="tgAbout-me">
                                    <div class="tgAbout-thumb">
                                        <img src="{{asset($sermon->author->avatar)}}" alt="me">
                                    </div>
                                    <div class="tgAbout-info">
                                        <p class="intro"><span>{{$sermon->authorName()}}</span></p>
                                        <span class="designation">{{$sermon->author->title}}</span>
                                    </div>
                                    <div class="tgAbout-social">
                                        <a href="#"><i class="fab fa-facebook-f"></i></a>
                                        <a href="#"><i class="fab fa-twitter"></i></a>
                                        <a href="#"><i class="fab fa-behance"></i></a>
                                        <a href="#"><i class="fab fa-youtube"></i></a>
                                    </div>
                                </div>
                            </div>
                            @if(count($sermonSeries) > 0)
                            <div class="widget sidebar-widget widget_categories">
                                <h4 class="widget-title">Related sermons</h4>
                                <ul class="list-wrap">
                                    @foreach($sermonSeries as $sermon)
                                    <li>
                                        <div><a href="{{route('sermon',['slug' => $sermon->slug])}}">{{$sermon->title}}</a></div>
                                        <div><span class="">{{date('M d, Y',$sermon->published_at)}}</span></div>
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                            @endif
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