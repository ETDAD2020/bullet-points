@extends('layouts.app')
@section('content')
            <!-- Page Title Header Starts-->
            <div class="row page-title-header">
                <div class="col-12">
                    <div class="page-header">
                        <h4 class="page-title">Settings</h4>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 grid-margin stretch-card">
                    <div class="card">
                        <div class="alert alert-success email-setting-success-alert" role="alert" style="display: none;">
                        </div>
                        <div class="alert alert-danger email-setting-error-alert" role="alert" style="display: none;">
                        </div>
                        <div class="card-body">
                            <h4 class="card-title">Email Template</h4>
                            <div class="setting"></div>
                            <form action="/update-email-settings" id="update-settings" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="setting image_picker">
                                    <div class="settings_wrap">
                                        <label class="drop_target">
                                            <div class="image_preview"></div>
                                            <input id="inputFile" name="email-logo-file" type="file"/>
                                        </label>
                                        <div class="settings_actions vertical">
                                            <a class="disabled" data-action="remove_current_image"><i class="fa fa-ban"></i> Remove Current Image</a>
                                        </div>
                                        <div class="image_details">
                                            <label class="input_line image_title">
                                                <input type="text" placeholder="Title"/>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="setting"></div>
                                <div class="form-group" style="background: hsl(0, 0%, 90%);padding: 5%;">
                                    <textarea class="forms-sample p-4" id="introduction" name="email">
                                        {{-- <div id="introduction"> --}}
                                            <h1> Share the LOVE</h1>
                                            <h3>You get $10 Off your next purchase,
                                            and they get $10 off too, when they buy this product</h3>
                                            <p>Refer a friend and earn $10 again and again</p>
                                        {{-- </div> --}}
                                    </textarea>
                                </div>
                                <div class="col-md-12 row mt-4">
                                    <button type="submit" class="btn btn-success mr-2" id="update-settings">Update</button>
                                    <a class="btn btn-light" id="getdata">Cancel</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>


                  <div class="col-md-6 grid-margin stretch-card">
                      <div class="card">
                        <div class="alert alert-success app-setting-success-alert" role="alert" style="display: none;">
                        </div>
                        <div class="alert alert-danger app-setting-error-alert" role="alert" style="display: none;">
                        </div>
                        <div class="card-body">
                            <h4 class="card-title">App Live</h4>
                            <div class="form-group">
                              <div class="form-check form-check-flat">
                                <label class="form-check-label">
                                  <input type="checkbox" class="form-check-input" id="app-live" @if($app_settings->app_live == "1") checked="" onchange="update_settings('{{Auth::user()->name}}', 'app_live', 1)" @else onchange="update_settings('{{Auth::user()->name}}', 'app_live', 0)" @endif> Enable App
                                </label>
                                {{-- <small><i class="input-helper">Check this box if you want to enable the app on frontend</i></small> --}}
                              </div>
                            </div>

                            <h4 class="card-title">Popup Settings</h4>
                            <div class="form-group">
                              <div class="form-check form-check-flat">
                                <label class="form-check-label">
                                  <input type="checkbox" class="form-check-input" id="popup-all-website" @if($app_settings->popup_all_website == "all_website") checked="" onchange="update_settings('{{Auth::user()->name}}', 'all_website', 1)" @else onchange="update_settings('{{Auth::user()->name}}', 'all_website', 0)" @endif> All Website <i class="input-helper"></i></label>
                              </div>
                              <div class="form-check form-check-flat">
                                <label class="form-check-label">
                                  <input type="checkbox" class="form-check-input" id="popup-order-status" @if($app_settings->popup_order_status == "order_status") checked="" onchange="update_settings('{{Auth::user()->name}}', 'order_status', 1)" @else onchange="update_settings('{{Auth::user()->name}}', 'order_status', 0)" @endif > Order Status Page <i class="input-helper"></i></label>
                              </div>
                            </div>

                          <hr class="mt-4 mb-4">

                          <h4 class="card-title mt-4">Refferrer Settings</h4>

                          <div class="form-group">
                              <div class="form-radio form-radio-flat">
                                <label class="form-check-label">
                                  <input type="radio" class="form-check-input refferrer-option" name="flatRadios1" id="flatRadios1" value="fixed" @if($app_settings->referrer_settings == "fixed") checked="" @endif onchange="update_settings('{{Auth::user()->name}}', 'fixed')"> Fixed <i class="input-helper"></i></label>
                              </div>
                              <div class="form-radio form-radio-flat">
                                <label class="form-check-label">
                                  <input type="radio" class="form-check-input refferrer-option" name="flatRadios1" id="flatRadios2" value="percentage" @if($app_settings->referrer_settings == "percentage") checked="" @endif onchange="update_settings('{{Auth::user()->name}}', 'percentage')"> Percentage <i class="input-helper"></i></label>
                              </div>
                          </div>
                            <div class="form-group fixed-option" @if($app_settings->referrer_settings == "fixed") style="display:block;" @else style="display:none;" @endif>
                               <hr class="mt-4 mb-4">
                                <label for="exampleFormControlSelect1">Fixed Amount</label>
                                <div class="input-group">
                                  <div class="input-group-prepend bg-primary border-primary">
                                    <span class="input-group-text bg-transparent text-white">$</span>
                                  </div>
                                  <input type="text" class="form-control" id="fixed_amount" value="{{$app_settings->amount}}" aria-label="Amount (to the nearest dollar)">
                                  <div class="input-group-append bg-primary border-primary">
                                    <span class="input-group-text bg-transparent text-white">.00</span>
                                  </div>
                                </div>
                            </div>

                            <div class="form-group percentage-option" @if($app_settings->referrer_settings == "percentage") style="display:block;" @else style="display:none;" @endif>
                                <hr class="mt-4 mb-4">
                                <label for="exampleFormControlSelect1">Percentage Value</label>
                                <div class="input-group">
                                    <input type="text" max="100" class="form-control" id="percentage_amount" value="{{$app_settings->amount}}" aria-label="Amount (to the nearest dollar)">
                                    <div class="input-group-append bg-primary border-primary">
                                        <span class="input-group-text bg-transparent text-white">%</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                      </div>
                    </div>
              </div>

