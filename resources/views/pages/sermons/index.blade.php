<x-app-layout>
    <x-slot name="heading">
       Sermons
    </x-slot>

    <x-slot name="breadcrumbs">
        <li class="breadcrumb-item"><a href="javascript: void(0);">ICA APP</a></li>
        <li class="breadcrumb-item active">Sermons</li>
    </x-slot>

    <div class="mb-16">
        <a href="{{route('sermons.create')}}" class="p-btn">+ New</a>
    </div>

    <div>


        @foreach($sermons_compound as $sermon_compound)

            <div class="text-lg mb-8">{{$sermon_compound['month']}} {{$sermon_compound['year']}} </div>

            <div class="row">
                @foreach($sermons = $sermon_compound['sermons'] as $sermon)


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

        @endforeach
    </div>

</x-app-layout>
