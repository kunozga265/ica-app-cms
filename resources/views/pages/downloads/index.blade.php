<x-app-layout>
    <x-slot name="heading">
        Downloads
    </x-slot>

    <x-slot name="breadcrumbs">
        <li class="breadcrumb-item"><a href="javascript: void(0);">ICA APP</a></li>
        <li class="breadcrumb-item active">Downloads</li>
    </x-slot>

    <div class="mb-16">
        <a href="{{route('downloads.create')}}" class="p-btn">+ New</a>
    </div>

    <div>


        @foreach($downloads_compound as $download_compound)

            <div class="text-lg mb-8">{{$download_compound['month']}} {{$download_compound['year']}} </div>

            <div class="row">
                @foreach($downloads = $download_compound['downloads'] as $download)


                    <div class="sermon col-12 col-sm-6 col-xl-3">
                        <form action="{{route('downloads.trash',$download->slug)}}" method="post">
                            @csrf
{{--                        <a href="{{route('downloads.show',$download->slug)}}">--}}
                            <div class="card">
                                <div class="card-body">
                                    <div>
                                        <span class="chip">{{date('M d, Y',$download->date)}}</span>
                                    </div>
                                    <div class="text-lg font-bold">{{$download->title}}</div>
                                    <div class="text-gray-500 mb-8">{{$download->description}}</div>
{{--                                    <div class="text-gray-500">{{$download->type}}</div>--}}

                                    <div>
                                        <a href="{{$download->path}}" class="p-btn" target="_blank">View</a>
                                        <a href="{{route('downloads.edit', ["slug"=>$download->slug])}}" class="p-btn secondary">Edit</a>
                                        <button type="submit" class="p-btn error">Delete</button>
                                    </div>
                                </div>
                            </div>
{{--                        </a>--}}
                        </form>
                    </div>
                @endforeach

            </div>

        @endforeach
    </div>

</x-app-layout>
