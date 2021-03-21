@extends('layouts.master')

@section('content')
    <div class="row ">
        <div class="col-md-12 pl-3 pt-2">
            <div class="pl-3">
                <h3>Dashboard</h3>
            </div>
        </div>
    </div>


    <div class="row ">
        <div class="col-md-12 pl-3 pt-2">
            <div class="row pl-3">

                <div class="col-md-6 col-lg-6 col-12 mb-2 col-sm-6">
                    <div class="media shadow-sm p-0 bg-white rounded text-primary ">
                        <span class="oi top-0 rounded-left bg-primary text-light h-100 p-4 oi-badge fs-5"></span>
                        <div class="media-body p-2">
                            <h6 class="media-title m-0">Products</h6>
                            <div class="media-text">
                                <h3>{{ auth()->user()->products->count() }}</h3>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-6 col-12 mb-2 col-sm-6">
                    <div class="media shadow-sm p-0 bg-success-lighter text-light rounded">
                        <span class="oi top-0 rounded-left bg-white text-success h-100 p-4 oi-people fs-5"></span>
                        <div class="media-body p-2">
                            <h6 class="media-title m-0">Icons/Emojis</h6>
                            <div class="media-text">
                                <h3>147</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
