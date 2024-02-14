<x-app-layout>

    <x-slot name="heading">
        New Downloadable Resource
    </x-slot>

    <x-slot name="breadcrumbs">
        <li class="breadcrumb-item"><a href="javascript: void(0);">ICA APP</a></li>
        <li class="breadcrumb-item"><a href="{{route('downloads.index')}}">Downloads</a></li>
        <li class="breadcrumb-item active">New</li>
    </x-slot>

    <div class="card p-40">

        <form action="{{route('downloads.store')}}" method="post" enctype="multipart/form-data">
            @csrf

            <div class="row mb-8">

                <div class="col-12 mb-8">
                    <label class="" for="title">Title</label>
                    <input class="form-control" type="text" id="title" name="title" required placeholder="Enter title">
                </div>

                <div class="col-12 mb-8">
                    <label class="" for="description">Description</label>
                    <input class="form-control" type="text" id="description" name="description" placeholder="Enter description">
                </div>

                <div class="col-12 col-sm-6 mb-8">
                    <label class="" for="type">Type</label>
                    <select name="type" id="type" class="form-control" required>
                        <option value="pdf">PDF</option>
                        <option value="ppt">PowerPoint</option>
                        <option value="video">Video</option>
                        <option value="word">Word</option>
                        <option value="excel">Worksheet</option>
                        <option value="other">Other</option>
                    </select>
                </div>

                <div class="col-12 col-sm-6 mb-8">
                    <label class="" for="start_date">Date</label>
                    <input class="form-control" type="date" id="date" name="date" required>
                </div>


                <div class="col-12 mb-8">
                    <label class="" for="path">Path</label>
                    <input class="form-control" type="text" id="path" name="path" required placeholder="Enter file path">
                </div>

{{--                <div class="col-12">--}}
{{--                    <label class="" for="description">Description</label>--}}
{{--                    <textarea class="form-control" id="description" name="description" rows="5"></textarea>--}}
{{--                </div>--}}

            </div>
            <button type="submit" class="p-btn">
                + Create
            </button>

        </form>

    </div>

    @push('scripts')
        <script type="text/javascript">
            CKEDITOR.replace('body', {
                filebrowserUploadUrl: "{{route('images.upload', ['_token' => csrf_token() ])}}",
                filebrowserUploadMethod: 'form',
                toolbar: [
                    {name: 'styles', items: ['FontSize']},
                    {name: 'basicstyles', groups: ['basicstyles', 'cleanup'], items: ['Bold', 'Italic', 'Underline',]},
                    {
                        name: 'paragraph',
                        groups: ['list', 'indent', 'blocks', 'align', 'bidi'],
                        items: ['NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote']
                    },
                    {name: 'links', items: ['Link', 'Unlink']},
                    {name: 'insert', items: ['Image', 'Table', 'HorizontalRule']},
                    {name: 'tools', items: ['Maximize']},
                ]
            });
        </script>

    @endpush


</x-app-layout>