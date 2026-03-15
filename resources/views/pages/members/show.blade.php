<x-app-layout>
    @push("styles")
        <script>
            $(function () {
                const cells = {!! json_encode($cells) !!};
                const arr = [{
                    label: "None",
                    value: 0,
                    object: null
                }];

                for (let x in cells) {
                    arr.push({
                        label: cells[x].name,
                        value: cells[x].id,
                        object: cells[x]
                    })
                }

                $("#cell_id").val(arr[0].value);
                $("#details").hide()

                $("#cell").autocomplete({
                    source: arr,
                    focus: function (event, ui) {
                        // prevent autocomplete from updating the textbox
                        event.preventDefault();
                        // manually update the textbox
                        $(this).val(ui.item.label);
                    },
                    select: function (event, ui) {
                        // prevent autocomplete from updating the textbox
                        event.preventDefault();
                        // manually update the textbox and hidden field
                        $(this).val(ui.item.label);
                        $("#cell_id").val(ui.item.value);
                        console.log(ui)
                        $("#details").show()
                        $("#first_name").text(ui.item.object.first_name);
                        $("#middle_name").text(ui.item.object.middle_name);
                        $("#last_name").text(ui.item.object.last_name);
                        $("#gender").text(ui.item.object.gender);
                        $("#phone_number").text(ui.item.object.phone_number);
                        $("#email").text(ui.item.object.email);

                    }
                });

                const users = {!! json_encode($users) !!};
                const arr_users = [{
                    label: "None",
                    value: 0,
                    object: null
                }];

                for (let x in users) {
                    arr_users.push({
                        label: users[x].first_name + " " + users[x].last_name,
                        value: users[x].id,
                        object: users[x]
                    })
                }

                $("#user_id").val(arr_users[0].value);
                console.log(arr_users);

                $("#user").autocomplete({
                    source: arr_users,
                    focus: function (event, ui) {
                        // prevent autocomplete from updating the textbox
                        event.preventDefault();
                        // manually update the textbox
                        console.log(ui)
                        $(this).val(ui.item.label);
                    },
                    select: function (event, ui) {
                        // prevent autocomplete from updating the textbox
                        event.preventDefault();
                        // manually update the textbox and hidden field
                        $(this).val(ui.item.label);
                        $("#user_id").val(ui.item.value);
                        console.log(ui)
                    }
                });

                //     Chart
                const chartData = {!! json_encode($chartData) !!};

                console.log(chartData);

                options = {
                    chart: {
                        height: 350, type: "bar",
                    },
                    stroke: {width: [0, 2, 4], curve: "smooth"},
                    plotOptions: {bar: {columnWidth: "20%", rangeBarOverlap: false,}},
                    colors: ["#1cbb8c", "#fcb92c", "#0f9cf3"],
                    series: [{name: "Attendance", data: chartData.data},
                        //     {
                        //     name: "Team B",
                        //     type: "area",
                        //     data: [44, 55, 41, 67, 22, 43, 21, 41, 56, 27, 43]
                        // }, {name: "Team C", type: "line", data: [30, 25, 36, 30, 45, 35, 64, 52, 59, 36, 39]}
                    ],
                    fill: {
                        opacity: [.85, .25, 1],
                        gradient: {
                            inverseColors: !1,
                            shade: "light",
                            type: "vertical",
                            opacityFrom: .85,
                            opacityTo: .55,
                            stops: [0, 100, 100, 100]
                        }
                    },
                    dataLabels: {enabled: !1},
                    labels: chartData.labels,
                    markers: {size: 0},
                    xaxis: {
                        type: "datetime", labels: {
                            datetimeUTC: false,
                        }
                    },
                    yaxis: {title: {text: "Members"}, show: false},
                    tooltip: {
                        enabled: false,
                        shared: !0, intersect: !1, y: {
                            formatter: function (e) {
                                return void 0 !== e ? e.toFixed(0) + " member(s)" : e
                            }
                        }
                    },
                    grid: {borderColor: "#f1f1f1", padding: {bottom: 10}},
                    legend: {offsetY: 7}
                };
                (chart = new ApexCharts(document.querySelector("#member_chart"), options)).render();


            });
        </script>
    @endpush

    <x-slot name="title">
        {{$member->fullName()}}
    </x-slot>

    <x-slot name="action">
        {{--        <div class="mb-16">--}}
        {{--            <form action="{{route('series.trash',$series->slug)}}" method="post">--}}
        {{--                @csrf--}}
        {{--                <div class="flex justify-between">--}}
        {{--                    <div>--}}
        {{--                        <a href="{{route('series.edit',$series->slug)}}" class="p-btn">Edit</a>--}}
        {{--                        <button type="submit" class="p-btn">Delete</button>--}}
        {{--                    </div>--}}
        {{--                    <div>--}}
        {{--                        <a href="{{route('sermons.create')}}" class="p-btn">+ New Sermon</a>--}}
        {{--                    </div>--}}
        {{--                </div>--}}
        {{--            </form>--}}
        {{--        </div>--}}
    </x-slot>

    <x-slot name="heading">
        Member Profile
    </x-slot>

    <x-slot name="breadcrumbs">
        <li class="breadcrumb-item"><a href="javascript: void(0);">ICA APP</a></li>
        <li class="breadcrumb-item active"><a href="{{route('members.index')}}">Members</a></li>
        <li class="breadcrumb-item active">{{$member->fullName()}}</li>
    </x-slot>


    <div>
        <div class="card profile p-40 mb-16">
            <div class="card-body">

                <div class="row">
                    {{--                    <div class="col-12 mb-8">--}}
                    {{--                        <h4 class="card-title">Personal Information</h4>--}}
                    {{--                    </div>--}}
                    <div class="col-12 col-md-4">
                        <div class="image-placeholder avatar mb-8"
                             style="background-image: url({{asset($member->avatar)}})">
                        </div>
                    </div>
                    <div class="col-12 col-md-8">
                        <div class="row">


                            <div class="col-12 col-sm-6 mb-8">
                                <div class="text-base text-mute">First Name</div>
                                <div class="">{{$member->first_name}}</div>
                            </div>

                            <div class="col-12 col-sm-6 mb-8">
                                <div class="text-base text-mute">Middle Name</div>
                                <div class="">{{$member->middle_name}}</div>
                            </div>

                            <div class="col-12 col-sm-6 mb-8">
                                <div class="text-base text-mute">Last Name</div>
                                <div class="">{{$member->last_name}}</div>
                            </div>

                            <div class="col-12 col-sm-6 mb-8">
                                <div class="text-base text-mute">Gender</div>
                                <div class="">{{$member->gender}}</div>
                            </div>

                            <div class="col-12 col-sm-6 mb-8">
                                <div class="text-base text-mute">Phone Number</div>
                                <div class="">{{$member->phone_number}}</div>
                            </div>

                            <div class="col-12 col-sm-6 mb-8">
                                <div class="text-base text-mute">Date of Birth</div>
                                <div class="">{{$member->date_of_birth ? date("d/m/Y",$member->date_of_birth) : "-"}}</div>
                            </div>

                            <div class="col-12 mb-8">
                                <div class="text-base text-mute">Email</div>
                                <div class="">{{$member->email}}</div>
                            </div>

                            <div class="col-12 col-sm-6 mb-8">
                                <div class="text-base text-mute">Leadership Cell</div>
                                @if(isset($member->leadershipCell))
                                    <a class="link-primary flex align-items-center"
                                       href="{{route("cells.show", ["code"=>$member->leadershipCell->code])}}"><i
                                                class="ri-eye-fill"></i>
                                        <div class="spacer w-5"></div> {{$member->leadershipCell->name}}  </a>
                                @else
                                    <a class="link-primary flex align-items-center" href="{{route("cells.create")}}"><i
                                                class="ri-add-circle-fill"></i>
                                        <div class="spacer w-5"></div>
                                        New </a>
                                @endif

                                {{--                                <div class=""></div>--}}
                            </div>
                          

                            <div class="col-12 col-sm-6 mb-8">
                                <div class="text-base text-mute">User Profile Link</div>
                                @foreach($member->users as $user)
                                    <a class="link-primary flex align-items-center"
                                       href="{{route("cells.show", ["code"=>$user->fullName()])}}"><i
                                                class="ri-eye-fill"></i>
                                        <div class="spacer w-5"></div> {{$user->fullName()}}  </a>
                                        @endforeach
                                {{-- @else --}}
                                    <button class="btn-text link-primary flex align-items-center"
                                         data-bs-toggle="modal"
                                         data-bs-target="#assignUser"><i
                                                class="ri-add-circle-fill"></i>
                                        <div class="spacer w-5"></div>
                                        Select </button>

                                    <div class="modal fade" id="assignUser" tabindex="-1"
                                         aria-labelledby="assignUserLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <form method="post"
                                                  action="{{route('members.link-user', ['code'=>$member->code])}}">
                                                @csrf
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="assignUserLabel">Link User</h5>
                                                        <button type="button" class="btn-close"
                                                                data-bs-dismiss="modal"
                                                                aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                       <input class="form-control " type="search" id="user" required
                                                               name="user"
                                                               placeholder="Select User">
                                                        @if($errors->has('user_id'))
                                                            <div class="error">{{ $errors->first('user_id') }}</div>
                                                        @endif
                                                        <input type="hidden" id="user_id" name="user_id">
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                                data-bs-dismiss="modal">Cancel
                                                        </button>
                                                        <button type="submit" class="p-btn">Proceed
                                                        </button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                {{-- @endif --}}

                                {{--                                <div class=""></div>--}}
                            </div>

                            @if($member->ministries->count() > 0)
                                <div class="col-12 mb-8">
                                    {{--                                <div class="text-base text-mute">Ministries</div>--}}
                                    {{--                                <div class="">{{$member->email}}</div>--}}
                                    @foreach($member->ministries as $ministry)
                                        <span class="chip">{{$ministry->name}}</span>
                                    @endforeach

                                </div>
                            @endif


                            <div class="col-12 mt-16">
                                <div class="flex">
                                    <button type="button" class="p-btn"
                                            data-bs-toggle="modal"
                                            data-bs-target="#attachMinistries">Attach Ministries
                                    </button>
                                    <div class="spacer w-5"></div>
                                    @if(isset($member->cell))
                                        <button type="button" class="p-btn"
                                                data-bs-toggle="modal"
                                                data-bs-target="#transferMember">Transfer Member
                                        </button>
                                        <div class="spacer w-5"></div>
                                    @else
                                        <button type="button" class="p-btn"
                                                data-bs-toggle="modal"
                                                data-bs-target="#assignCell">Assign Cell
                                        </button>
                                        <div class="spacer w-5"></div>
                                    @endif

                                     <form method="post" action="{{route('members.sync', ['code'=>$member->code])}}">
                                        @csrf
                                            <button type="submit" class="p-btn">Sync Profile
                                            </button>
                                        </form>

                                </div>
                            </div>

                            <!-- Modal -->
                            @if(isset($member->cell))
                                <div class="modal fade" id="transferMember" tabindex="-1"
                                     aria-labelledby="transferMemberLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <form method="post"
                                              action="{{route('members.transfer', ['code'=>$member->code])}}">
                                            @csrf
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="transferMemberLabel">Transfer
                                                        Member</h5>
                                                    <button type="button" class="btn-close"
                                                            data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="mb-8">
                                                        You are about to transfer <span class="font-bold">{{$member->fullName()}}</span>
                                                        from <span class="font-bold">{{$member->cell->name}}</span>.
                                                    </div>

                                                    {{--                                                <label>Select Cell</label>--}}
                                                    <input class="form-control " type="search" id="cell" required
                                                           name="cell"
                                                           placeholder="Select Cell">
                                                    @if($errors->has('cell_id'))
                                                        <div class="error">{{ $errors->first('cell_id') }}</div>
                                                    @endif
                                                    <input type="hidden" id="cell_id" name="cell_id">
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Cancel
                                                    </button>
                                                    <button type="submit" class="p-btn">Proceed
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            @else
                                <div class="modal fade" id="assignCell" tabindex="-1"
                                     aria-labelledby="assignCellLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <form method="post"
                                              action="{{route('members.assign-cell', ['code'=>$member->code])}}">
                                            @csrf
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="assignCellLabel">Assign Cell</h5>
                                                    <button type="button" class="btn-close"
                                                            data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    {{--                                                <label>Select Cell</label>--}}
                                                    <input class="form-control " type="search" id="cell" required
                                                           name="cell"
                                                           placeholder="Select Cell">
                                                    @if($errors->has('cell_id'))
                                                        <div class="error">{{ $errors->first('cell_id') }}</div>
                                                    @endif
                                                    <input type="hidden" id="cell_id" name="cell_id">
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Cancel
                                                    </button>
                                                    <button type="submit" class="p-btn">Proceed
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            @endif

                            <div class="modal fade" id="attachMinistries" tabindex="-1"
                                 aria-labelledby="attachMinistriesLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <form method="post"
                                          action="{{route('members.attach-ministries', ['code'=>$member->code])}}">
                                        @csrf
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="attachMinistriesLabel">Attach Ministries</h5>
                                                <button type="button" class="btn-close"
                                                        data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <label class="" for="record_member">Select
                                                    Ministries</label>

                                                @foreach($ministries as $ministry)
{{--                                                    @if(!$meeting->attendances()->where("member_id",$ministry->id)->exists())--}}

                                                        <div class="mb-8" >
                                                            <input {{$member->ministries()->where("ministry_id", $ministry->id)->exists() ? "checked" : ""}} class="mr-5" type="checkbox" name="ministries[]" value="{{$ministry->id}}">{{$ministry->name}}</input>
                                                        </div>

                                                @endforeach
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Cancel
                                                </button>
                                                <button type="submit" class="p-btn">Proceed
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>

                        </div>

                    </div>
                </div>

                {{--                <div class="flex justify-between">--}}
                {{--                    <div>--}}
                {{--                        <div class="text-4xl heading-font">{{$member->fullName()}}  </div>--}}
                {{--                        <div class="text-lg flex align-items-center">{{isset($cell->leader) ? $cell->leader->fullName() : ""}}--}}
                {{--                            <span--}}
                {{--                                    class="chip zone">{{$cell->zone->name}}</span></div>--}}

                {{--                    </div>--}}


                {{--                </div>--}}


            </div>
        </div>

        @if($member->attendances->count() > 0 || isset($member->cell))
            <div class="card member-profile p-40 mb-16">
                <div class="card-body">

                    <div class="flex justify-between">
                        <div>
                            <h4 class="card-title m-0">Cell Attendance</h4>
                            <p class="text-sm text-mute m-0">{{$member->attendanceCount()}}</p>
                        </div>

                        @if(isset($member->cell))
                            <div class="text-right">
                                <h4 class="card-title fw-300 m-0 flex">
                                    <a class="link-primary flex align-items-center"
                                       href="{{route("cells.show", ["code"=>$member->cell->code])}}">{{$member->cell->name}}
                                        @if($member->cell->nextMeetingDate() !== null)
                                            <div class="spacer w-5"></div>
                                            - {{date("dS F",$member->cell->nextMeetingDate())}}
                                        @endif
                                    </a>

                                </h4>
                                @if($member->cell->nextMeetingDate() !== null)
                                    <span class="chip">Next Meeting</span>
                                @endif
                            </div>
                        @endif


                        {{--                    <div class="account-balance flex align-items-center justify-center">--}}
                        {{--                        <div>--}}


                        {{--                            <div class="text-base font-bold text-center">{{date("M d, Y")}}</div>--}}
                        {{--                            <div class="text-sm text-center">Next Meeting</div>--}}
                        {{--                        </div>--}}
                        {{--                    </div>--}}


                    </div>

                    <div class="mt-16">
                        <div id="member_chart" class="apex-charts" dir="ltr"></div>
                    </div>


                </div>
            </div>
        @endif

    </div>

    @push("scripts")
        <!-- apexcharts -->
        <script src="{{asset('js/libs/apexcharts/apexcharts.min.js')}}"></script>

        <!-- apexcharts init -->
        <script>

        </script>
    @endpush

</x-app-layout>
