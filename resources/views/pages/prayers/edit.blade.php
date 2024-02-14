<x-app-layout>

    <x-slot name="heading">
        Edit Prayer Points
    </x-slot>

    <x-slot name="breadcrumbs">
        <li class="breadcrumb-item"><a href="javascript: void(0);">ICA APP</a></li>
        <li class="breadcrumb-item active"><a href="{{route('prayers.index')}}">{Prayer Points}</a></li>
        <li class="breadcrumb-item active">{{$prayer->title}}</li>
    </x-slot>

    <div class="card p-40">

        <form action="{{route('prayers.update',$prayer->id)}}" method="post">
            @csrf

            <div class="row mb-8">

                <div class="col-12 col-sm-6 mb-8">
                    <label class="" for="title">Title</label>
                    <input class="form-control" type="text" id="title" name="title" required placeholder="Enter title" value="{{$prayer->title}}">
                </div>

                <div class="col-12 col-sm-6 mb-8">
                    <label class="" for="title">Date</label>
                    <input class="form-control" type="date" id="title" name="date" required value="{{date('Y-m-d',$prayer->date)}}">
                </div>

                <div class="col-12 mb-8">
                    <label class="" for="verses">Verses</label>
                    <input class="form-control" type="text" id="verses" name="verses" placeholder="Enter Verses" value="{{$prayer->verses}}">
                </div>

                <div class="col-12">
                    <label class="" for="body">Body</label>
                    <textarea class="form-control" id="body" name="body" rows="10" required>
                        {{$prayer->body}}
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