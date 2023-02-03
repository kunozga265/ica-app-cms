<x-app-layout>
    <x-slot name="heading">
       Prayer Points
    </x-slot>

    <x-slot name="breadcrumbs">
        <li class="breadcrumb-item"><a href="javascript: void(0);">ICA APP</a></li>
        <li class="breadcrumb-item active">Prayer Points</li>
    </x-slot>

    <div class="mb-16">
        <a href="{{route('prayers.create')}}" class="p-btn">+ New</a>
    </div>

    <div>


        @foreach($prayers_compound as $prayer_compound)

            <div class="text-lg mb-8">{{$prayer_compound['month']}} {{$prayer_compound['year']}} </div>

            <div class="row">
                @foreach($prayers = $prayer_compound['points'] as $prayer)


                    <div class="sermon col-12 col-sm-6 col-xl-3">
                        <a href="{{route('prayers.show',$prayer->id)}}">
                            <div class="card">
                                <div class="card-body">
                                    <div>
                                        <span class="chip">{{date('M d, Y',$prayer->date)}}</span>
                                    </div>
                                    <div class="text-lg font-bold">{{$prayer->title}}</div>
                                    <div class="text-gray-500">{{$prayer->verses}}</div>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach

            </div>

        @endforeach
    </div>

</x-app-layout>
