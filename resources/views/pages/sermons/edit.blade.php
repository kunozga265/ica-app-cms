<x-app-layout>

    <x-slot name="heading">
        Edit Sermon
    </x-slot>

    <x-slot name="breadcrumbs">
        <li class="breadcrumb-item"><a href="javascript: void(0);">ICA APP</a></li>
        <li class="breadcrumb-item active"><a href="{{route('sermons.index')}}">Sermons</a></li>
        <li class="breadcrumb-item active">{{$sermon->title}}</li>
    </x-slot>

    <div class="card p-40">

        <form action="{{route('sermons.update',$sermon->slug)}}" method="post">
            @csrf

            <div class="row mb-8">

                <div class="col-12 col-sm-6 mb-8">
                    <label class="" for="title">Title</label>
                    <input class="form-control" type="text" id="title" name="title" required placeholder="Enter title" value="{{$sermon->title}}">
                </div>

                <div class="col-12 col-sm-6 mb-8">
                    <label class="" for="subtitle">Subtitle</label>
                    <input class="form-control" type="text" id="subtitle" name="subtitle" placeholder="Enter title" value="{{$sermon->subtitle}}">
                </div>

                <div class="col-12 col-sm-6 mb-8">
                    <label class="" for="title">Date</label>
                    <input class="form-control" type="date" id="title" name="date" required value="{{date('Y-m-d',$sermon->published_at)}}">
                </div>

                <div class="col-12 col-sm-6 mb-8">
                    <label class="" for="author">Author</label>
                    <select class="form-control" type="text" id="author" name="author_id" required>
                        <option value="">Select Author</option>
                        @foreach($authors as $author)
                            @if($author->id == $sermon->author->id)
                                <option value="{{$author->id}}" selected>{{$author->suffix}} {{$author->name}}</option>
                            @else
                                <option value="{{$author->id}}">{{$author->suffix}} {{$author->name}}</option>
                            @endif
                        @endforeach
                    </select>
                </div>

                <div class="col-12 col-sm-6 mb-8">
                    <label class="" for="series">Series</label>
                    <select class="form-control" type="text" id="series" name="series_id">
                        <option value="">Select Series</option>
                        @foreach($series as $_series)
                            @if(isset($sermon->series))
                                @if($_series->id == $sermon->series->id)
                                    <option value="{{$_series->id}}" selected>{{$_series->title}}</option>
                                @endif
                            @else
                                <option value="{{$_series->id}}">{{$_series->title}}</option>
                            @endif
                        @endforeach
                    </select>
                </div>

                <div class="col-12 col-sm-6 mb-8">
                    <label class="" for="title">Youtube Video Id</label>
                    <input class="form-control" type="text" id="title" name="video_url" placeholder="Enter Youtube Video ID" value="{{$sermon->video_url}}">
                </div>

                <div class="col-12">
                    <label class="" for="body">Body</label>
                    <textarea class="form-control" id="body" name="body" rows="10" required>
                        {{$sermon->body}}
                    </textarea>
                </div>

            </div>
            <button type="submit" class="p-btn">
                Edit
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