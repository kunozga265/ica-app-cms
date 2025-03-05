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

    <!-- newsletter-area -->
    <section class="newsletter-style-two style-three white-bg pt-80 pb-80">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xxl-6 col-xl-7 col-lg-8">
                    <div class="newsletter__title text-center mb-35">
                        <div class="newsletter__title-icon">
                            <i class="fas fa-envelope-open-text"></i>
                        </div>
                        <span class="sub-title">newsletter</span>
                        <h4 class="title">Receive all communication directly in your mail!</h4>
                    </div>
                    <div class="newsletter__form-wrap text-center">
                        <form action="#" class="newsletter__form">
                            <div class="newsletter__form-grp">
                                <input type="email" placeholder="Email address" required>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="flexCheckDefault">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        I agree to having my email collected and stored.
                                    </label>
                                </div>
                            </div>
                            <button class="btn" type="submit">
                                <span class="text">Subscribe</span>
                                <i class="fas fa-paper-plane"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- newsletter-area-end -->

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