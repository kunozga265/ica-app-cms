<x-app-layout>
    <x-slot name="title">
        Register User
    </x-slot>

    <x-slot name="action">

    </x-slot>

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
                    <label class="" for="first_name">First Name</label>
                    <input class="form-control" type="text" id="first_name" name="first_name" required placeholder="Enter First Name" :value="old('first_name')" autofocus>
                </div>
                <!-- Name -->
                <div class="col-12 mb-8">
                    <label class="" for="middle_name">Middle Name</label>
                    <input class="form-control" type="text" id="middle_name" name="middle_name" placeholder="Enter Middle Name" :value="old('middle_name')" autofocus>
                </div>
                <!-- Name -->
                <div class="col-12 mb-8">
                    <label class="" for="last_name">Last Name</label>
                    <input class="form-control" type="text" id="last_name" name="last_name" required placeholder="Enter Last Name" :value="old('last_name')" autofocus>
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
