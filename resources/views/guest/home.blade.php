<x-guest-layout>

    <x-slot name="title">
        ICA APP - Home
    </x-slot>



        <!-- slider-area -->
        <section class="slider__area fix">
            <div class="container">
                <div class="slider-active">
                    @foreach($sermons as $sermon)
                    <div class="slider__item">
                        <div class="">
                            <div style="width: 100%" class="">
                                <div class="slider__content">
                                    <ul class="tgbanner__content-meta list-wrap" data-animation-in="tg-fadeInUp" data-delay-in=".2">
                                        <li class="category"><a href="#">Sermon</a></li>
                                        <li class="md-show"><a href="#">{{$sermon->authorName()}}</a></li>
                                        <li>{{date('M d, Y',$sermon->published_at)}}</li>
                                    </ul>
                                    <h2 class="title" data-animation-in="tg-fadeInUp" data-delay-in=".6">{{$sermon->title}}</h2>
                                    <div class="md-hide" data-animation-in="tg-fadeInUp" data-delay-in="0.8">
                                        <div class="slider__img-wrap">
                                            <div class="image-placeholder avatar" style="background-image: url('{{$sermon->author->cover_image ?? $sermon->author->avatar}}')"></div>
                                            <div>{{$sermon->authorName()}}</div>
                                        </div>
                                    </div>
                                    <a href="{{route('sermon',['slug'=>$sermon->slug])}}" class="btn" data-animation-in="tg-fadeInUp" data-delay-in="1"><span class="btn-text">Read More</span> <i class="far fa-long-arrow-right"></i></a>
                                </div>
                            </div>
                            <div class="md-show" data-animation-in="tg-fadeInUp" data-delay-in="0.6">
                                <div class="slider__img-wrap">
                                    <div class="image-placeholder avatar" style="background-image: url('{{$sermon->author->cover_image ?? $sermon->author->avatar}}')"></div>
{{--                                    <img src="{{$sermon->author->cover_image ?? $sermon->author->avatar}}" class="main-img" alt="img">--}}
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </section>
        <!-- slider-area-end -->



</x-guest-layout>