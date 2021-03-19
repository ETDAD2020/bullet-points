@extends('layouts.app')
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
<!-- Page Title Header Starts-->
<div class="row page-title-header">
    <div class="col-12">
        <div class="page-header">
            <h4 class="page-title">Referral Manager</h4>
        </div>
    </div>
</div>
<!-- Page Title Header Ends-->
<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="alert alert-success referral-creation-alert" role="alert" style="display: none;">
                </div>
                <div class="alert alert-danger referral-error-alert" role="alert" style="display: none;">
                </div>
                <h4 class="card-title">Generate Referral Link</h4>
                <form class="forms-sample" method="POST" action="/add-referral">
                    <div class="form-group">
                        <label for="referralName">Name</label>
                        <input type="text" class="form-control" name="referral_name" id="referralName" placeholder="Enter Name">
                    </div>
                    <div class="form-group">
                        <label for="referralEmail">Email</label>
                        <input type="email" class="form-control" name="referral_email" id="referralEmail" placeholder="Enter Email">
                    </div>
                    <button type="submit" class="btn btn-success mr-2" id="add-referral-button">Generate</button>
                    <button class="btn btn-light">Cancel</button>
                </form>
            </div>
        </div>
    </div>
    {{-- <div class="col-md-6 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="form-group">
                    <label for="generatedLink">Copy Referral Link</label>
                    <div class="code-box-copy">
                        <button class="code-box-copy__btn" data-clipboard-target="#example-head" title="Copy"></button>
                        <pre><code class="language-html" id="example-head">https://bamboo.trybeans.com/members</code></pre>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
</div>
<!-- Page Title Header Ends-->
<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card" style="overflow: scroll;">
        <div class="card-body">
            <table id="referral-table" class="table table-hover" style="width:100%">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            {{-- <th>Date</th> --}}
                            <th>Referral Link</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($referrals as $referral)
                            <tr>
                                <td>{{ $referral->id }}</td>
                                <td>{{ $referral->name }}</td>
                                <td>{{ $referral->email }}</td>
                                {{-- <td>{{ $referral->created_at }}</td> --}}
                                <td>
                                    <div class="code-box-copy" style="font-size: 12px;">
                                        <button class="code-box-copy__btn" data-clipboard-target="#example-head" title="Copy"></button>
                                        <pre class=" language-html"><code class=" language-html" id="example-head">{{ $referral->url }}</code></pre>
                                    </div>
                                </td>
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
      $('#referral-table').DataTable({
        drawCallback: function () {
            var revenue = "1000"; //potential revenue
            var currency = " €";
            var api = this.api();
        }
      });
  });
  </script>
@endsection
