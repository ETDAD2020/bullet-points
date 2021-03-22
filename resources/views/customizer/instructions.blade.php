@extends('layouts.master-non')
@section('menu')
<li class="{{ request()->is('dashboard') ? 'active' : ''}}"><a href="{{ route('dashboards') }}?id={{$user_id}}"><span class="oi oi-dashboard"></span> Dashboard</a></li>
<li class="{{ request()->is('products') ? 'active' : ''}}"><a href="{{ route('products.index') }}?id={{$user_id}}"><span class="oi oi-pie-chart"></span>Products</a></li>
<li class="{{ request()->is('settings') ? 'active' : ''}}"><a href="{{ route('settings.index') }}?id={{$user_id}}"><span class="oi oi-pie-chart"></span>Settings</a></li>
<li class="{{ request()->is('instructions') ? 'active' : ''}}"><a href="{{ route('instructions') }}?id={{$user_id}}"><span class="oi oi-pie-chart"></span>Instructions</a></li>
@endsection
@section('css')
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Ubuntu:300,400">
    <link rel="stylesheet" href="https://yandex.st/highlightjs/7.3/styles/default.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-colorpicker/2.5.3/css/bootstrap-colorpicker.css" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('css/jquery-ui.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/style.css') }}" />
@endsection
@section('content')
    <div class="row ">
        <div class="col-md-12 pl-3 pt-2">
            <div class="pl-3">
                <h3>Instructions</h3>
            </div>
        </div>
    </div>

    <div class="row ">
        <div class="col-md-12 pl-3 pt-2">
            <div class="row pl-3">
                <ul class="list-unstyled ml-3">
                    <li class="my-3">
                        <p>In case, you are not able to see bullet points in your store after you add them, you need to go to your admin store and click <strong>Theme</strong></p>
                    </li>
                    <li class="my-3 text-center">
                        <img src="{{ asset('theme.PNG') }}"  alt="no">
                    </li>
                    <li class="my-3">
                        <p>After that you need to click on your active theme, and then select edit code.</p>
                    </li>
                    <li class="my-3 text-center">
                        <img src="{{ asset('selecte_theme.PNG') }}" style="width: 70%; height: auto;" alt="no">
                    </li>
                    <li class="my-3">
                        <p>Later we need to find a file <code>product-template.liquid</code></p>
                    </li >
                    <li class="my-3 text-center">
                        <img src="{{ asset('product.PNG') }}"  alt="no">
                    </li>
                    <li class="my-3">
                        <p>Finally we need to add the following code snippet in our page</p>
                    </li>
                    <li class="my-3">
                        <pre>
                            <code>
                                &lt;div class="custom-extra-details"&gt;
                                    {% assign description = product.metafields.global %}
                                    {% assign key = 'extra_details' %}
                                    @{{ description.extra_details }}
                                &lt;/div&gt;
                            </code>
                        </pre>
                    </li>
                    <li class="my-3 text-center">
                        <img src="{{ asset('snip.PNG') }}" style="width: 70%; height: auto;" alt="no">
                    </li>
                </ul>
            </div>
        </div>
    </div>




@endsection

@section('js')

@endsection
