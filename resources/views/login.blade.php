@extends('layouts.master-non')
@section('content')
<form method="GET" action="{{ route('home') }}">
    <input type="text" name="shop"/>
    <button type="submit">Submit</button>
 </form>
@endsection
