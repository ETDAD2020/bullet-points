<!DOCTYPE html>
<!--[if IE 9]> <html class="ie9 no-js" lang="en"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!-->
<html class="no-js" lang="en">
<!--<![endif]-->

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
 
        <title><?php echo e(config('shopify-app.app_name')); ?></title>
    <!-- <link rel="stylesheet" href="http://localhost:3000/css/bootstrap4/dist/css/bootstrap-custom.css?v=datetime"> -->
    <link rel="stylesheet" href="<?php echo e(asset('polished.min.css')); ?>">
    <!-- <link rel="stylesheet" href="polaris-navbar.css"> -->
    <link rel="stylesheet" href="<?php echo e(asset('iconic/css/open-iconic-bootstrap.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('css/toastr.css')); ?>">

    <?php echo $__env->yieldContent('css'); ?>

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
    <a class="navbar-brand text-left col-xs-12 col-md-3 col-lg-2 mr-2 text-white" ><img src="<?php echo e(asset('logo.jpeg')); ?>" alt="" style="width: 25px; height: auto; margin-right: 5px; margin-bottom: 5px;">Bullet Pointer</a>
    <button class="btn btn-link d-block d-md-none" data-toggle="collapse" data-target="#sidebar-nav" role="button" >
        <span class="oi oi-menu"></span>
    </button>
</nav>

<div class="container-fluid h-100 p-0">
    <div style="min-height: 100%" class="flex-row d-flex align-items-stretch m-0">
        <div class="polished-sidebar bg-light col-12 col-md-3 col-lg-2 p-0 collapse d-md-inline" id="sidebar-nav">

            <ul class="polished-sidebar-menu ml-0 pt-4 p-0 d-md-block">
                <input class="border-dark form-control d-block d-md-none mb-4" type="text" placeholder="Search" aria-label="Search" />
                <?php if(auth()->guard()->check()): ?>
                    <?php if(auth()->user()->role != 'admin'): ?>
                        <li class="<?php echo e(request()->is('/') ? 'active' : ''); ?>"><a href="<?php echo e(route('home')); ?>"><span class="oi oi-dashboard"></span> Dashboard</a></li>
                        <li class="<?php echo e(request()->is('products') ? 'active' : ''); ?>"><a href="<?php echo e(route('products.index')); ?>"><span class="oi oi-pie-chart"></span>Products</a></li>
                        <li class="<?php echo e(request()->is('settings') ? 'active' : ''); ?>"><a href="<?php echo e(route('settings.index')); ?>"><span class="oi oi-pie-chart"></span>Settings</a></li>
                        <li class="<?php echo e(request()->is('instructions') ? 'active' : ''); ?>"><a href="<?php echo e(route('instructions')); ?>"><span class="oi oi-pie-chart"></span>Instructions</a></li>
                    <?php else: ?>
                        <li class="<?php echo e(request()->is('/home') ? 'active' : ''); ?>"><a href="/home"><span class="oi oi-dashboard"></span> Dashboard</a></li>
                        <li class="<?php echo e(request()->is('stores') ? 'active' : ''); ?>"><a href="<?php echo e(route('stores.index')); ?>"><span class="oi oi-pie-chart"></span>Stores</a></li>
                        <li class="<?php echo e(request()->is('plans') ? 'active' : ''); ?>"><a href="<?php echo e(route('plans.index')); ?>"><span class="oi oi-pie-chart"></span>Plans</a></li>
                    <?php endif; ?>
                <?php endif; ?>
            </ul>

        </div>
        <div class="col-lg-10 col-md-9 p-4">
            <?php echo $__env->yieldContent('content'); ?>
        </div>
    </div>
</div>


<script src="https://code.jquery.com/jquery-1.10.2.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
<script src="<?php echo e(asset('js/toastr.min.js')); ?>"></script>
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

    <?php if(Session::has('success')): ?>
    toastr.success("<?php echo e(Session::get('success')); ?>") ;
    <?php endif; ?>

    <?php if(Session::has('error')): ?>
    toastr.error("<?php echo e(Session::get('error')); ?>") ;
    <?php endif; ?>
</script>

        <?php if(config('shopify-app.appbridge_enabled')): ?>
            <script src="https://unpkg.com/@shopify/app-bridge<?php echo e(config('shopify-app.appbridge_version') ? '@'.config('shopify-app.appbridge_version') : ''); ?>"></script>
            <script>
                var AppBridge = window['app-bridge'];
                var createApp = AppBridge.default;
                var app = createApp({
                    apiKey: '<?php echo e(config('shopify-app.api_key')); ?>',
                    shopOrigin: '<?php echo e(Auth::user()->name); ?>',
                    forceRedirect: true,
                });
            </script>

            <?php echo $__env->make('shopify-app::partials.flash_messages', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php endif; ?>
<?php echo $__env->yieldContent('js'); ?>

</body>

</html>
<?php /**PATH /home/516655.cloudwaysapps.com/fwkpfhbxsv/public_html/resources/views/layouts/master.blade.php ENDPATH**/ ?>