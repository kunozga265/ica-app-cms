<x-app-layout>
    <x-slot name="heading">
       Series
    </x-slot>

    <x-slot name="breadcrumbs">
        <li class="breadcrumb-item"><a href="javascript: void(0);">ICA APP</a></li>
        <li class="breadcrumb-item active">Series</li>
    </x-slot>

    <div class="mb-16">
        <a href="{{route('series.create')}}" class="p-btn">+ New</a>
    </div>

    <div>
        <div class="row">
            @foreach($series as $_series)


                <div class="sermon col-12 col-sm-6 col-xl-3">
                    <a href="{{route('series.show',$_series->slug)}}">
                        <div class="card">
                            <div class="card-body">
                                <div>
                                    <span class="chip">{{date('M d, Y',$_series->first_sermon_date)}}</span>
                                </div>
                                <div class="text-lg font-bold">{{$_series->title}}</div>
                                <div>{{$_series->sermons->count()}} {{$_series->sermons->count()==1?'Sermon':'Sermons'}}</div>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach

        </div>

    </div>

</x-app-layout>
