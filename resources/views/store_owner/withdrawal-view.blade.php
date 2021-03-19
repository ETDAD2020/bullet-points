@extends('layouts.app')
@section('content')
<!-- Page Title Header Starts-->
<div class="row page-title-header">
    <div class="col-12">
        <div class="page-header">
            <h4 class="page-title">Withdrawal Manager</h4>
        </div>
    </div>
</div>
    <!-- Page Title Header Ends-->
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
            <div class="card-body">
                <table id="withdrawal-table" class="table table-hover" style="width:100%">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Referral Name</th>
                                <th>Referral Email</th>
                                <th>Withdrawal Amount</th>
                                <th>Withdrawal Status</th>
                                {{-- <th>URL</th> --}}
                                {{-- <th>Order Status</th> --}}
                                {{-- <th>Action</th> --}}
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($withdrawals as $withdrawal)
                            <tr>
                                <td>{{ $withdrawal->id }}</td>
                                <td>{{ $withdrawal->name }}</td>
                                <td>{{ $withdrawal->email }}</td>
                                <td>${{ $withdrawal->withdrawal_amount }}</td>
                                <td>
                                    @if($withdrawal->withdrawal_status == 0)
                                        <p class="badge badge-warning h6" id="pending-withdrawal-{{ $withdrawal->id }}">Pending</p>
                                        <select data-withdrawal="{{ $withdrawal->id }}" name="withdrawal_status" class="withdrawal_status">
                                            <option value="0" selected>Pending</option>
                                            <option value="1">Completed</option>
                                        </select>
                                    @elseif($withdrawal->withdrawal_status == 1)
                                        <p class="badge badge-success h6 text-white">Completed</p>
                                        {{-- <select data-withdrawal="{{ $withdrawal->id }}" name="withdrawal_status" class="withdrawal_status">
                                            <option value="0">Pending</option>
                                            <option value="1" selected>Completed</option>
                                        </select> --}}
                                    @endif
                                </td>
                                {{-- <td>{{ $withdrawal->url }}</td> --}}
                            </tr>
                            @endforeach
                        </tbody>
                </table>
            </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <!-- datatable -->
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap4.min.js"></script>


      <!-- Code Copy Paste Box -->
    <script src="/assets/copybox/prism/prism.min.js"></script>
    <script src="/assets/copybox/clipboard/clipboard.min.js"></script>
    <script src="/assets/copybox/code-box-copy/js/code-box-copy.js"></script>


    <script>


    /*
    ** Name: Copy Box & DataTable
    ** Description:
    ** Date: Jan 26, 2021
    ** Author: hammaad | Swishtag Dev
    */

    $(document).ready( function () {

        $('.code-box-copy').codeBoxCopy({
                tooltipText: 'Copied',
                tooltipShowTime: 1000,
                tooltipFadeInTime: 300,
                tooltipFadeOutTime: 300
        });


        // Insert the sum of a column into the columns footer, for the visible
        // data on each draw
        $('#withdrawal-table').DataTable({
            drawCallback: function () {
                var revenue = "1000"; //potential revenue
                var currency = " €";
                var api = this.api();
            }
        });


    } );
    </script>
@endsection
