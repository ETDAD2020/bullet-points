<!DOCTYPE html>
<!--[if IE 9]> <html class="ie9 no-js" lang="en"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!-->
<html class="no-js" lang="en">
<!--<![endif]-->

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

        <title>{{ config('shopify-app.app_name') }}</title>
    <!-- <link rel="stylesheet" href="http://localhost:3000/css/bootstrap4/dist/css/bootstrap-custom.css?v=datetime"> -->
    <link rel="stylesheet" href="{{ asset('polished.min.css') }}">
    <!-- <link rel="stylesheet" href="polaris-navbar.css"> -->
    <link rel="stylesheet" href="{{ asset('iconic/css/open-iconic-bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/toastr.css') }}">

    @yield('css')

    <style>
        .grid-highlight {
            padding-top: 1rem;
            padding-bottom: 1rem;
            background-color: #5c6ac4;
            border: 1px solid #202e78;
            color: #fff;
        }

        hr {
            margin: 6rem 0;
        }

        hr+.display-3,
        hr+.display-2+.display-3 {
            margin-bottom: 2rem;
        }
    </style>
</head>

<body>

<nav class="navbar navbar-expand p-0">
    <a class="navbar-brand text-left col-xs-12 col-md-3 col-lg-2 mr-2 text-white" ><img src="{{ asset('IconTransp.png') }}" alt="" style="width: 75px; height: auto;">Triggersy</a>
    <button class="btn btn-link d-block d-md-none" data-toggle="collapse" data-target="#sidebar-nav" role="button" >
        <span class="oi oi-menu"></span>
    </button>
</nav>

<div class="container-fluid h-100 p-0">
    <div style="min-height: 100%" class="flex-row d-flex align-items-stretch m-0">
        <div class="polished-sidebar bg-light col-12 col-md-3 col-lg-2 p-0 collapse d-md-inline" id="sidebar-nav">

            <ul class="polished-sidebar-menu ml-0 pt-4 p-0 d-md-block">
                <input class="border-dark form-control d-block d-md-none mb-4" type="text" placeholder="Search" aria-label="Search" />
                @auth
                    @if(auth()->user()->role != 'admin')
                        <li class="{{ request()->is('/') ? 'active' : ''}}"><a href="{{ route('home') }}"><span class="oi oi-dashboard"></span> Dashboard</a></li>
                        <li class="{{ request()->is('products') ? 'active' : ''}}"><a href="{{ route('products.index') }}"><span class="oi oi-pie-chart"></span>Products</a></li>
                        <li class="{{ request()->is('settings') ? 'active' : ''}}"><a href="{{ route('settings.index') }}"><span class="oi oi-pie-chart"></span>Settings</a></li>
                        <li class="{{ request()->is('instructions') ? 'active' : ''}}"><a href="{{ route('instructions') }}"><span class="oi oi-pie-chart"></span>Instructions</a></li>
                    @else
                        <li class="{{ request()->is('/home') ? 'active' : ''}}"><a href="/home"><span class="oi oi-dashboard"></span> Dashboard</a></li>
                        <li class="{{ request()->is('stores') ? 'active' : ''}}"><a href="{{ route('stores.index') }}"><span class="oi oi-pie-chart"></span>Stores</a></li>
                        <li class="{{ request()->is('plans') ? 'active' : ''}}"><a href="{{ route('plans.index') }}"><span class="oi oi-pie-chart"></span>Plans</a></li>
                    @endif
                @endauth
            </ul>

        </div>
        <div class="col-lg-10 col-md-9 p-4">
            @yield('content')
        </div>
    </div>
</div>


<script src="https://code.jquery.com/jquery-1.10.2.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
<script src="{{ asset('js/toastr.min.js') }}"></script>
@yield('js')

</body>

</html>
