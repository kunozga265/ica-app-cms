<x-app-layout>
    <x-slot name="title">
       Sermons
    </x-slot>

    <x-slot name="heading">
       Sermons
    </x-slot>

    <x-slot name="breadcrumbs">
        <li class="breadcrumb-item"><a href="javascript: void(0);">ICA APP</a></li>
        <li class="breadcrumb-item active">Sermons</li>
    </x-slot>

    <x-slot name="action">
        <div class="mb-16">
            <a href="{{route('sermons.create')}}" class="p-btn">+ New</a>
        </div>
    </x-slot>


    <div>


        @foreach($sermons_compound as $sermon_compound)

            <div class="heading-font text mb-8">{{$sermon_compound['month']}} {{$sermon_compound['year']}} </div>

            <div class="row">
                @foreach($sermons = $sermon_compound['sermons'] as $sermon)


                    <div class="sermon col-12 col-sm-6 col-xl-4">
                        <a href="{{route('sermons.show',$sermon->slug)}}">
                            <div class="card">
                                <div class="card-body">
                                    <div>
                                        <span class="chip">{{date('M d, Y',$sermon->published_at)}}</span>
                                    </div>
                                    <div class="heading-font text-lg">{{$sermon->title}}</div>

                                    @if($sermon->series != null)
                                        <div class="text-base">{{$sermon->series->title}}</div>
                                    @endif

                                    <div class="text-lg text-mute mt-16 flex align-items-center">
                                        <div class="image-placeholder avatar-sm" style="background-image: url({{asset($sermon->author->avatar)}})"></div>
                                        <div class="ml-8">
                                            <div class="text-sm text-mute">{{$sermon->author->suffix}} {{$sermon->author->name}}</div>
                                        </div>

                                    </div>

{{--                                    <div class="text-sm text-mute">{{$sermon->author->suffix}} {{$sermon->author->name}}</div>--}}
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach

            </div>

        @endforeach


    </div>
    {{$sermons_unsorted->links()}}
</x-app-layout>
