@extends('layouts.referral')
@section('styling_head')
    <!-- Datatable -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/dataTables.bootstrap4.min.css"/>

    <!-- Code Copy Paste Box -->
    <link href="assets/copybox/prism/prism.min.css" rel="stylesheet">
    <link href="assets/copybox/code-box-copy/css/code-box-copy.css" rel="stylesheet">
    <style>
        .dataTables_filter {
            float: right !important;
        }
    </style>
@endsection
@section('content')
<div class="row page-title-header">
    <div class="col-12">
        <div class="page-header">
            <h4 class="page-title">Dashboard</h4>
            @if($total_withdrawal_available != 0)
                <div class="pull-right">
                    <a href="javascript:void(0)" data-name="{{ Auth::user()->name }}" id="withdraw_button" class="btn btn-primary btn-rounded btn-lg">Withdraw</a>
                </div>
            @endif
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="form-group">
                    <label for="generatedLink">Copy Referral Link</label>
                    <div class="code-box-copy">
                        <button class="code-box-copy__btn" data-clipboard-target="#example-head" title="Copy"></button>
                        <pre><code class="language-html" id="example-head">{{ $referral_info->url }}</code></pre>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
  <!-- Page Title Header Ends-->
  <div class="row">
      <div class="col-md-4 grid-margin stretch-card">
          <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between pb-2 align-items-center">
                    <h2 class="font-weight-semibold mb-0 text-success ">{{ $number_of_orders }}</h2>
                    <div class="icon-holder">
                        <i class="mdi mdi-briefcase-outline"></i>
                    </div>
                </div>
                <div class="d-flex justify-content-between">
                    <h5 class="font-weight-semibold mb-0 ">Number of Orders</h5>
                </div>
            </div>
          </div>
        </div>
      <div class="col-md-4 grid-margin stretch-card">
          <div class="card">
            <div class="card-body">
              <div class="d-flex justify-content-between pb-2 align-items-center">
                <h2 class="font-weight-semibold mb-0 text-success ">${{ number_format((float)$total_order_amount, 2, '.', '') }}</h2>
                <div class="icon-holder">
                  <i class="mdi mdi-briefcase-outline"></i>
                </div>
              </div>
              <div class="d-flex justify-content-between">
                <h5 class="font-weight-semibold mb-0 ">Total Order Generated</h5>
              </div>
            </div>
          </div>
        </div>
      <div class="col-md-4 grid-margin stretch-card">
          <div class="card">
            <div class="card-body">
              <div class="d-flex justify-content-between pb-2 align-items-center">
                <h2 class="font-weight-semibold mb-0 text-success ">${{ $total_earned_amount }}</h2>
                <div class="icon-holder">
                  <i class="mdi mdi-briefcase-outline"></i>
                </div>
              </div>
              <div class="d-flex justify-content-between">
                <h5 class="font-weight-semibold mb-0 ">Amount Earned</h5>
              </div>
            </div>
          </div>
        </div>
  </div>
  <div class="row">
      <div class="col-md-6 grid-margin stretch-card">
          <div class="card">
            <div class="card-body">
              <div class="d-flex justify-content-between pb-2 align-items-center">
                <h2 class="font-weight-semibold mb-0 text-success ">${{ $total_withdrawal_available }}</h2>
                <div class="icon-holder">
                  <i class="mdi mdi-briefcase-outline"></i>
                </div>
              </div>
              <div class="d-flex justify-content-between">
                <h5 class="font-weight-semibold mb-0 ">Withdrawal Available</h5>
              </div>
            </div>
          </div>
        </div>
      <div class="col-md-6 grid-margin stretch-card">
          <div class="card">
            <div class="card-body">
              <div class="d-flex justify-content-between pb-2 align-items-center">
                <h2 class="font-weight-semibold mb-0 text-success ">${{ $total_withdrawal }}</h2>
                <div class="icon-holder">
                  <i class="mdi mdi-briefcase-outline"></i>
                </div>
              </div>
              <div class="d-flex justify-content-between">
                <h5 class="font-weight-semibold mb-0 ">Amount Withdrawn</h5>
              </div>
            </div>
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
                                <th>Earned Amount</th>
                                <th>Total Price</th>
                                <th>Referral Code</th>
                                <th>Order Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($referral_orders as $order)
                            <tr>
                                <td>{{ $order->id }}</td>
                                <td>{{ $order->order_number }}</td>
                                <td>${{ $order->total_discount }}</td>
                                <td>${{ $order->total_price }}</td>
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
  });
  </script>
@endsection

