@extends('layouts.app')
@section('content')
<!-- Page Title Header Starts-->
<div class="row page-title-header">
    <div class="col-12">
        <div class="page-header">
            <h4 class="page-title">Orders Manager</h4>
        </div>
    </div>
</div>
    <!-- Page Title Header Ends-->
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
            <div class="card-body">
                <table id="orders-table" class="table table-hover" style="width:100%">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Order Number</th>
                                <th>Order Email</th>
                                <th>Referral Amount</th>
                                <th>Total Price</th>
                                <th>Referral Code</th>
                                <th>Order Status</th>
                                {{-- <th>Action</th> --}}
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($orders as $order)
                            <tr>
                                <td>{{ $order->id }}</td>
                                <td>{{ $order->order_number }}</td>
                                <td>{{ $order->order_email }}</td>
                                <td>{{ $order->total_discount }}</td>
                                <td>{{ $order->total_price }}</td>
                                <td>{{ $order->discount_code }}</td>
                                <td>@if($order->order_status == 0) <p class="badge badge-success h6 text-white">Placed</p> @elseif($order->order_status == 1) <p class="badge badge-success h6 text-white">Fulfilled</p> @elseif($order->order_status == 2) <p class="badge badge-danger h6 text-white">Cancelled</p> @endif</td>
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
        $('#orders-table').DataTable({
            drawCallback: function () {
                var revenue = "1000"; //potential revenue
                var currency = " €";
                var api = this.api();
            }
        });


    } );
    </script>
@endsection
