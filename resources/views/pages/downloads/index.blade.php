<x-app-layout>
    <x-slot name="title">
        Downloads
    </x-slot>

    <x-slot name="action">
        <div class="mb-16">
            <a href="{{route('downloads.create')}}" class="p-btn">+ New</a>
        </div>
    </x-slot>

    <x-slot name="heading">
        Downloads
    </x-slot>

    <x-slot name="breadcrumbs">
        <li class="breadcrumb-item"><a href="javascript: void(0);">ICA APP</a></li>
        <li class="breadcrumb-item active">Downloads</li>
    </x-slot>



    <div>


        @foreach($downloads_compound as $download_compound)

            <div class="heading-font text mb-8">{{$download_compound['month']}} {{$download_compound['year']}} </div>

            <div class="row">
                @foreach($downloads = $download_compound['downloads'] as $download)


                    <div class="sermon col-12 col-sm-6 ">
                        <form action="{{route('downloads.trash',$download->slug)}}" method="post">
                            @csrf
{{--                        <a href="{{route('downloads.show',$download->slug)}}">--}}
                            <div class="card no-cursor">
                                <div class="card-body">
                                    <div>
                                        <span class="chip">{{date('M d, Y',$download->date)}}</span>
                                    </div>
                                    <div class="text-lg heading-font">{{$download->title}}</div>
                                    <div class="text-base mb-8">{{$download->description}}</div>
{{--                                    <div class="text-mute">{{$download->type}}</div>--}}

                                    <div class="flex">
                                        <div class="flex align-items-center">
                                            <a href="{{$download->path}}" class="btn-icon info sm" target="_blank"><i class="ri-eye-line"></i></a>
                                        </div>
                                        <div class="spacer w-5"></div>
                                        <div class="flex align-items-center">
                                            <a href="{{route('downloads.edit', ["slug"=>$download->slug])}}" class="btn-icon success sm"><i class="ri-pencil-line"></i></a>
                                        </div>
                                        <div class="spacer w-5"></div>
                                        <div class="flex align-items-center">
                                            <button type="submit" class="btn-icon error sm"><i class="ri-delete-bin-line"></i></button>
                                        </div>
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
