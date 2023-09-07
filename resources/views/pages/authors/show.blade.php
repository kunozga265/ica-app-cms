<x-app-layout>
    <x-slot name="heading">
       Ministers
    </x-slot>

    <x-slot name="breadcrumbs">
        <li class="breadcrumb-item"><a href="javascript: void(0);">ICA APP</a></li>
        <li class="breadcrumb-item"><a href="{{route('authors.index')}}">Ministers</a></li>
        <li class="breadcrumb-item active">{{$author->suffix}} {{$author->name}}</li>
    </x-slot>

    <div class="mb-16">
        <form action="{{route('authors.trash',$author->slug)}}" method="post">
            @csrf
            <div class="flex justify-between">
                <div>
                    <a href="{{route('authors.edit',$author->slug)}}" class="p-btn">Edit</a>
                    <button type="submit" class="p-btn">Delete</button>
                </div>
                <div>
                    <a href="{{route('sermons.create')}}" class="p-btn">+ New Sermon</a>
                </div>
            </div>

        </form>
    </div>

    <div>
        <div class="card">
            <div class="card-body">

                <div class="mb-8 flex">
                    <img style="max-width: 250px; margin:auto; " src="{{asset($author->avatar)}}" alt="">
                </div>

                <div class="mb-8 flex">
                    <img style="max-width: 250px; margin:auto; " src="{{asset($author->cover_image)}}" alt="">
                </div>
                <div class="text-xl font-bold text-center">{{$author->suffix}} {{$author->name}}</div>
                    <div class="text-center">{{$author->title}}</div>
                    <div class="flex justify-center">
                        <div class="big-chip ">{{$author->sermons->count()}} {{$author->sermons->count()==1?'Sermon':'Sermons'}}</div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12 col-md-6 flex">

                    </div>
                    <div class="col-12 col-md-6">

                </div>


            </div>
        </div>
        <div class="mt-16">
            <div class="row">
                @foreach($sermons as $sermon)


                    <div class="sermon col-12 col-sm-6 col-xl-3">
                        <a href="{{route('sermons.show',$sermon->slug)}}">
                            <div class="card">
                                <div class="card-body">
                                    <div>
                                        <span class="chip">{{date('M d, Y',$sermon->published_at)}}</span>
                                    </div>
                                    <div class="text-lg font-bold">{{$sermon->title}}</div>

                                    @if($sermon->series != null)
                                        <div>{{$sermon->series->title}}</div>
                                    @endif

                                    <div class="text-sm text-gray-500">{{$sermon->author->suffix}} {{$sermon->author->name}}</div>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach

            </div>
        </div>
    </div>

</x-app-layout>