@endsection
@section('scripts')
<!-- upload button -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/prefixfree/1.0.7/prefixfree.min.js"></script>
<script src="assets/upload/script.js"></script>
<script src="https://cdn.ckeditor.com/4.15.1/standard-all/ckeditor.js"></script>
<script>
    $(document).ready( function () {
        //show hide percentage fixed amount settings
        $('.refferrer-option').click(function(){
            var radio_value =  $('input[name="flatRadios1"]:checked').val();
            if(radio_value == 1){
                $('.fixed-option').show();
                $('.percentage-option').hide();
            }else if (radio_value == 2){
                $('.fixed-option').hide();
                $('.percentage-option').show();
            }
        });
        // The inline editor should be enabled on an element with "contenteditable" attribute set to "true".
        // Otherwise CKEditor 4 will start in read-only mode.
        var introduction = document.getElementById('introduction');
        introduction.setAttribute('contenteditable', true);

        CKEDITOR.inline('introduction', {
            // Allow some non-standard markup that we used in the introduction.
            extraAllowedContent: 'a(documentation);abbr[title];code',
            removePlugins: 'stylescombo',
            extraPlugins: 'sourcedialog',
            // Show toolbar on startup (optional).
            startupFocus: true
        });

        function getDataFromTheEditor() {
            return theEditor.getData();
        }
        document.getElementById( 'getdata' ).addEventListener( 'click', () => {
            alert( getDataFromTheEditor() );
        });

        $("#fixed_amount").change(function(){
            var amount = $(this).val();
            console.log(amount);
            update_amount("fixed", amount);
        });

        $("#percentage_amount").change(function(){
            var amount = $(this).val();
            console.log(amount);
            update_amount("percentage", amount);
        });
    });
</script>
@endsection
