<x-app-layout>
    @push("styles")
        <!-- DataTables -->
        <link href="{{asset('js/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('js/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('js/libs/datatables.net-select-bs4/css/select.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />

        <!-- Responsive datatable examples -->
        <link href="{{asset('js/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
    @endpush

        <x-slot name="title">
            Cells
        </x-slot>

        <x-slot name="action">
            <div class="mb-16">
                <a href="{{route('cells.create')}}" class="p-btn">+ New</a>
            </div>
        </x-slot>

    <x-slot name="heading">
       Cells
    </x-slot>

    <x-slot name="breadcrumbs">
        <li class="breadcrumb-item"><a href="javascript: void(0);">ICA APP</a></li>
        <li class="breadcrumb-item active">Cells</li>
    </x-slot>



    <div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">

                        <table id="datatable" class="table dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>

                                <tr>
                                    <th>Name</th>
                                    <th>Leader</th>
                                    <th>Contact Number</th>
                                    <th>Zone</th>
                                    <th>Balance</th>
                                    <th>Actions</th>

                                </tr>


                            </thead>

                          <tbody>
                          @foreach($cells as $cell)
                              <tr>
                                  <td>{{$cell->name}}</td>
                                  <td>{{isset($cell->leader) ? $cell->leader->fullName() : "-"}} </td>
                                  <td>{{isset($cell->leader) ? $cell->leader->phone_number : "-"}}</td>
                                  <td>{{$cell->zone->name}}</td>
                                  <td>{{$cell->balance}}</td>
                                  <td>
                                      <a href="{{route('cells.show',["code" => $cell->code])}}" class="btn btn-primary btn-sm">View</a>
                                      <button type="button" class="btn btn-secondary btn-sm">Edit</button>
                                      <button type="button" class="btn btn-secondary btn-sm">Delete</button>

                                  </td>
                              </tr>
                          @endforeach
                          </tbody>
                        </table>

                    </div>
                </div>
            </div> <!-- end col -->
        </div> <!-- end row -->

    </div>

    @push('scripts')
        <!-- Datatable init js -->
        <script src="{{asset('js/assets/datatables.init.js')}}"></script>

        <!-- Required datatable js -->
        <script src="{{asset('js/libs/datatables.net/js/jquery.dataTables.min.js')}}"></script>
        <script src="{{asset('js/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
        <!-- Buttons examples -->
        <script src="{{asset('js/libs/datatables.net-buttons/js/dataTables.buttons.min.js')}}"></script>
        <script src="{{asset('js/libs/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js')}}"></script>
        <script src="{{asset('js/libs/jszip/jszip.min.js')}}"></script>
        <script src="{{asset('js/libs/pdfmake/build/pdfmake.min.js')}}"></script>
        <script src="{{asset('js/libs/pdfmake/build/vfs_fonts.js')}}"></script>
        <script src="{{asset('js/libs/datatables.net-buttons/js/buttons.html5.min.js')}}"></script>
        <script src="{{asset('js/libs/datatables.net-buttons/js/buttons.print.min.js')}}"></script>
        <script src="{{asset('js/libs/datatables.net-buttons/js/buttons.colVis.min.js')}}"></script>

        <script src="{{asset('js/libs/datatables.net-keytable/js/dataTables.keyTable.min.js')}}"></script>
        <script src="{{asset('js/libs/datatables.net-select/js/dataTables.select.min.js')}}"></script>

        <!-- Responsive examples -->
        <script src="{{asset('js/libs/datatables.net-responsive/js/dataTables.responsive.min.js')}}"></script>
        <script src="{{asset('js/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js')}}"></script>
    @endpush

</x-app-layout>
