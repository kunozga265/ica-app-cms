<x-app-layout>
    <x-slot name="title">
        New
    </x-slot>

    <x-slot name="action">

    </x-slot>

    <x-slot name="heading">
        Edit Member
    </x-slot>

    <x-slot name="breadcrumbs">
        <li class="breadcrumb-item"><a href="javascript: void(0);">ICA APP</a></li>
        <li class="breadcrumb-item active"><a href="{{route('members.index')}}">Members</a></li>
        <li class="breadcrumb-item active">{{ $member->fullName() }}</li>
    </x-slot>

    <div class="card p-40">

          <div class="col-12 col-sm-6 mb-8 flex">
                    <img style="max-width: 250px; margin:auto; " src="{{asset($member->avatar)}}" alt="">
                </div>

        <form action="{{route('members.update',["code" => $member->code])}}" method="post"  enctype="multipart/form-data">
            @csrf

            <div class="row mb-8">

                <div class="col-12 col-sm-6 mb-8">
                    <label class="" for="avatar">Avatar</label>
                    <input type="file" name="avatar" id="avatar" class="form-control">
                </div>

                <div class="col-12 col-sm-6 mb-8">
                    <label class="" for="first_name">First Name</label>
                    <input class="form-control" type="text" id="first_name" name="first_name" required placeholder="Enter First Name" value="{{$member->first_name}}">
                </div>

                <div class="col-12 col-sm-6 mb-8">
                    <label class="" for="middle_name">Middle Name</label>
                    <input class="form-control" type="text" id="middle_name" name="middle_name" placeholder="Enter Middle Name" value="{{$member->middle_name}}">
                </div>

                <div class="col-12 col-sm-6 mb-8">
                    <label class="" for="other_name">Other Names</label>
                    <input class="form-control" type="text" id="other_name" name="other_name" placeholder="Enter Other Name" value="{{$member->other_name}}">
                </div>


                <div class="col-12 col-sm-6 mb-8">
                    <label class="" for="last_name">Last Name</label>
                    <input class="form-control" type="text" id="last_name" name="last_name" required placeholder="Enter Last Name" value="{{$member->last_name}}">
                </div>

                <div class="col-12 col-sm-6 mb-8">
                    <label class="" for="phone_number_airtel">Phone Number (Airtel)</label>
                    <div style="position: relative">
                        <div style="position: absolute;  padding:9px 12px" class="">+2659</div>
                        <input maxlength="8" style="padding-left:52px" class="form-control" type="text" id="phone_number_airtel" name="phone_number_airtel" placeholder="xxxxxxxx" value="{{$member->phone_number_airtel}}">
                    </div>
                </div>
                <div class="col-12 col-sm-6 mb-8">
                    <label class="" for="phone_number_tnm">Phone Number (TNM)</label>
                    <div style="position: relative">
                        <div style="position: absolute;  padding:9px 12px" class="">+2658</div>
                        <input maxlength="8" style="padding-left:52px" class="form-control" type="text" id="phone_number_tnm" name="phone_number_tnm" placeholder="xxxxxxxx" value="{{$member->phone_number_tnm}}">
                    </div>
                </div>
                <div class="col-12 col-sm-6 mb-8">
                    <label class="" for="phone_number_international">Phone Number (International)</label>
                    <div style="position: relative">
                        <div style="position: absolute;  padding:9px 12px" class="">+</div>
                        <input style="padding-left:20px" class="form-control" type="text" id="phone_number_international" name="phone_number_international" placeholder="xxxxxxxxxx" value="{{$member->phone_number_international}}">
                    </div>
                </div>

                <div class="col-12 col-sm-6 mb-8">
                    <label class="" for="email">Email</label>
                    <input class="form-control" type="email" id="email" name="email" placeholder="Enter Email" value="{{$member->email}}">
                </div>

                <div class="col-12 col-sm-6 mb-8">
                    <label class="" for="date_of_birth">Date of Birth</label>
                    <input class="form-control" type="date" id="date_of_birth" name="date_of_birth" value="{{date('Y-m-d',$member->date_of_birth    )}}">
                </div>

                <div class="col-12 col-sm-6 mb-8">
                    <label class="" for="gender">Gender</label>
                    <select class="form-control" type="text" id="gender" name="gender" required value="{{$member->gender}}">
                        <option value="">Select Gender</option>
                        <option value="Male" {{ $member->gender == 'Male' ? 'selected' : '' }}>Male</option>
                        <option value="Female" {{ $member->gender == 'Female' ? 'selected' : '' }}>Female</option>
                    </select>
                </div>

            </div>
            <button type="submit" class="p-btn">
                Update
            </button>

        </form>

    </div>

    @push('scripts')
        <script type="text/javascript">
            CKEDITOR.replace('description', {
                filebrowserUploadUrl: "{{route('images.upload', ['_token' => csrf_token() ])}}",
                filebrowserUploadMethod: 'form',
                toolbar:[
                    { name: 'styles', items: [ 'FontSize' ] },
                    { name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ], items: [ 'Bold', 'Italic', 'Underline',] },
                    { name: 'paragraph', groups: [ 'list', 'indent', 'blocks', 'align', 'bidi' ], items: [ 'NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote'] },
                    { name: 'links', items: [ 'Link', 'Unlink'] },
                    // { name: 'insert', items: [ 'Image', 'Table', 'HorizontalRule'] },
                    { name: 'tools', items: [ 'Maximize'] },
                ]
            });
        </script>
    @endpush

</x-app-layout>