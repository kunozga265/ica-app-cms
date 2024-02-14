<x-app-layout>

    <x-slot name="heading">
        Edit Announcement/Event
    </x-slot>

    <x-slot name="breadcrumbs">
        <li class="breadcrumb-item"><a href="javascript: void(0);">ICA APP</a></li>
        <li class="breadcrumb-item"><a href="{{route('events.index')}}">Announcements/Events</a></li>
        <li class="breadcrumb-item active">{{$download->title}}</li>
    </x-slot>

    <div class="card p-40">

        <form action="{{route('downloads.update',$download->slug)}}" method="post">
            @csrf

            <div class="row mb-8">

                <div class="col-12 mb-8">
                    <label class="" for="title">Title</label>
                    <input value="{{$download->title}}" class="form-control" type="text" id="title" name="title" required placeholder="Enter title">
                </div>

                <div class="col-12 mb-8">
                    <label class="" for="description">Description</label>
                    <input value="{{$download->description}}" class="form-control" type="text" id="description" name="description" placeholder="Enter description">
                </div>

                <div class="col-12 col-sm-6 mb-8">
                    <label class="" for="type">Type</label>
                    <select name="type" id="type" class="form-control" required>
                        <option {{$download->type == 'pdf'  ? 'selected' : ''}} value="pdf">PDF</option>
                        <option {{$download->type == 'ppt'  ? 'selected' : ''}} value="ppt">PowerPoint</option>
                        <option {{$download->type == 'video' ? 'selected' : ''}} value="video">Video</option>
                        <option {{$download->type == 'word'  ? 'selected' : ''}} value="word">Word</option>
                        <option {{$download->type == 'excel'  ? 'selected' : ''}} value="excel">Worksheet</option>
                        <option {{$download->type == 'other'  ? 'selected' : ''}} value="other">Other</option>
                    </select>
                </div>

                <div class="col-12 col-sm-6 mb-8">
                    <label class="" for="start_date">Date</label>
                    <input  value="{{date('Y-m-d',$download->date)}}" class="form-control" type="date" id="date" name="date" required>
                </div>


                <div class="col-12 mb-8">
                    <label class="" for="path">Path</label>
                    <input value="{{$download->path}}" class="form-control" type="text" id="path" name="path" required placeholder="Enter file path">
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