<x-app-layout>
    <x-slot name="title">
        New
    </x-slot>

    <x-slot name="action">

    </x-slot>

    @push("styles")
        <script>
            $(function () {
                const users = {!! json_encode($users) !!};
                const leaders = [{
                    label: "None",
                    value: 0
                }];

                for (let x in users) {
                    leaders.push({
                        label: users[x].last_name + " " + users[x].first_name,
                        value: users[x].id
                    })
                }

                $("#user_id").val(leaders[0].value);

                $("#leader").autocomplete({
                    source: leaders,
                    focus: function(event, ui) {
                        // prevent autocomplete from updating the textbox
                        event.preventDefault();
                        // manually update the textbox
                        $(this).val(ui.item.label);
                    },
                    select: function(event, ui) {
                        // prevent autocomplete from updating the textbox
                        event.preventDefault();
                        // manually update the textbox and hidden field
                        $(this).val(ui.item.label);
                        $("#user_id").val(ui.item.value);
                    }
                });


            });
        </script>
    @endpush

    <x-slot name="heading">
        New Cell
    </x-slot>

    <x-slot name="breadcrumbs">
        <li class="breadcrumb-item"><a href="javascript: void(0);">ICA APP</a></li>
        <li class="breadcrumb-item active"><a href="{{route('cells.index')}}">Cells</a></li>
        <li class="breadcrumb-item active">New</li>
    </x-slot>

    <div class="card p-40">

        <form action="{{route('cells.store')}}" method="post">
            @csrf

            <div class="row mb-8">

                <div class="col-12 col-sm-6 mb-8">
                    <label class="" for="name">Name</label>
                    <input class="form-control" type="text" id="name" name="name" required
                           placeholder="Enter Name">
                    @if($errors->has('name'))
                        <div class="error">{{ $errors->first('name') }}</div>
                    @endif
                </div>

                <div class="col-12 col-sm-6 mb-8">
                    <label class="" for="leader">Leader</label>
                    <input class="form-control" type="search" id="leader" name="leader" placeholder="Select Leader">
                    @if($errors->has('user_id'))
                        <div class="error">{{ $errors->first('user_id') }}</div>
                    @endif
                    <input type="hidden" id="user_id" name="user_id">
                </div>

                <div class="col-12 col-sm-6 mb-8">
                    <label class="" for="zone_id">Zone</label>
                    <select class="form-control form-select" type="text" id="zone_id" name="zone_id" required>
                        <option value="">Select Zone</option>
                        @foreach($zones as $zone)
                            <option value="{{$zone->id}}">{{$zone->name}}</option>
                        @endforeach

                    </select>
                    @if($errors->has('zone_id'))
                        <div class="error">{{ $errors->first('zone_id') }}</div>
                    @endif
                </div>

                <div class="col-12 col-sm-6 mb-8">
                    <label class="" for="balance">Balance</label>
                    <input class="form-control" type="text" id="balance" value="0" name="balance" placeholder="Enter Balance">
                    @if($errors->has('balance'))
                        <div class="error">{{ $errors->first('balance') }}</div>
                    @endif
                </div>

                <div class="col-12 mb-8">
                    <label class="" for="type">Type</label>
                    <select class="form-control form-select" type="text" id="type" name="type" required>
                        <option value="">Select Type</option>
                        <option value="1">Pastoral</option>
                        <option value="2">Zonal</option>
                        <option value="3">114 Community</option>
                        <option value="4">Extended</option>
                    </select>
                    @if($errors->has('type'))
                        <div class="error">{{ $errors->first('type') }}</div>
                    @endif
                </div>

                <div class="col-12 mb-8">
                    <label class="" for="location">Location</label>
                    <textarea class="form-control" name="location" id="location" cols="30" rows="3"></textarea>
                      @if($errors->has('location'))
                        <div class="error">{{ $errors->first('location') }}</div>
                    @endif
                </div>

                <div class="col-12 mb-8">
                    <label class="" for="details">Details</label>
                    <textarea class="form-control" name="details" id="details" cols="30" rows="10"></textarea>
                      @if($errors->has('details'))
                        <div class="error">{{ $errors->first('details') }}</div>
                    @endif
                </div>

            </div>
            <button type="submit" class="p-btn">
                + Create
            </button>

        </form>

    </div>

    @push('scripts')
        <script type="text/javascript">
            CKEDITOR.replace('details', {
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
                    // { name: 'insert', items: [ 'Image', 'Table', 'HorizontalRule'] },
                    {name: 'tools', items: ['Maximize']},
                ]
            });
        </script>
    @endpush

</x-app-layout>