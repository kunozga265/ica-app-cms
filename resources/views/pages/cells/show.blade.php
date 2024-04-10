<x-app-layout>
    @push("styles")
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

                    <div class="account-balance flex align-items-center justify-center">
                        <div>


                            <div class="heading-font text-xl text-center">MK {{number_format($cell->balance,2)}}</div>
                            <div class="text-sm text-center">Account Balance</div>
                        </div>
                    </div>
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

                    <div class=" mb-4 flex justify-between align-items-center">
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
                                                <button type="button" class="btn-text link-danger"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#memberDialog{{$member->id}}">Remove Member
                                                </button>
                                            </div>

                                            <!-- Modal -->
                                            <div class="modal fade" id="memberDialog{{$member->id}}" tabindex="-1"
                                                 aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <form method="post" action="{{route('members.remove-from-cell', ["cell_id"=>$cell->id])}}">
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
                                                                <input type="hidden" name="member_id" value="{{$member->id}}">
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
                                <form action="{{route("members.add-to-cell", ["cell_id" => $cell->id])}}" method="post">
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
                <div class="card p-40">
                    <div>
                        Meetings
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push("scripts")
        <!-- apexcharts -->
        <script src="{{asset('js/libs/apexcharts/apexcharts.min.js')}}"></script>
        {{--        <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>--}}

        <!-- apexcharts init -->
        <script>
            options = {
                chart: {
                    height: 350, type: "line", zoom: {
                        enabled: true,
                        type: 'x',
                        autoScaleYaxis: false,
                        zoomedArea: {
                            fill: {
                                color: '#90CAF9',
                                opacity: 0.4
                            },
                            stroke: {
                                color: '#0D47A1',
                                opacity: 0.4,
                                width: 1
                            }
                        }
                    },
                },
                stroke: {width: [0, 2, 4], curve: "smooth"},
                plotOptions: {bar: {columnWidth: "50%"}},
                colors: ["#1cbb8c", "#fcb92c", "#0f9cf3"],
                series: [{name: "Attendance", type: "column", data: [23, 11, 22, 27, 13, 22, 37, 21, 44, 22, 30]},
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
                labels: ["01/21/2003", "02/11/2003", "03/06/2003", "04/01/2003", "05/01/2003", "06/01/2003", "07/01/2003", "08/01/2003", "09/01/2003", "10/01/2003", "11/01/2003"],
                markers: {size: 0},
                xaxis: {type: "datetime"},
                yaxis: {title: {text: "Members"}},
                tooltip: {
                    shared: !0, intersect: !1, y: {
                        formatter: function (e) {
                            return void 0 !== e ? e.toFixed(0) + " member(s)" : e
                        }
                    }
                },
                grid: {borderColor: "#f1f1f1", padding: {bottom: 10}},
                legend: {offsetY: 7}
            };
            (chart = new ApexCharts(document.querySelector("#mixed_chart"), options)).render();
        </script>
    @endpush

</x-app-layout>
