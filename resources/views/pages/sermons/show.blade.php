<x-app-layout>
    <x-slot name="heading">
       Sermon
    </x-slot>

    <x-slot name="breadcrumbs">
        <li class="breadcrumb-item"><a href="javascript: void(0);">ICA APP</a></li>
        <li class="breadcrumb-item active"><a href="{{route('sermons.index')}}">Sermons</a></li>
        <li class="breadcrumb-item active">{{$sermon->title}}</li>
    </x-slot>

    <div class="mb-16">
        <form action="{{route('sermons.trash',$sermon->slug)}}" method="post">
            @csrf
            <div class="flex justify-between">
                <div>
                    <a href="{{route('sermons.edit',$sermon->slug)}}" class="p-btn">Edit</a>
                    <button type="submit" class="p-btn error">Delete</button>
                </div>
                <div>
                    <a href="{{route('authors.show',['slug'=>$sermon->author->slug])}}" class="p-btn">Author</a>
                    @if(isset($sermon->series))
                        <a href="{{route('series.show',['slug'=>$sermon->series->slug])}}" class="p-btn">Series</a>
                    @endif
                </div>
            </div>
        </form>
    </div>

    <div>
        <div class="card p-40 mb-16">
            <div class="card-body">
                <div>
                    <span class="big-chip">{{date('M d, Y',$sermon->published_at)}}</span>
                </div>
                <div class="text-xl font-bold">{{$sermon->title}}</div>

                @if($sermon->series != null)
                    <div class="text-lg">{{$sermon->series->title}}</div>
                @endif

                <div class="text-lg text-gray-500 mb-16 mt-16 flex">
                    <div class="image-placeholder avatar" style="background-image: url({{asset($sermon->author->avatar)}})"></div>
                    <div class="ml-8">
                        <div class="text-base text-black-900">{{$sermon->author->suffix}} {{$sermon->author->name}}</div>
                        <div class="text-sm text-gray-500">{{$sermon->author->title}}</div>
                    </div>

                </div>
            </div>
        </div>
        <div class="card p-20">{!! $sermon->body !!}</div>
    </div>

</x-app-layout>
