<x-app-layout>
    @push("styles")
        <!-- DataTables -->
        <link href="{{asset('js/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('js/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('js/libs/datatables.net-select-bs4/css/select.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />

        <!-- Responsive datatable examples -->
        <link href="{{asset('js/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />

        <script>
            $(function () {
                const members = {!! json_encode($members) !!};
                const arr = [{
                    label: "None",
                    value: 0,
                    object: null
                }];

                for (let x in members) {
                    arr.push({
                        label: members[x].last_name + " " + members[x].first_name,
                        value: members[x].id,
                        object: members[x]
                    })
                }

                $("#member_id").val(arr[0].value);
                $("#details").hide()

                $("#member").autocomplete({
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
                        $("#member_id").val(ui.item.value);
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


            //     Chart
                const chartData = {!! json_encode($chartData) !!};

                options = {
                    chart: {
                        height: 350, type: "bar",
                    },
                    stroke: {width: [0, 2, 4], curve: "smooth"},
                    plotOptions: {bar: {columnWidth: "20%",  rangeBarOverlap: false,}},
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
                    xaxis: {type: "datetime", labels:{
                            datetimeUTC: false,
                        }},
                    yaxis: {title: {text: "Members"}},
                    // tooltip: {
                    //     shared: !0, intersect: !1, y: {
                    //         formatter: function (e) {
                    //             return void 0 !== e ? e.toFixed(0) + " member(s)" : e
                    //         }
                    //     }
                    // },
                    grid: {borderColor: "#f1f1f1", padding: {bottom: 10}},
                    legend: {offsetY: 7}
                };
                (chart = new ApexCharts(document.querySelector("#mixed_chart"), options)).render();


            });
        </script>
    @endpush

    <x-slot name="title">
        {{$cell->name}}
    </x-slot>

    <x-slot name="action">
        <div class="mb-16">
            <form action="{{route('cells.trash',$cell->id)}}" method="post">
                @csrf
                <div>
                    <a href="{{route('cells.edit',$cell->id)}}" class="p-btn">Edit</a>
                    <button type="submit" class="p-btn error">Delete</button>
                </div>
            </form>
        </div>

    </x-slot>
    <x-slot name="heading">
        {{$cell->getType()}}
    </x-slot>

    <x-slot name="breadcrumbs">
        <li class="breadcrumb-item"><a href="javascript: void(0);">ICA APP</a></li>
        <li class="breadcrumb-item active"><a href="{{route('cells.index')}}">Cells</a></li>
        <li class="breadcrumb-item active">{{$cell->name}}</li>
    </x-slot>


    <div>
        <div class="card cell-profile p-40 mb-16">
            <div class="card-body">

                <div class="flex justify-between">
                    <div>
                        <div class="text-4xl heading-font">{{$cell->name}}  </div>
                        <div class="text-lg flex align-items-center">{{isset($cell->leader) ? $cell->leader->fullName() : ""}}
                            <span
                                    class="chip zone">{{$cell->zone->name}}</span></div>

                    </div>

                    <a href="{{route('cells.transactions',["code"=>$cell->code])}}">
                    <div class="account-balance flex align-items-center justify-center">
                        <div>

                                <div class="heading-font text-xl text-center">MK {{number_format($cell->balance,2)}}</div>
                                <div class="text-sm text-center">Account Balance</div>

                        </div>
                    </div>
                    </a>
                </div>

                <div class="mt-16">
                    {{--                    <h4 class="card-title mb-4">Attendance Report</h4>--}}

                    <div id="mixed_chart" class="apex-charts" dir="ltr"></div>
                </div>


            </div>
        </div>

        <div class="row">
            <div class="col-12 col-lg-6">
                <div class="card members p-40">

                    <div class=" mb-8 flex justify-between align-items-center">
                        <div>
                            <h4 class="card-title m-0">Members</h4>
                            <p class="text-sm text-mute m-0">{{$cell->getParticipants()}}</p>
                        </div>

                        <button type="button" class="btn-icon" data-bs-toggle="modal" data-bs-target="#addMember">
                            <i class="ri-user-add-line "></i>
                        </button>
                    </div>


                    <div class=" accordion" id="cell_members">
                        @foreach($members = $cell->members as $member)
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="heading{{$member->id}}">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#collapse{{$member->id}}" aria-expanded="false"
                                            aria-controls="collapseOne">
                                        <div class="flex align-items-center">
                                            <div class="image-placeholder avatar-sm"
                                                 style="background-image: url({{asset($member->avatar)}})"></div>
                                            <div>
                                                {{$member->fullName()}}
                                            </div>
                                        </div>

                                    </button>
                                </h2>
                                <div id="collapse{{$member->id}}" class="accordion-collapse collapse"
                                     aria-labelledby="heading{{$member->id}}"
                                     data-bs-parent="#cell_members">
                                    <div class="accordion-body">

                                        <div class="row p-10">


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

                                            <div class="col-12">

                                                <div class="flex justify-between">
                                                    <a class="link-primary" href="{{route('members.show',["code" => $member->code])}}">Profile
                                                    </a>
                                                    <button type="button" class="btn-text link-danger"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#memberDialog{{$member->id}}">Remove Member
                                                    </button>

                                                </div>
                                            </div>

                                            <!-- Modal -->
                                            <div class="modal fade" id="memberDialog{{$member->id}}" tabindex="-1"
                                                 aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <form method="post"
                                                          action="{{route('members.remove-from-cell', ["code"=>$cell->code])}}">
                                                        @csrf
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">Delete
                                                                    Member</h5>
                                                                <button type="button" class="btn-close"
                                                                        data-bs-dismiss="modal"
                                                                        aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                Are you sure you want to remove {{$member->fullName()}}
                                                                from this cell?
                                                                <input type="hidden" name="member_id"
                                                                       value="{{$member->id}}">
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                        data-bs-dismiss="modal">Cancel
                                                                </button>
                                                                <button type="submit" class="p-btn error">Remove
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>


                                        </div>

                                    </div>
                                </div>
                            </div>
                        @endforeach


                    </div>

                    <!-- Add Member Modal -->
                    <div class="modal fade" id="addMember" tabindex="-1" aria-labelledby="addMemberLabel"
                         aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <form action="{{route("members.add-to-cell", ["code" => $cell->code])}}" method="post">
                                    @csrf

                                    <div class="modal-header">
                                        <h5 class="modal-title" id="addMemberLabel">Add New Member</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="mb-8">

                                            <input class="form-control " type="search" id="member" required
                                                   name="member"
                                                   placeholder="Select Member">
                                            @if($errors->has('member_id'))
                                                <div class="error">{{ $errors->first('member_id') }}</div>
                                            @endif
                                            <input type="hidden" id="member_id" name="member_id">

                                        </div>


                                        <div id="details" class="row p-10">


                                            <div class="col-12 col-sm-6 mb-8">
                                                <div class="text-base text-mute">First Name</div>
                                                <div id="first_name" class=""></div>
                                            </div>

                                            <div class="col-12 col-sm-6 mb-8">
                                                <div class="text-base text-mute">Middle Name</div>
                                                <div id="middle_name" class=""></div>
                                            </div>

                                            <div class="col-12 col-sm-6 mb-8">
                                                <div class="text-base text-mute">Last Name</div>
                                                <div id="last_name" class=""></div>
                                            </div>

                                            <div class="col-12 col-sm-6 mb-8">
                                                <div class="text-base text-mute">Gender</div>
                                                <div id="gender" class=""></div>
                                            </div>

                                            <div class="col-12 col-sm-6 mb-8">
                                                <div class="text-base text-mute">Phone Number</div>
                                                <div id="phone_number" class=""></div>
                                            </div>

                                            <div class="col-12 col-sm-6 mb-8">
                                                <div class="text-base text-mute">Email</div>
                                                <div id="email" class=""></div>
                                            </div>

                                        </div>

                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel
                                        </button>
                                        <button type="submit" class="p-btn">Add</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>


            </div>

            <div class="col-12 col-lg-6">
                <div class="card meetings p-40">
                    <div class=" mb-8 flex justify-between ">
                        <div>
                            <h4 class="card-title m-0">Meetings</h4>
                            <p class="text-sm text-mute m-0">{{$cell->meetingsCount()}}</p>
                        </div>

                        <button type="button" class="btn-icon" data-bs-toggle="modal" data-bs-target="#newMeeting">
                            <i class="ri-menu-add-line "></i>
                        </button>
                    </div>

                    <div class=" accordion" id="cell_meetings">
                        @foreach($meetings = $cell->meetings()->orderBy("date","desc")->get() as $meeting)
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="heading{{$meeting->code}}">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#collapse{{$meeting->code}}" aria-expanded="false"
                                            aria-controls="collapseOne">
                                        <div class="">
                                            <div>
                                                {{date("M d, Y", $meeting->date)}}
                                                {{--                                                <span class="chip">{{$meeting->venue}}</span>--}}
                                            </div>
                                            <div class=" text-base">
                                                {{$meeting->venue}}
                                            </div>

                                        </div>

                                    </button>
                                </h2>
                                <div id="collapse{{$meeting->code}}" class="accordion-collapse collapse"
                                     aria-labelledby="heading{{$meeting->code}}"
                                     data-bs-parent="#cell_meetings">
                                    <div class="accordion-body">

                                        <div class="p-10">

                                            <div class="mb-8">
                                                <div class="text-base text-mute">Offering</div>
                                                <div class="">MK{{number_format($meeting->offering,1)}}</div>
                                            </div>


                                            <div class="attendance mb-16">
                                                <div class=" flex justify-between">
                                                    <div class="text-base text-mute">Attendance
                                                        ({{$meeting->attendances->count(0)}})
                                                    </div>
                                                    <button type="button" class="btn-icon" data-bs-toggle="modal"
                                                            data-bs-target="#recordMemberAttendance{{$meeting->code}}">
                                                        <i class="ri-user-add-line"></i>
                                                    </button>
                                                </div>
                                                @foreach($meeting->attendances as $attendance)

                                                    <div class="flex align-items-center">
                                                        <button type="button" class="btn-text error"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#unsetMemberAttendance{{$meeting->code}}-{{$attendance->id}}">
                                                            <i class="ri-close-circle-fill "></i>
                                                        </button>

                                                        <div class="spacer w-5"></div>

                                                        {{$attendance->member->fullName()}}
                                                    </div>


                                                    <!-- Unset Attendance -->
                                                    <div class="modal fade"
                                                         id="unsetMemberAttendance{{$meeting->code}}-{{$attendance->id}}"
                                                         tabindex="-1"
                                                         aria-labelledby="recordMemberAttendanceLabel{{$meeting->code}}-{{$attendance->id}}"
                                                         aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered">
                                                            <div class="modal-content">
                                                                <form action="{{route('cells.unset-attendance', ['id' => $attendance->id])}}"
                                                                      method="post">
                                                                    @csrf

                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title"
                                                                            id="recordMemberAttendanceLabel{{$meeting->code}}-{{$attendance->id}}">
                                                                            Unset Attendance</h5>
                                                                        <button type="button" class="btn-close"
                                                                                data-bs-dismiss="modal"
                                                                                aria-label="Close"></button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        Are you sure you want to
                                                                        remove {{$attendance->member->fullName()}}
                                                                        from this meeting?

                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary"
                                                                                data-bs-dismiss="modal">Cancel
                                                                        </button>
                                                                        <button type="submit" class="p-btn error">
                                                                            Unset
                                                                        </button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach

                                            </div>



                                            <div class="flex justify-between">
                                                <button type="button" class="btn-text link-primary"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#updateMeetingDetails{{$meeting->code}}">Update
                                                </button>
                                                <button type="button" class="btn-text link-danger"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#deleteMeetingDialog{{$meeting->code}}">Delete
                                                </button>

                                            </div>

                                            <!-- Record Member Modal -->
                                            <div class="modal fade" id="recordMemberAttendance{{$meeting->code}}"
                                                 tabindex="-1"
                                                 aria-labelledby="recordMemberAttendanceLabel{{$meeting->code}}"
                                                 aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <div class="modal-content">
                                                        <form action="{{route("cells.record-attendance", ["code" => $cell->code, "meeting_code"=>$meeting->code])}}"
                                                              method="post">
                                                            @csrf

                                                            <div class="modal-header">
                                                                <h5 class="modal-title"
                                                                    id="recordMemberAttendanceLabel{{$meeting->code}}">
                                                                    Record Attendance</h5>
                                                                <button type="button" class="btn-close"
                                                                        data-bs-dismiss="modal"
                                                                        aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="">

                                                                    <label class="" for="record_member">Select
                                                                        Member(s)</label>

                                                                    {{--                                                                        <option value="">Select Members</option>--}}
                                                                    @foreach($members = $cell->members as $member)
                                                                        @if(!$meeting->attendances()->where("member_id",$member->id)->exists())
                                                                            <div class="mb-8" >
                                                                                <input class="mr-5" type="checkbox" name="members[]" value="{{$member->id}}">{{$member->fullName()}}</input>
                                                                            </div>
                                                                        @endif

                                                                    @endforeach

{{--                                                                    <select class="form-control form-select" type="text"--}}
{{--                                                                            id="record_member" name="members[]" required--}}
{{--                                                                            multiple>--}}


{{--                                                                        --}}{{--                                                                        <option value="">Select Members</option>--}}
{{--                                                                        @foreach($members = $cell->members as $member)--}}
{{--                                                                            <option value="{{$member->id}}">{{$member->fullName()}}</option>--}}
{{--                                                                        @endforeach--}}

{{--                                                                    </select>--}}

                                                                </div>

                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                        data-bs-dismiss="modal">Cancel
                                                                </button>
                                                                <button type="submit" class="p-btn">Record</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Update Details Modal -->
                                            <div class="modal fade" id="updateMeetingDetails{{$meeting->code}}"
                                                 tabindex="-1"
                                                 aria-labelledby="updateMeetingDetailsLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <form method="post"
                                                          action="{{route('cells.update-meeting', ["code"=>$cell->code, "meeting_code"=>$meeting->code])}}">
                                                        @csrf
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="updateMeetingDetailsLabel">
                                                                    Update Meeting Details</h5>
                                                                <button type="button" class="btn-close"
                                                                        data-bs-dismiss="modal"
                                                                        aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="row">
                                                                    <div class="col-12 col-sm-6 mb-8">
                                                                        <label class="" for="start_date">Date</label>
                                                                        <input value="{{date('Y-m-d',$meeting->date)}}"
                                                                               class="form-control" type="date"
                                                                               id="start_date" name="date" required>
                                                                    </div>

                                                                    <div class="col-12 col-sm-6 mb-8">
                                                                        <label class="" for="time">Time</label>
                                                                        <input value="{{date('H:s',$meeting->date)}}"
                                                                               class="form-control" type="time"
                                                                               id="time" name="time"
                                                                               placeholder="Enter Time">
                                                                    </div>

                                                                    <div class="col-12 col-sm-6 mb-8">
                                                                        <label class="" for="venue">Venue</label>
                                                                        <input value="{{$meeting->venue}}"
                                                                               class="form-control" type="text"
                                                                               id="venue" name="venue"
                                                                               placeholder="Enter venue">
                                                                    </div>

                                                                    <div class="col-12 col-sm-6 mb-8">
                                                                        <label class="" for="offering">Offering</label>
                                                                        <input value="{{$meeting->offering}}"
                                                                               class="form-control" type="text"
                                                                               id="offering" name="offering" required>
                                                                    </div>

                                                                    {{--                                                                    <div class="col-12 mb-8">--}}
                                                                    {{--                                                                        <label class="" for="offering">Members</label>--}}
                                                                    {{--                                                                        <select class="form-control form-select" type="text" id="zone_id" name="zone_id" required>--}}
                                                                    {{--                                                                            <option value="">Select Zone</option>--}}
                                                                    {{--                                                                            @foreach($zones as $zone)--}}
                                                                    {{--                                                                                <option value="{{$zone->id}}">{{$zone->name}}</option>--}}
                                                                    {{--                                                                            @endforeach--}}

                                                                    {{--                                                                        </select>--}}
                                                                    {{--                                                                    </div>--}}


                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                        data-bs-dismiss="modal">Cancel
                                                                </button>
                                                                <button type="submit" class="p-btn">Update
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>

                                            <!-- Remove Meeting Modal -->
                                            <div class="modal fade" id="deleteMeetingDialog{{$meeting->code}}" tabindex="-1"
                                                 aria-labelledby="deleteMeetingDialog{{$meeting->code}}Label" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <form method="post"
                                                          action="{{route('cells.trash-meeting', ["code"=>$cell->code, 'meeting_code'=>$meeting->code])}}">
                                                        @csrf
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="deleteMeetingDialog{{$meeting->code}}">Delete
                                                                    Meeting</h5>
                                                                <button type="button" class="btn-close"
                                                                        data-bs-dismiss="modal"
                                                                        aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                Are you sure you want to permanently delete the meeting held on {{date("M d, Y")}}?
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                        data-bs-dismiss="modal">Cancel
                                                                </button>
                                                                <button type="submit" class="p-btn error">Delete
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>

                                        </div>

                                    </div>
                                </div>
                            </div>
                        @endforeach


                    </div>


                </div>

                <!-- Add Member Modal -->
                <div class="modal fade" id="newMeeting" tabindex="-1" aria-labelledby="newMeetingLabel"
                     aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <form action="{{route("cells.create-meeting", ["code" => $cell->code])}}" method="post">
                                @csrf

                                <div class="modal-header">
                                    <h5 class="modal-title" id="newMeetingLabel">New Meeting</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="row">

                                        <div class="col-12 col-sm-6 mb-8">
                                            <label class="" for="start_date">Date</label>
                                            <input class="form-control" type="date" id="start_date" name="date"
                                                   required>
                                        </div>

                                        <div class="col-12 col-sm-6 mb-8">
                                            <label class="" for="time">Time</label>
                                            <input class="form-control" type="time" id="time" name="time"
                                                   placeholder="Enter Time">
                                        </div>

                                        <div class="col-12 mb-8">
                                            <label class="" for="venue">Venue</label>
                                            <input class="form-control" type="text" id="venue" name="venue"
                                                   placeholder="Enter venue">
                                        </div>

                                    </div>

                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel
                                    </button>
                                    <button type="submit" class="p-btn">Create</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    @push("scripts")
        <!-- apexcharts -->
        <script src="{{asset('js/libs/apexcharts/apexcharts.min.js')}}"></script>

        <!-- apexcharts init -->
        <script>

        </script>
    @endpush

</x-app-layout>
