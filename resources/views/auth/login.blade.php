<x-guest-layout>
    <x-slot name="title">
        Login
    </x-slot>

    <div class="spacer"></div>

    <div class="container">
        <div class="auth-body-bg">
            <div class="bg-overlay"></div>
            <div class="wrapper-page">
                <div class="container-fluid p-0">
                    <div class="card">
                        <div class="card-body">

                            <h4 class="text-center font-size-18">Sign In</h4>

                            <div class="p-3">
                                <x-auth-session-status class="mb-4" :status="session('status')" />

                                <x-auth-validation-errors class="mb-4" :errors="$errors" />

                                <form class="form-horizontal mt-3" method="POST" action="{{ route('login') }}">
                                    @csrf

                                    <div class="form-group mb-3 row">
                                        <div class="col-12">
                                            <input class="form-control" type="email" name="email" required autofocus placeholder="Email">
                                        </div>
                                    </div>

                                    <div class="form-group mb-3 row">
                                        <div class="col-12">
                                            <input class="form-control" name="password" type="password" required placeholder="Password" autocomplete="current-password">
                                        </div>
                                    </div>

{{--                                    <div class="form-group mb-3 row">--}}
{{--                                        <div class="col-12">--}}
{{--                                            <div class="custom-control custom-checkbox">--}}
{{--                                                <input id="remember_me" type="checkbox" class="custom-control-input" name="remember">--}}
{{--                                                <label class="form-label ms-1" for="remember_me">Remember me</label>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}

                                    <div class="form-group mb-3 text-center row mt-3 pt-1">
                                        <div class="col-12">
                                            <button class="button secondary " type="submit">Log In</button>
                                        </div>
                                    </div>

                                    <!--                                <div class="form-group mb-0 row mt-2">
                                    @if (Route::has('password.request'))
                                        <div class="col-sm-7 mt-3">
                                            <a href="{{ route('password.request') }}" class="text-muted"><i class="mdi mdi-lock"></i> Forgot your password?</a>
                                        </div>
                                    @endif
                                    <div class="col-sm-5 mt-3">
                                        <a href="{{ route('register') }}" class="text-muted"><i class="mdi mdi-account-circle"></i> Create an account</a>
                                    </div>
                                </div>-->
                                </form>
                            </div>
                            <!-- end -->
                        </div>
                        <!-- end cardbody -->
                    </div>
                    <!-- end card -->
                </div>
                <!-- end container -->
            </div>
        </div>
    </div>


</x-guest-layout>
