<x-app-layout>
    <x-slot name="heading">
      Events
    </x-slot>

    <x-slot name="breadcrumbs">
        <li class="breadcrumb-item"><a href="javascript: void(0);">ICA APP</a></li>
        <li class="breadcrumb-item active">event Points</li>
    </x-slot>

    <div class="mb-16">
        <a href="{{route('events.create')}}" class="p-btn">+ New</a>
    </div>

    <div>


        @foreach($events_compound as $event_compound)

            <div class="text-lg mb-8">{{$event_compound['month']}} {{$event_compound['year']}} </div>

            <div class="row">
                @foreach($events = $event_compound['events'] as $event)


                    <div class="sermon col-12 col-sm-6 col-xl-3">
                        <a href="{{route('events.show',$event->slug)}}">
                            <div class="card">
                                <div class="card-body">
                                    <div>
                                        <span class="chip">{{date('M d, Y',$event->start_date)}}</span>
                                    </div>
                                    <div class="text-lg font-bold">{{$event->title}}</div>
                                    <div class="text-gray-500">{{$event->venue}}</div>
                                    <div class="text-gray-500">{{$event->time}}</div>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach

            </div>

        @endforeach
    </div>

</x-app-layout>
