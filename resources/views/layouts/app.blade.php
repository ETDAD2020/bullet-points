<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('shopify-app.app_name') }}</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="/assets/vendors/iconfonts/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="/assets/vendors/iconfonts/ionicons/dist/css/ionicons.css">
    <link rel="stylesheet" href="/assets/vendors/iconfonts/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" href="/assets/vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="/assets/vendors/css/vendor.bundle.addons.css">
    <!-- endinject -->
    <!-- plugin css for this page -->
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="/assets/css/shared/style.css">
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="/assets/css/demo_1/style.css">
    <!-- End Layout styles -->
    <!-- upload button -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
    <link rel='stylesheet' href='https://netdna.bootstrapcdn.com/font-awesome/4.0.0/css/font-awesome.css'>
    <link rel="stylesheet" href="assets/upload/style.css">
    <link rel="stylesheet" href="/css/toastr.css">
    @yield('styling_head')
  </head>
  <body>
    <div class="container-scroller">
      <!-- partial:partials/_navbar.html -->
      <nav class="navbar default-layout col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
        <div class="text-center navbar-brand-wrapper d-flex align-items-top justify-content-center" style="background-color: #16495c;">
          <a class="navbar-brand brand-logo" href="{{ route('home') }}"> <img src="/assets/images/logo.png" alt="Sharealp Logo"></a>
          <a class="navbar-brand brand-logo-mini" href="index.html">
            <img src="assets/images/logo-mini.svg" alt="logo" /> </a>
        </div>
        <div class="navbar-menu-wrapper d-flex align-items-center">

            {{-- <ul class="navbar-nav ml-auto">
                <li class="nav-item dropdown d-none d-xl-inline-block user-dropdown">
                    <a class="nav-link dropdown-toggle" id="UserDropdown" href="#" data-toggle="dropdown" aria-expanded="false">
                    <img class="img-xs rounded-circle" src="assets/images/faces/face8.jpg" alt="Profile image"></a>
                    <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="UserDropdown">
                        <div class="dropdown-header text-center">
                            <img class="img-md rounded-circle" src="assets/images/faces/face8.jpg" alt="Profile image">
                            <p class="mb-1 mt-3 font-weight-semibold">{{ Auth::user()->name }}</p>
                            <p class="font-weight-light text-muted mb-0">{{ Auth::user()->email }}</p>
                        </div>
                        <a class="dropdown-item">Sign Out<i class="dropdown-item-icon ti-power-off"></i></a>
                    </div>
                </li>
            </ul> --}}
          <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
            <span class="mdi mdi-menu"></span>
          </button>
        </div>
      </nav>
      <!-- partial -->
    <div class="container-fluid page-body-wrapper">
        <!-- partial:partials/_sidebar.html -->
        <nav class="sidebar sidebar-offcanvas" id="sidebar" style="background-color: #16495c;">
          <ul class="nav">
            <li class="nav-item nav-profile">
              {{-- <a href="#" class="nav-link">
                <div class="profile-image">
                  <img class="img-xs rounded-circle" src="assets/images/faces/face8.jpg" alt="profile image">
                  <div class="dot-indicator bg-success"></div>
                </div>
                <div class="text-wrapper">
                  <p class="profile-name" style="font-size: 11px;">{{ Auth::user()->name }}</p>
                  <p class="designation" style="font-size: 11px;"></p>
                </div>
              </a> --}}
            </li>
            <li class="nav-item nav-category">Main Menu</li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('home') }}">
                <i class="menu-icon typcn typcn-document-text"></i>
                <span class="menu-title">Dashboard</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link"  href="{{ route('referral-manager-view') }}">
                <i class="menu-icon typcn typcn-coffee"></i>
                <span class="menu-title">Referral Manager</span>
              </a>
            </li>
            <li class="nav-item">
                <a class="nav-link"  href="{{ route('withdrwal-manager') }}">
                  <i class="menu-icon typcn typcn-coffee"></i>
                  <span class="menu-title">Withdrawal Manager</span>
                </a>
              </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('orders-view') }}">
                <i class="menu-icon typcn typcn-shopping-bag"></i>
                <span class="menu-title">Orders</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('settings-view') }}">
                <i class="menu-icon typcn typcn-shopping-bag"></i>
                <span class="menu-title">Settings</span>
              </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('popup-setting-view') }}">
                  <i class="menu-icon typcn typcn-shopping-bag"></i>
                  <span class="menu-title">Popup/Modal Settings</span>
                </a>
              </li>
          </ul>
        </nav>
        <!-- partial -->
        <div class="main-panel">
            <div class="content-wrapper">
                @yield('content')
            </div>
        <!-- content-wrapper ends -->
        <!-- partial:partials/_footer.html -->
        <footer class="footer">
          <div class="container-fluid clearfix">
            <span class="text-muted d-block text-center text-sm-left d-sm-inline-block">Copyright © Sharepal 2021</span>
          </div>
        </footer>
        <!-- partial -->
      </div>
      <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->
    @if(config('shopify-app.appbridge_enabled'))
        <script src="https://unpkg.com/@shopify/app-bridge{{ config('shopify-app.appbridge_version') ? '@'.config('shopify-app.appbridge_version') : '' }}"></script>
        <script>
            var AppBridge = window['app-bridge'];
            var createApp = AppBridge.default;
            var app = createApp({
                apiKey: '{{ config('shopify-app.api_key') }}',
                shopOrigin: '{{ Auth::user()->name }}',
                forceRedirect: true,
            });
        </script>

        @include('shopify-app::partials.flash_messages')

        <script type="text/javascript">
            var AppBridge = window['app-bridge'];
            var actions = AppBridge.actions;
            var TitleBar = actions.TitleBar;
            var Button = actions.Button;
            var Redirect = actions.Redirect;
            var titleBarOptions = {
                title: 'Welcome',
            };
            var myTitleBar = TitleBar.create(app, titleBarOptions);
        </script>
    @endif
  <!-- plugins:js -->
  <script src="/assets/vendors/js/vendor.bundle.base.js"></script>
  <script src="/assets/vendors/js/vendor.bundle.addons.js"></script>
  <!-- endinject -->
  <!-- Plugin js for this page-->
  <!-- End plugin js for this page-->
  <!-- inject:js -->
  <script src="/assets/js/shared/off-canvas.js"></script>
  <script src="/assets/js/shared/misc.js"></script>
  <!-- endinject -->
  <!-- Custom js for this page-->
  <script src="/assets/js/demo_1/dashboard.js"></script>
  <!-- End custom js for this page-->
  <script src="/assets/js/shared/jquery.cookie.js" type="text/javascript"></script>
  <script src="/assets/js/custom.js" type="text/javascript"></script>
  <script src="/js/toastr.min.js" type="text/javascript"></script>

  @yield('scripts')
</body>
</html>
