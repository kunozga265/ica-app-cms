<x-guest-layout>

    <x-slot name="title">
        Give
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
                                <li class="breadcrumb-item active">Give</li>
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


                    <div class="section__title-wrap mb-40">
                        <div class="row align-items-end">
                            <div class="col-sm-12">
                                <div class="section__title d-flex align-items-center">
                                    {{--                                            <span class="section__sub-title">{{count($sermon_compound['sermons'])}}</span>--}}
                                    <h3 class="section__main-title ml-8">Bank</h3>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row pb-50">


                        <div class="col-12 col-sm-6">

                            <div class="sermon">
                                <ul class="tgbanner__content-meta list-wrap">
                                    <li class="category">ICA Current Account</li>
                                    {{--                                                    <li>{{$sermon->authorName()}}</li>--}}
                                </ul>
                                <h4 class="title tgcommon__hover">320347</h4>

                                <div class="text-lg text-mute mt-16 d-flex align-items-center">
                                    <div class="image-placeholder avatar"
                                         style="background-image: url({{asset('images/nb.png')}}); height: 40px; width: 40px; margin-right: 12px"></div>

                                    <div class="ml-8">
                                        <div class="text-sm text-mute">National Bank</div>
                                    </div>

                                </div>
                            </div>

                        </div>

                        <div class="col-12 col-sm-6">

                            <div class="sermon">
                                <ul class="tgbanner__content-meta list-wrap">
                                    <li class="category">ICA Building</li>
                                    {{--                                                    <li>{{$sermon->authorName()}}</li>--}}
                                </ul>
                                <h4 class="title tgcommon__hover">331627</h4>

                                <div class="text-lg text-mute mt-16 d-flex align-items-center">
                                    <div class="image-placeholder avatar"
                                         style="background-image: url({{asset('images/nb.png')}}); height: 40px; width: 40px; margin-right: 12px"></div>

                                    <div class="ml-8">
                                        <div class="text-sm text-mute">National Bank</div>
                                    </div>

                                </div>
                            </div>

                        </div>


                        <div class="col-12 col-sm-6">

                            <div class="sermon">
                                <ul class="tgbanner__content-meta list-wrap">
                                    <li class="category">ICA Cell Group</li>
                                    {{--                                                    <li>{{$sermon->authorName()}}</li>--}}
                                </ul>
                                <h4 class="title tgcommon__hover">1000388568</h4>

                                <div class="text-lg text-mute mt-16 d-flex align-items-center">
                                    <div class="image-placeholder avatar"
                                         style="background-image: url({{asset('images/nb.png')}}); height: 40px; width: 40px; margin-right: 12px"></div>

                                    <div class="ml-8">
                                        <div class="text-sm text-mute">National Bank</div>
                                    </div>

                                </div>
                            </div>

                        </div>


                    </div>


                    <div class="section__title-wrap mb-40">
                        <div class="row align-items-end">
                            <div class="col-sm-12">
                                <div class="section__title ">
                                    {{--                                            <span class="section__sub-title">{{count($sermon_compound['sermons'])}}</span>--}}

                                    <h3 class="section__main-title ml-8">Mobile Transfer</h3>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row pb-50">


                        <div class="col-12 col-sm-6">

                            <div class="sermon">
                                <ul class="tgbanner__content-meta list-wrap">
                                    <li class="category">Merchant Code</li>
                                    {{--                                                    <li>{{$sermon->authorName()}}</li>--}}
                                </ul>
                                <h4 class="title tgcommon__hover">ICABOX</h4>

                                <div class="text-lg text-mute mt-16 d-flex align-items-center">
                                    <div class="image-placeholder avatar"
                                         style="background-image: url({{asset('images/airtel_money.png')}}); height: 40px; width: 40px; margin-right: 12px"></div>

                                    <div class="ml-8">

                                        <div class="text-sm text-mute">Airtel Money</div>
                                    </div>

                                </div>
                            </div>

                        </div>

                        <div class="col-12 col-sm-6">

                            <div class="sermon">
                                <ul class="tgbanner__content-meta list-wrap">
                                    <li class="category">Agent Code</li>
                                    {{--                                                    <li>{{$sermon->authorName()}}</li>--}}
                                </ul>
                                <h4 class="title tgcommon__hover">602027</h4>

                                <div class="text-lg text-mute mt-16 d-flex align-items-center">
                                    <div class="image-placeholder avatar"
                                         style="background-image: url({{asset('images/tnmmpamba.png')}}); height: 40px; width: 40px; margin-right: 12px"></div>

                                    <div class="ml-8">
                                        <div class="text-sm text-mute">TNM Mpamba</div>
                                    </div>

                                </div>
                            </div>

                        </div>



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




</x-guest-layout>