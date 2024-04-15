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
        {{$cell->name}} - Transactions
    </x-slot>

    <x-slot name="action">
        <button type="button" class="p-btn"
                data-bs-toggle="modal"
                data-bs-target="#newTransaction">+ New
        </button>

        <!-- New Transactions -->
        <div class="modal fade" id="newTransaction"
             tabindex="-1"
             aria-labelledby="newTransactionLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <form method="post"
                      action="{{route('cells.store-transaction', ["code"=>$cell->code])}}">
                    @csrf
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="newTransactionLabel">
                                New Transaction</h5>
                            <button type="button" class="btn-close"
                                    data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="">
                                <div class="mb-8">
                                    <label class="" for="type">Type</label>
                                    <select class="form-control" type="text" id="type" name="type" required>
                                        <option value="">Select Type</option>
                                        <option value="0">Deposit</option>
                                        <option value="1">Withdraw</option>
                                    </select>
                                </div>

                                <div class="mb-8">
                                    <label class="" for="description">Description</label>
                                    <input
                                           class="form-control" type="text"
                                           id="description" name="description" required>
                                </div>
                                <div class="mb-8">
                                    <label class="" for="amount">Amount</label>
                                    <input
                                           class="form-control" type="text"
                                           id="amount" name="amount" required>
                                </div>

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

    </x-slot>

    <x-slot name="heading">
        Transactions
    </x-slot>

    <x-slot name="breadcrumbs">
        <li class="breadcrumb-item"><a href="javascript: void(0);">ICA APP</a></li>
        <li class="breadcrumb-item"><a href="{{route('cells.index')}}">Cells</a></li>
        <li class="breadcrumb-item"><a href="{{route('cells.show',["code"=>$cell->code])}}">{{$cell->name}}</a></li>
        <li class="breadcrumb-item active">Transactions</li>
    </x-slot>

    <div class="card p-40">

        <table id="datatable" class="table dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
            <thead>

            <tr>
                <th>Date</th>
                <th>Description</th>
                <th>Amount</th>
                <th>Balance</th>
            </tr>

            </thead>

            <tbody>
            @foreach($transactions = $cell->transactions()->latest()->get() as $transaction)
                <tr>
                    <td>{{date("d/m/Y",$transaction->created_at->getTimestamp())}}</td>
                    <td>{{$transaction->description}}</td>
                    <td class="{{$transaction->type == 0? "secondary" : "error"}} font-old" >{{number_format($transaction->amount,1)}}</td>
                    <td>{{number_format($transaction->balance,1)}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>

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