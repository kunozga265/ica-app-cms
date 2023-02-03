<x-app-layout>
    <x-slot name="heading">
       Series
    </x-slot>

    <x-slot name="breadcrumbs">
        <li class="breadcrumb-item"><a href="javascript: void(0);">ICA APP</a></li>
        <li class="breadcrumb-item active"><a href="{{route('series.index')}}">Series</a></li>
        <li class="breadcrumb-item active">{{$series->title}}</li>
    </x-slot>

    <div class="mb-16">
        <form action="{{route('series.trash',$series->slug)}}" method="post">
            @csrf
            <div class="flex justify-between">
                <div>
                    <a href="{{route('series.edit',$series->slug)}}" class="p-btn">Edit</a>
                    <button type="submit" class="p-btn">Delete</button>
                </div>
                <div>
                    <a href="{{route('sermons.create')}}" class="p-btn">+ New Sermon</a>
                </div>
            </div>
        </form>
    </div>

    <div>
        <div class="card p-40">
            <div class="card-body">
                <div>
                    <span class="big-chip">{{date('M d, Y',$series->first_sermon_date)}}</span>
                </div>
                <div class="text-xl font-bold">{{$series->title}}</div>
                <div>{{$series->sermons->count()}} {{$series->sermons->count()==1?'Sermon':'Sermons'}}</div>

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
