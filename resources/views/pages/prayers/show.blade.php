<x-app-layout>
    <x-slot name="heading">
        Prayer Points
    </x-slot>

    <x-slot name="breadcrumbs">
        <li class="breadcrumb-item"><a href="javascript: void(0);">ICA APP</a></li>
        <li class="breadcrumb-item"><a href="{{route('prayers.index')}}">Prayer Points</a></li>
        <li class="breadcrumb-item active">{{$prayer->title}}</li>
    </x-slot>

    <div class="mb-16">
        <form action="{{route('prayers.trash',$prayer->id)}}" method="post">
            @csrf
            <a href="{{route('prayers.edit',$prayer->id)}}" class="p-btn">Edit</a>
            <button type="submit" class="p-btn">Delete</button>
        </form>
    </div>

    <div>
        <div class="card p-20 mb-16">
            <div class="card-body">
                <div>
                    <span class="big-chip">{{date('M d, Y',$prayer->date)}}</span>
                </div>
                <div class="text-xl font-bold">{{$prayer->title}}</div>
                <div class="text-gray-500">{{$prayer->verses}}</div>
            </div>
        </div>
        <div class="card p-20">
            <div>{!! $prayer->body !!}</div>
        </div>
        
    </div>

</x-app-layout>
