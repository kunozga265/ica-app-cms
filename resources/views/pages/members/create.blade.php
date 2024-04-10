<x-app-layout>
    <x-slot name="title">

    </x-slot>

    <x-slot name="action">

    </x-slot>

    <x-slot name="heading">
        New Member
    </x-slot>

    <x-slot name="breadcrumbs">
        <li class="breadcrumb-item"><a href="javascript: void(0);">ICA APP</a></li>
        <li class="breadcrumb-item active"><a href="{{route('members.index')}}">Members</a></li>
        <li class="breadcrumb-item active">New</li>
    </x-slot>

    <div class="card p-40">

        <form action="{{route('members.store')}}" method="post"  enctype="multipart/form-data">
            @csrf

            <div class="row mb-8">

                <div class="col-12 col-sm-6 mb-8">
                    <label class="" for="avatar">Avatar</label>
                    <input type="file" name="avatar" id="avatar" class="form-control">
                </div>

                <div class="col-12 col-sm-6 mb-8">
                    <label class="" for="first_name">First Name</label>
                    <input class="form-control" type="text" id="first_name" name="first_name" required placeholder="Enter First Name">
                </div>

                <div class="col-12 col-sm-6 mb-8">
                    <label class="" for="middle_name">Middle Name</label>
                    <input class="form-control" type="text" id="middle_name" name="middle_name" placeholder="Enter Middle Name">
                </div>

                <div class="col-12 col-sm-6 mb-8">
                    <label class="" for="other_name">Other Names</label>
                    <input class="form-control" type="text" id="other_name" name="other_name" placeholder="Enter Other Name">
                </div>


                <div class="col-12 col-sm-6 mb-8">
                    <label class="" for="last_name">Last Name</label>
                    <input class="form-control" type="text" id="last_name" name="last_name" required placeholder="Enter Last Name">
                </div>

                <div class="col-12 col-sm-6 mb-8">
                    <label class="" for="phone_number">Phone Number</label>
                    <input class="form-control" type="text" id="phone_number" name="phone_number" placeholder="Enter Phone Number">
                </div>

                <div class="col-12 col-sm-6 mb-8">
                    <label class="" for="email">Email</label>
                    <input class="form-control" type="email" id="email" name="email" placeholder="Enter Email">
                </div>

                <div class="col-12 col-sm-6 mb-8">
                    <label class="" for="date_of_birth">Date of Birth</label>
                    <input class="form-control" type="date" id="date_of_birth" name="date_of_birth">
                </div>

                <div class="col-12 col-sm-6 mb-8">
                    <label class="" for="gender">Gender</label>
                    <select class="form-control" type="text" id="gender" name="gender" required>
                        <option value="">Select Gender</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                    </select>
                </div>

            </div>
            <button type="submit" class="p-btn">
                + Create
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