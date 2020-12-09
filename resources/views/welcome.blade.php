@extends('shopify-app::layouts.default')

@section('styles')
<link href="{{ mix('/css/app.css') }}" rel="stylesheet" />
<script src="{{ mix('/js/app.js') }}" defer></script>
@endsection

@section('content')
@inertia

<input type="hidden" id="apiKey" value="{{ config('shopify-app.api_key') }}">
<input type="hidden" id="shopOrigin" value="{{ Auth::user()->name }}">
@endsection

@section('scripts')
    @parent

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
@endsection
