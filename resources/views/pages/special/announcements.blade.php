<x-app-layout>

    <x-slot name="heading">
        Announcements
    </x-slot>

    <x-slot name="breadcrumbs">
        <li class="breadcrumb-item"><a href="javascript: void(0);">ICA APP</a></li>
        <li class="breadcrumb-item active">Announcements</li>
    </x-slot>

    <div class="card p-40">

        <form action="{{route('pages.update')}}" method="post">
            @csrf

            <input type="hidden" name="name" value="announcements">

            <div class="row mb-8">

                <div class="col-12 mb-8">
                    <label class="" for="body">Body</label>
                    <textarea class="form-control" id="body" name="body" rows="10">
                        {!! $contents->body !!}
                    </textarea>
                </div>

                <div class="col-12">
                    <input type="checkbox" id="activate" name="activate" {{$contents->activate == 1?'checked':''}} >
                    <label class="" for="activate">Activate</label>
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