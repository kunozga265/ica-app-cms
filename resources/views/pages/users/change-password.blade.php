<x-app-layout>

    <x-slot name="heading">
        Change Password
    </x-slot>

    <x-slot name="breadcrumbs">
        <li class="breadcrumb-item"><a href="javascript: void(0);">ICA APP</a></li>
        <li class="breadcrumb-item active">Change Password</li>
    </x-slot>

    <div class="card p-40">

        <form action="{{route('change.password')}}" method="post">
            @csrf

            <!-- Validation Errors -->
                <x-auth-validation-errors class="mb-4" :errors="$errors" />

            <div class="row mb-8">

                <div class="col-12 mb-8">
                    <label class="" for="currentPassword">Current Password</label>
                    <input class="form-control" type="password" id="currentPassword" name="currentPassword" required placeholder="Enter current password">
                </div>

                <div class="col-12 mb-8">
                    <label class="" for="newPassword">New Password</label>
                    <input class="form-control" type="password" id="newPassword" name="newPassword" required placeholder="Enter new password">
                </div>


            </div>
            <button type="submit" class="p-btn">
                Edit
            </button>

        </form>

    </div>

</x-app-layout>