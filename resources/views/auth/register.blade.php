<x-app-layout>

    <x-slot name="heading">
        Register user
    </x-slot>

    <x-slot name="breadcrumbs">
        <li class="breadcrumb-item"><a href="javascript: void(0);">ICA APP</a></li>
        <li class="breadcrumb-item active">Register User</li>
    </x-slot>

    <div class="card p-40">


        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div class="row mb-8">
                <!-- Name -->
                <div class="col-12 mb-8">
                    <label class="" for="name">Name</label>
                    <input class="form-control" type="text" id="name" name="name" required placeholder="Enter name" :value="old('name')" autofocus>
                </div>

                <!-- Email Address -->
                 <div class="col-12 mb-8">
                    <label class="" for="email">Email</label>
                    <input class="form-control" type="email" id="email" name="email" required placeholder="Enter email" :value="old('email')">
                </div>

                <div class="col-12 mb-8">
                    <label class="" for="password">Password</label>
                    <input class="form-control" type="password" id="password" name="password" required placeholder="Enter password">
                </div>

                <div class="col-12 mb-8">
                    <label class="" for="password_confirmation">Confirmation Password</label>
                    <input class="form-control" type="password" id="password_confirmation" name="password_confirmation" required placeholder="Enter password again">
                </div>
            </div>

            <button type="submit" class="p-btn">
                Register
            </button>
        </form>
    </div>
</x-app-layout>
