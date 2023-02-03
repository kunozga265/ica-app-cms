<x-app-layout>
    <x-slot name="heading">
       Ministers
    </x-slot>

    <x-slot name="breadcrumbs">
        <li class="breadcrumb-item"><a href="javascript: void(0);">ICA APP</a></li>
        <li class="breadcrumb-item active">Ministers</li>
    </x-slot>

    <div class="mb-16">
        <a href="{{route('authors.create')}}" class="p-btn">+ New</a>
    </div>

    <div>
        <div class="row">
            @foreach($authors as $author)

                <div class="author col-12 col-sm-6 col-md-4 col-xl-3">
                    <a href="{{route('authors.show',$author->slug)}}">
                        <div class="card">
                            <div class="card-body" style="padding: 0">
                                <div class="image-placeholder mb-8" style="background-image: url({{asset($author->avatar)}})">
                                </div>
                                <div class="p-10">
                                    <div class="text-lg font-bold ">{{$author->suffix}} {{$author->name}}</div>
                                    <div>{{$author->title}}</div>
                                </div>

                            </div>
                        </div>
                    </a>
                </div>

            @endforeach

        </div>

    </div>

</x-app-layout>
