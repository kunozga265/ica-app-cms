<x-app-layout>

    <x-slot name="heading">
        Fundraising
    </x-slot>

    <x-slot name="breadcrumbs">
        <li class="breadcrumb-item"><a href="javascript: void(0);">ICA APP</a></li>
        <li class="breadcrumb-item active">Fundraising Details</li>
    </x-slot>

    <div class="card p-40">

        <form action="{{route('pages.update')}}" method="post">
            @csrf

            <input type="hidden" name="name" value="fundraising">

            <div class="row mb-8">

                <div class="col-12 mb-8">
                    <label class="" for="heading">Heading</label>
                    <input class="form-control" type="text" id="heading" name="heading" required placeholder="Enter heading" value="{{$contents->heading}}">
                </div>

                <div class="col-12 mb-8">
                    <label class="" for="title">Title</label>
                    <input class="form-control" type="text" id="title" name="title" required placeholder="Enter title" value="{{$contents->title}}">
                </div>

                <div class="col-12 mb-8">
                    <label class="" for="description">Description</label>
                    <input class="form-control" type="text" id="description" name="description" placeholder="Enter description" value="{{$contents->description}}">
                </div>

                <div class="col-12 mb-8">
                    <label class="" for="image">Image URL</label>
                    <input class="form-control" type="text" id="image" name="image" placeholder="Enter image url" value="{{$contents->image}}">
                </div>

                <div class="col-12 col-sm-6 mb-8">
                    <label class="" for="target">Target</label>
                    <input class="form-control" type="text" id="target" name="target" placeholder="Enter target" value="{{$contents->target}}">
                </div>

                <div class="col-12 col-sm-6 mb-8">
                    <label class="" for="collected">Collected</label>
                    <input class="form-control" type="text" id="collected" name="collected" placeholder="Enter collected" value="{{$contents->collected}}">
                </div>

                <div class="col-12">
                    <input type="checkbox" id="activate" name="activate" {{$contents->activate == 1?'checked':''}} >
                    <label class="" for="activate">Activate</label>

                </div>

            </div>
            <button type="submit" class="p-btn">
               Update
            </button>

        </form>

    </div>



</x-app-layout>