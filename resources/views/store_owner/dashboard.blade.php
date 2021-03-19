@extends('layouts.app')
@section('content')
<div class="row page-title-header">
    <div class="col-12">
      <div class="page-header">
        <h4 class="page-title">Dashboard</h4>
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
                <h5 class="font-weight-semibold mb-0 ">Amount Generated</h5>
              </div>
            </div>
          </div>
        </div>
      <div class="col-md-4 grid-margin stretch-card">
          <div class="card">
            <div class="card-body">
              <div class="d-flex justify-content-between pb-2 align-items-center">
                <h2 class="font-weight-semibold mb-0 text-success ">${{ number_format((float)$total_referral_earned, 2, '.', '') }}</h2>
                <div class="icon-holder">
                  <i class="mdi mdi-briefcase-outline"></i>
                </div>
              </div>
              <div class="d-flex justify-content-between">
                <h5 class="font-weight-semibold mb-0 ">Referrer Earned</h5>
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
                <h2 class="font-weight-semibold mb-0 text-success ">{{ $total_referrals }}</h2>
                <div class="icon-holder">
                  <i class="mdi mdi-briefcase-outline"></i>
                </div>
              </div>
              <div class="d-flex justify-content-between">
                <h5 class="font-weight-semibold mb-0 ">Number of Referrals</h5>
              </div>
            </div>
          </div>
        </div>
      <div class="col-md-6 grid-margin stretch-card">
          <div class="card">
            <div class="card-body">
              <div class="d-flex justify-content-between pb-2 align-items-center">
                <h2 class="font-weight-semibold mb-0 text-success ">${{ number_format((float)$withdrawals_requested, 2, '.', '') }}</h2>
                <div class="icon-holder">
                  <i class="mdi mdi-briefcase-outline"></i>
                </div>
              </div>
              <div class="d-flex justify-content-between">
                <h5 class="font-weight-semibold mb-0 ">Withdrawal Amount</h5>
              </div>
            </div>
          </div>
        </div>
  </div>
@endsection
