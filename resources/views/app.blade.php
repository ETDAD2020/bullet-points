@extends('shopify-app::layouts.default')

@section('styles')
<link href="{{ mix('/css/app.css') }}" rel="stylesheet" />
<script src="{{ mix('/js/app.js') }}" defer></script>
<link
  rel="stylesheet"
  href="https://unpkg.com/@shopify/polaris@5.5.0/dist/styles.css"
/>

<style>
.Polaris-Frame{
    min-height: 0vh;
}
#app{
    /* background-image: url(https://cdn.shopify.com/s/files/1/0514/1276/2822/files/background.jpeg?v=1607610435); */
}
</style>
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
