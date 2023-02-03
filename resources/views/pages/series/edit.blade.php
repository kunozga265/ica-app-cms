<x-app-layout>

    <x-slot name="heading">
        Edit Series
    </x-slot>

    <x-slot name="breadcrumbs">
        <li class="breadcrumb-item"><a href="javascript: void(0);">ICA APP</a></li>
        <li class="breadcrumb-item active"><a href="{{route('series.index')}}">Series</a></li>
        <li class="breadcrumb-item active">{{$series->title}}</li>
    </x-slot>

    <div class="card p-40">

        <form action="{{route('series.update',$series->slug)}}" method="post">
            @csrf

            <div class="row mb-8">

                <div class="col-12 mb-8">
                    <label class="" for="title">Title</label>
                    <input class="form-control" type="text" id="title" name="title" required placeholder="Enter title" value="{{$series->title}}">
                </div>

                <div class="col-12">
                    <label class="" for="description">Description</label>
                    <textarea class="form-control" id="description" name="description" rows="3">{{$series->description}}</textarea>
                </div>

            </div>
            <button type="submit" class="p-btn">
                Edit
            </button>

        </form>

    </div>

</x-app-layout>