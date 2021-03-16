@extends('layouts.master')

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
                <h3>Settings</h3>
            </div>
        </div>
    </div>

    <div class="row ">
        <div class="col-md-12 pl-3 pt-2">
            <div class="row pl-3">

                <form action="{{ route('settings.store') }}" method="POST">
                    <div class="d-flex text-right justify-content-end" style="width: 94% !important;">
                        <button class="btn btn-primary">Save</button>
                    </div>
                    @csrf
                    <input type="text"  name="icon" class="d-none selected-icon" @if($settings != null) value="{{ $settings->icon }}" @else value="" @endif>
                    <input type="text"  name="emoji" class="d-none selected-emoji" @if($settings != null) value="{{ $settings->emoji }}" @else value="" @endif>

                    <div class="col-md-12 col-lg-12 col-12 mb-2 col-sm-12">
                        @if($settings != null)
                            @if($settings->icon !== null)
                                <div class="p-3 bg-white-darker my-3" style="width: 95% !important;">
                                    <label class="fs-3">Selected Settings</label><br>
                                    <i class="fa {{ $settings->icon }} fa-4x ml-3" style="color: {{ $settings->color }}"></i>
                                </div>
                            @else
                                <div class="p-3 bg-white-darker my-3" style="width: 95% !important;">
                                    <label class="fs-3">Selected Settings</label><br>
                                    <p style="font-size:50px">{{ $settings->emoji }}</p>
                                </div>
                            @endif
                        @endif
                        <label class="fs-3">Select Color</label>
                        <div id="cp-component" class="input-group" style="width: 95% !important;">
                            <input type="text" name="color" value="#269faf" class="form-control" />
                            <span class="input-group-addon" >
                            <i style="padding: 20px;background-color: rgb(38, 159, 175);"></i>
                        </span>
                        </div>


                        <div class="details">
                            <div class="details-wrapper">
                                <div class="demo"></div>

                                <div class="code">
                                    <div class="name"></div>
                                    <div class="info"></div>
                                    <div class="copy"></div>
                                </div>
                            </div>
                        </div>
                        <div class="emojis-details">
                        </div>

                        <label for="" class="fs-3 mt-3">Select Icon</label>
                        <div class="list">
                            <ul class="icons"></ul>
                            <div class="clearfix"></div>
                        </div>


                        <label for="" class="fs-3 mt-3">Select Emojis</label>
                        <div class="list">
                            <ul class="emojis">
                                <li class="emoji" data-emoji="&#128525;">&nbsp; &#128525;</li>
                                <li class="emoji" data-emoji="&#128512;">&nbsp; &#128512;</li>
                                <li class="emoji" data-emoji="&#129303;">&nbsp; &#129303;</li>
                                <li class="emoji" data-emoji="&#128077;">&nbsp; &#128077;</li>
                                <li class="emoji" data-emoji="&#128073;">&nbsp; &#128073;</li>
                                <li class="emoji" data-emoji="&#128170;">&nbsp; &#128170;</li>
                                <li class="emoji" data-emoji="&#10024;">&nbsp; &#10024;</li>
                                <li class="emoji" data-emoji="&#9889;">&nbsp; 	&#9889;</li>
                                <li class="emoji" data-emoji="&#127775;">&nbsp; &#127775;</li>
                                <li class="emoji" data-emoji="&#11088;">&nbsp; &#11088;</li>
                                <li class="emoji" data-emoji="&#128293;">&nbsp; &#128293;</li>
                                <li class="emoji" data-emoji="&#9728;">&nbsp; &#9728;</li>
                                <li class="emoji" data-emoji="&#128171;">&nbsp; &#128171;</li>
{{--                                <li class="emoji" data-emoji="&#128717;">&nbsp; &#128717;</li>--}}
                                <li class="emoji" data-emoji="&#127880;">&nbsp; &#127880;</li>
                                <li class="emoji" data-emoji="&#127873;">&nbsp; &#127873;</li>
                                <li class="emoji" data-emoji="&#128722;">&nbsp; &#128722;</li>
                                <li class="emoji" data-emoji="&#127881;">&nbsp; &#127881;</li>
                                <li class="emoji" data-emoji="&#128150;">&nbsp; &#128150;</li>
                                <li class="emoji" data-emoji="&#128156;">&nbsp; &#128156;</li>
                                <li class="emoji" data-emoji="&#128155;">&nbsp; &#128155;</li>
                                <li class="emoji" data-emoji="&#128154;">&nbsp; &#128154;</li>
                                <li class="emoji" data-emoji="&#128153;">&nbsp; &#128153;</li>
                                <li class="emoji" data-emoji="&#128157;">&nbsp; &#128157;</li>
                                <li class="emoji" data-emoji="&#128158;">&nbsp; &#128158;</li>
                                <li class="emoji" data-emoji="&#128159;">&nbsp; &#128159;</li>
                                <li class="emoji" data-emoji="&#128152;">&nbsp; &#128152;</li>
                                <li class="emoji" data-emoji="&#128150;">&nbsp; &#128150;</li>
                                <li class="emoji" data-emoji="&#128149;">&nbsp; &#128149;</li>
                                <li class="emoji" data-emoji="&#128147;">&nbsp; &#128147;</li>
                                <li class="emoji" data-emoji="&#10071;">&nbsp; &#10071;</li>
                                <li class="emoji" data-emoji="&#9989;">&nbsp; &#9989;</li>
                            </ul>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>




@endsection

@section('js')
    <script src="https://code.jquery.com/ui/1.11.2/jquery-ui.js"></script>
    <script src="https://yandex.st/highlightjs/7.3/highlight.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-colorpicker/2.5.3/js/bootstrap-colorpicker.js"></script>
    <script src="{{ asset('js/icons.js') }}"></script>
    <script src="{{ asset('js/aliases.js') }}"></script>
    <script src="{{ asset('js/script.js') }}"></script>

    <script type="text/javascript">
        $(function () {
            $('#cp-component').colorpicker();
            $('.emoji').click(function() {
                $('.emojis li.active').removeClass('active');
                $(this).addClass('active');
                $('.details').hide();
                // console.log(123, $('.selected-icon').val());
                $('.selected-icon').val(null);
                // console.log(456, $('.selected-icon').val());
                $('.selected-emoji').val($(this).data('emoji'));
                $('.emojis-details').empty();
                $('.emojis-details').append(`
                    <p style="font-size:100px">${ $(this).data('emoji') }</p>
                `);
                $('.emojis-details').fadeIn();
            })
        });

        @if($errors->any())
            @foreach($errors->all() as $error)
                toastr.error("{{ $error }}") ;
            @endforeach
        @endif


    </script>

@endsection
