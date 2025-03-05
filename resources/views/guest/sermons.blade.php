<x-guest-layout>

    <x-slot name="title">
        Sermons
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
                                <li class="breadcrumb-item active">Sermons</li>
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
                <div class="sermons col-xl-8 col-lg-7">
                    @foreach($sermons_compound as $sermon_compound)

                        <div class="section__title-wrap mb-40">
                            <div class="row align-items-end">
                                <div class="col-sm-12">
                                    <div class="section__title">
                                        {{--                                            <span class="section__sub-title">{{count($sermon_compound['sermons'])}}</span>--}}
                                        <h3 class="section__main-title">{{$sermon_compound['month']}} {{$sermon_compound['year']}}</h3>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row pb-50">
                            @foreach($sermons = $sermon_compound['sermons'] as $sermon)

                                <div class="col-12 col-sm-6">

                                    <div class="sermon">
                                        <ul class="tgbanner__content-meta list-wrap">
                                            <li class="category">{{date('M d, Y',$sermon->published_at)}}</li>
                                            {{--                                                    <li>{{$sermon->authorName()}}</li>--}}
                                        </ul>
                                        <h4 class="title tgcommon__hover"><a
                                                    href="{{route('sermon',$sermon->slug)}}">{{$sermon->title}} </a>
                                        </h4>
                                        {{--                                                @if($sermon->series != null)--}}
                                        {{--                                                    <div class="text-base">{{$sermon->series->title}}</div>--}}
                                        {{--                                                @endif--}}

                                        <div class="text-lg text-mute mt-16 d-flex align-items-center">
                                            <div class="image-placeholder avatar"
                                                 style="background-image: url({{asset($sermon->author->avatar)}})"></div>
                                            <div class="ml-8">
                                                <div class="text-sm text-mute">{{$sermon->authorName()}}</div>
                                            </div>

                                        </div>
                                    </div>

                                </div>
                            @endforeach

                        </div>

                    @endforeach

                    <div class="pagination__wrap">
                        {{$unsorted->links()}}
                    </div>

                </div>
                <div class="col-xl-3 col-lg-4 col-md-6">
                    <aside class="blog-sidebar">
                        {{--                            @if(count($sermonSeries) > 0)--}}
                        {{--                            <div class="widget sidebar-widget widget_categories">--}}
                        {{--                                <h4 class="widget-title">Related sermons</h4>--}}
                        {{--                                <ul class="list-wrap">--}}
                        {{--                                    @foreach($sermonSeries as $sermon)--}}
                        {{--                                    <li>--}}
                        {{--                                        <div><a href="{{route('sermon',['slug' => $sermon->slug])}}">{{$sermon->title}}</a></div>--}}
                        {{--                                        <div><span class="">{{date('M d, Y',$sermon->published_at)}}</span></div>--}}
                        {{--                                    </li>--}}
                        {{--                                    @endforeach--}}
                        {{--                                </ul>--}}
                        {{--                            </div>--}}
                        {{--                            @endif--}}
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