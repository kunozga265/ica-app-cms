<x-app-layout>

    <x-slot name="heading">
        New Minister
    </x-slot>

    <x-slot name="breadcrumbs">
        <li class="breadcrumb-item"><a href="javascript: void(0);">ICA APP</a></li>
        <li class="breadcrumb-item"><a href="{{route('authors.index')}}">Ministers</a></li>
        <li class="breadcrumb-item active">New</li>
    </x-slot>

    <div class="card p-40">

        <form action="{{route('authors.store')}}" method="post" enctype="multipart/form-data">
            @csrf

            <div class="row mb-8">

                <div class="col-12 col-sm-6 mb-8">
                    <label class="" for="suffix">Suffix</label>
                    <input class="form-control" type="text" id="suffix" name="suffix" required placeholder="Dr./Rev./Mr./Mrs.">
                </div>

                <div class="col-12 col-sm-6 mb-8">
                    <label class="" for="name">Name</label>
                    <input class="form-control" type="text" id="name" name="name" required placeholder="Enter name">
                </div>

                <div class="col-12 mb-8">
                    <label class="" for="title">Title</label>
                    <input class="form-control" type="text" id="title" name="title" required placeholder="Enter title">
                </div>

                <div class="col-12 col-sm-6 mb-8">
                    <label class="" for="avatar">Avatar</label>
                    <input type="file" name="avatar" id="avatar" class="form-control">
                </div>

                <div class="col-12 col-sm-6 mb-8">
                    <label class="" for="cover_image">Cover Image</label>
                    <input type="file" name="cover_image" id="cover_image" class="form-control">
                </div>

                <div class="col-12 mb-8">
                    <label class="" for="biography">Biography</label>
                    <textarea class="form-control" id="biography" name="biography" rows="3"></textarea>
                </div>



                <div class="col-12 col-sm-6 mb-8">
                    <label class="" for="ica_pastor">Local Minister</label>
                    <input type="checkbox" id="ica_pastor" name="ica_pastor">
                </div>

            </div>
            <button type="submit" class="p-btn">
                + Create
            </button>

        </form>

    </div>

</x-app-layout>