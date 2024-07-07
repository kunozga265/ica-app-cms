<x-app-layout>
    <x-slot name="title">
        {{$event->title}}
    </x-slot>

    <x-slot name="action">
        <div class="mb-16">
            <form action="{{route('events.trash',$event->slug)}}" method="post">
                @csrf
                <a href="{{route('events.edit',$event->slug)}}" class="p-btn secondary">Edit</a>
                <button type="submit" class="p-btn error">Delete</button>
            </form>
        </div>
    </x-slot>
    <x-slot name="heading">
        Events
    </x-slot>

    <x-slot name="breadcrumbs">
        <li class="breadcrumb-item"><a href="javascript: void(0);">ICA APP</a></li>
        <li class="breadcrumb-item"><a href="{{route('events.index')}}">Events</a></li>
        <li class="breadcrumb-item active">{{$event->title}}</li>
    </x-slot>




    <div>
        <div class="image-placeholder avatar" style="background-color: #fafafa;background-image: url({{asset($event->image)}})"></div>
        <div class="card sermon-card p-60">
            <div class="card-body">

                {{--                <div class="mb-8 flex">--}}
                {{--                    <img style="max-width: 250px; margin:auto; " src="{{asset($author->avatar)}}" alt="">--}}
                {{--                </div>--}}

                <div class="flex justify-center">
                    <div class="big-chip ">{{date('M d, Y',$event->start_date)}}  {{$event->end_date ? "- ". date('M d, Y',$event->end_date): ""}}</div>
                </div>
                <div class="text-xl heading-font text-center">{{$event->title}}</div>
                <div class="text-center text-mute">{{$event->venue}}</div>
                <div class="text-center text-mute">{{$event->time}}</div>

                <div class="mt-60">{!! $event->body !!}</div>

            </div>

        </div>
    </div>

</x-app-layout>
