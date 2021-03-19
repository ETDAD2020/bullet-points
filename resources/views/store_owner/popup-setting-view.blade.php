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
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            @if($success == 1)
                <div class="alert alert-success email-setting-success-alert" role="alert">
                    <span>Popup Settings Updated</span>
                </div>
            @endif
            <div class="card-body">
                <h4 class="card-title">Popup/Modal Settings</h4>
                <div class="setting"></div>
                <form action="/update-popup-settings" id="update-popup-settings" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="setting image_picker">
                        <div class="settings_wrap">
                            <label class="drop_target">
                                <div class="image_preview"></div>
                                <input id="inputFile" name="popup-file" type="file"/>
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
                    <div class="form-group">
                        <label for="popup_heading">Popup/Modal Heading</label>
                        <input type="text" name="popup_heading" class="form-control" placeholder="Give $10 Get $10" max="16" id="pop_heading" value="{{ $app_settings->popup_heading }}">
                    </div>
                    <div class="form-group">
                        <label for="popup_description">Popup/Modal Description</label>
                        <input type="text" name="popup_description" class="form-control" placeholder="There are many variations of passages of Lorem Ipsum available" max="150" id="popup_description" value="{{ $app_settings->popup_description }}">
                    </div>
                    <div class="form-group">
                        <label for="referral_help_text">Popup/Modal Referral Help Text</label>
                        <input type="text" name="referral_help_text" class="form-control" placeholder="Referral Help Text" max="150" id="referral_help_text"  value="{{ $app_settings->referral_link_help_text }}">
                    </div>
                    <div class="col-md-12 row mt-4">
                        <button type="submit" class="btn btn-success mr-2" id="update-popup-settings">Update</button>
                        <a class="btn btn-light" id="getdata">Cancel</a>
                    </div>
                </form>
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
