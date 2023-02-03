<x-app-layout>

    <x-slot name="heading">
        New Sermon
    </x-slot>

    <x-slot name="breadcrumbs">
        <li class="breadcrumb-item"><a href="javascript: void(0);">ICA APP</a></li>
        <li class="breadcrumb-item active"><a href="{{route('sermons.index')}}">Sermons</a></li>
        <li class="breadcrumb-item active">New</li>
    </x-slot>

    <div class="card p-40">

        <form action="{{route('sermons.store')}}" method="post">
            @csrf

            <div class="row mb-8">

                <div class="col-12 col-sm-6 mb-8">
                    <label class="" for="title">Title</label>
                    <input class="form-control" type="text" id="title" name="title" required placeholder="Enter title">
                </div>

                <div class="col-12 col-sm-6 mb-8">
                    <label class="" for="title">Date</label>
                    <input class="form-control" type="date" id="title" name="date" required>
                </div>

                <div class="col-12 col-sm-6 mb-8">
                    <label class="" for="author">Author</label>
                    <select class="form-control" type="text" id="author" name="author_id" required>
                        <option value="">Select Author</option>
                        @foreach($authors as $author)
                            <option value="{{$author->id}}">{{$author->suffix}} {{$author->name}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-12 col-sm-6 mb-8">
                    <label class="" for="series">Series</label>
                    <select class="form-control" type="text" id="series" name="series_id">
                        <option value="">Select Series</option>
                        @foreach($series as $_series)
                            <option value="{{$_series->id}}">{{$_series->title}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-12 mb-8">
                    <label class="" for="title">Youtube Video Id</label>
                    <input class="form-control" type="text" id="title" name="video_url" placeholder="Enter Youtube Video ID">
                </div>

                <div class="col-12">
                    <label class="" for="body">Body</label>
                    <textarea class="form-control" id="body" name="body" rows="10" required></textarea>
                </div>

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

        <script>
            $( function() {
                var availableTags = [
                    "ActionScript",
                    "AppleScript",
                    "Asp",
                    "BASIC",
                    "C",
                    "C++",
                    "Clojure",
                    "COBOL",
                    "ColdFusion",
                    "Erlang",
                    "Fortran",
                    "Groovy",
                    "Haskell",
                    "Java",
                    "JavaScript",
                    "Lisp",
                    "Perl",
                    "PHP",
                    "Python",
                    "Ruby",
                    "Scala",
                    "Scheme"
                ];

                $( "#tags" ).autocomplete({
                    source: availableTags
                });
/*
                var authors={!! json_encode($authors->toArray()) !!};
                $( "#author" ).autocomplete({
                    source: authors
                });

                var series={!! json_encode($series->toArray()) !!};
                $( "#series" ).autocomplete({
                    source: series
                });*/


            } );
        </script>
    @endpush



</x-app-layout>