<x-app-layout>
    <x-slot name="heading">
        Events
    </x-slot>

    <x-slot name="breadcrumbs">
        <li class="breadcrumb-item"><a href="javascript: void(0);">ICA APP</a></li>
        <li class="breadcrumb-item"><a href="{{route('events.index')}}">Announcements/Events</a></li>
        <li class="breadcrumb-item active">{{$event->title}}</li>
    </x-slot>

    <div class="mb-16">
        <form action="{{route('events.trash',$event->slug)}}" method="post">
            @csrf
            <a href="{{route('events.edit',$event->slug)}}" class="p-btn">Edit</a>
            <button type="submit" class="p-btn">Delete</button>
        </form>
    </div>

    <div>

        <div class="card p-20 mb-16">
            <div class="card-body">
                <div class="mb-8 flex">
                    <img style="max-width: 250px; margin:auto; " src="{{asset($event->image)}}" alt="">
                </div>
                <div>
                    <span class="big-chip">{{date('M d, Y',$event->start_date)}}  {{$event->end_date ? "- ". date('M d, Y',$event->end_date): ""}}</span>
                </div>
                <div class="text-xl font-bold">{{$event->title}}</div>
                <div class="text-gray-500">{{$event->venue}}</div>
                <div class="text-gray-500">{{$event->time}}</div>
            </div>
        </div>
        <div class="card p-20">
            <div>{!! $event->body !!}</div>
        </div>
        
    </div>

</x-app-layout>
