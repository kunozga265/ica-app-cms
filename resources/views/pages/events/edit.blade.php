<x-app-layout>

    <x-slot name="heading">
        Edit Announcement/Event
    </x-slot>

    <x-slot name="breadcrumbs">
        <li class="breadcrumb-item"><a href="javascript: void(0);">ICA APP</a></li>
        <li class="breadcrumb-item"><a href="{{route('events.index')}}">Announcements/Events</a></li>
        <li class="breadcrumb-item active">{{$event->title}}</li>
    </x-slot>

    <div class="card p-40">

        <form action="{{route('events.update',$event->slug)}}" method="post" enctype="multipart/form-data">
            @csrf

            <div class="row mb-8">

                <div class="mb-8 flex">
                    <img style="max-width: 250px; margin:auto; " src="{{asset($event->image)}}" alt="">
                </div>

                <div class="col-12 col-sm-6 mb-8">
                    <label class="" for="title">Title</label>
                    <input value="{{$event->title}}" class="form-control" type="text" id="title" name="title" required placeholder="Enter title" >
                </div>

                <div class="col-12 col-sm-6 mb-8">
                    <label class="" for="venue">Venue</label>
                    <input  value="{{$event->venue}}" class="form-control" type="text" id="venue" name="venue" placeholder="Enter venue">
                </div>

                <div class="col-12 col-sm-6 mb-8">
                    <label class="" for="start_date">Start Date</label>
                    <input value="{{date('Y-m-d',$event->start_date)}}" class="form-control" type="date" id="start_date" name="start_date" required>
                </div>

                <div class="col-12 col-sm-6 mb-8">
                    <label class="" for="end_date">End Date</label>
                    @if($event->end_date != null)
                        <input value="{{date('Y-m-d',$event->end_date)}}"  class="form-control" type="date" id="end_date" name="end_date">
                    @else
                        <input class="form-control" type="date" id="end_date" name="end_date">
                    @endif
                    <span class="grey--text">(For a durational event)</span>
                </div>

                <div class="col-12 col-sm-6 mb-8">
                    <label class="" for="time">Time</label>
                    <input value="{{$event->time}}" class="form-control" type="text" id="time" name="time" placeholder="Enter Time">
                </div>

                <div class="col-12 col-sm-6 mb-8">
                    <label class="" for="image">Image</label>
                    <input type="file" name="image" id="image" class="form-control">
                </div>

                <div class="col-12">
                    <label class="" for="body">Body</label>
                    <textarea class="form-control" id="body" name="body" rows="10">
                         {{$event->body}}
                    </textarea>
                </div>



            </div>
            <button type="submit" class="p-btn">
                Update
            </button>

        </form>

    </div>

    @push('scripts')
        <script type="text/javascript">
            CKEDITOR.replace('body', {
                filebrowserUploadUrl: "{{route('images.upload', ['_token' => csrf_token() ])}}",
                filebrowserUploadMethod: 'form',
                toolbar:[
                    { name: 'styles', items: [ 'FontSize' ] },
                    { name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ], items: [ 'Bold', 'Italic', 'Underline',] },
                    { name: 'paragraph', groups: [ 'list', 'indent', 'blocks', 'align', 'bidi' ], items: [ 'NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote'] },
                    { name: 'links', items: [ 'Link', 'Unlink'] },
                    { name: 'insert', items: [ 'Image', 'Table', 'HorizontalRule'] },
                    { name: 'tools', items: [ 'Maximize'] },
                ]
            });
        </script>
    @endpush
</x-app-layout>