<x-app-layout>
    <x-slot name="title">
        Prayer Points - {{$prayer->title}}
    </x-slot>

    <x-slot name="action">
        <div class="mb-16">
            <form action="{{route('prayers.trash',$prayer->id)}}" method="post">
                @csrf
                <a href="{{route('prayers.edit',$prayer->id)}}" class="p-btn secondary">Edit</a>
                <button type="submit" class="p-btn error">Delete</button>
            </form>
        </div>
    </x-slot>
    <x-slot name="heading">
        Prayer Points
    </x-slot>

    <x-slot name="breadcrumbs">
        <li class="breadcrumb-item"><a href="javascript: void(0);">ICA APP</a></li>
        <li class="breadcrumb-item"><a href="{{route('prayers.index')}}">Prayer Points</a></li>
        <li class="breadcrumb-item active">{{$prayer->title}}</li>
    </x-slot>



    <div>
        <div class="card series-card p-60 mb-16">
            <div class="card-body">
                <div class="text-center">
                    <span class="big-chip">{{date('M d, Y',$prayer->date)}}</span>
                </div>
                <div class="text-center text-xl heading-font">{{$prayer->title}}</div>
                <div class="text-center text-mute">{{$prayer->verses}}</div>

                <div class="mt-60">{!! $prayer->body !!}</div>
            </div>
        </div>

    </div>

</x-app-layout>
