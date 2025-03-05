<x-guest-layout>

    <x-slot name="title">
        Deactivate Account
    </x-slot>


{{--    <!-- breadcrumb-area -->--}}
{{--    <div class="breadcrumb-area">--}}
{{--        <div class="container">--}}
{{--            <div class="row">--}}
{{--                <div class="col-12">--}}
{{--                    <div class="breadcrumb-content">--}}
{{--                        <nav aria-label="breadcrumb">--}}
{{--                            <ol class="breadcrumb">--}}
{{--                                <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>--}}
{{--                                <li class="breadcrumb-item active">Deactivate Account</li>--}}
{{--                            </ol>--}}
{{--                        </nav>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--    <!-- breadcrumb-area-end -->--}}

    <!-- newsletter-area -->
    <section class="newsletter-style-two white-bg style-three  pt-80 pb-80">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xxl-6 col-xl-7 col-lg-8">
                    <div class="newsletter__title text-center mb-35">

{{--                        <span class="sub-title">newsletter</span>--}}
                        <h4 class="title">Deactivate Account</h4>
                        <p>Please submit your email address to delete your account and associated data</p>
                    </div>
                    <div class="newsletter__form-wrap text-center">
                        <form action="{{route('delete-account')}}" method="post" class="">
                            @csrf
                            <div class="newsletter__form-grp">
                                <input name="email" type="email" placeholder="Email address" required>
                                <div class="form-check">
{{--                                    <input class="form-check-input" type="checkbox" id="flexCheckDefault">--}}
{{--                                    <label class="form-check-label" for="flexCheckDefault">--}}
{{--                                        I agree to having my email collected and stored.--}}
{{--                                    </label>--}}
                                </div>
                            </div>
                            <button class="btn" type="submit">
                                <span class="text">Proceed</span>
                                <i class="fas fa-arrow-alt-right"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- newsletter-area-end -->




</x-guest-layout>