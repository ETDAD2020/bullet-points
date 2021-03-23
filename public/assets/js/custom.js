var referral_check = false;
function create_referrals(name, email)
{
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        type: 'POST',
        url: '/add-referrals',
        data: {
            "referral_name" : name,
            "referral_email" : email,
        },
        error: function() {
            toastr.error('We encountered an error. Please try again');
        },
        beforeSend: function() {
            console.log('Before Send');
        },
        success: function(data) {
            var t = $('#referral-table').DataTable();
            var referral_url = '<div class="code-box-copy" style="font-size: 12px;"><button class="code-box-copy__btn" data-clipboard-target="#example-head" title="Copy"></button><pre class=" language-html"><code class=" language-html" id="example-head">'+data.referral_url+'</code></pre></div>'
            t.row.add([
                data.referral_id,
                data.referral_name,
                data.referral_email,
                // data.created_at,
                referral_url
            ]).draw( false );
            toastr.success('Referral Created Successfully');
        }
    });
}

function check_referrals(referral_name, referral_email){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        type: 'POST',
        url: '/check-referrals',
        data: {
            "referral_name" : referral_name
        },
        error: function() {
            console.log('Error');
        },
        beforeSend: function() {
            console.log('Before Send');
        },
        success: function(data) {
            referral_check = data.success;
            if(referral_check === true){
                create_referrals(referral_name, referral_email);
            }else{
                toastr.error('Name already used. Try another please');
            }
            console.log(referral_check);
        }
    });
}

function update_settings(store_name, setting_type, check = 0){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        type: 'POST',
        url: '/update-app-settings',
        data: {
            "store_name" : store_name,
            "setting_type" : setting_type,
            "check" : check
        },
        error: function() {
            toastr.error('Encountered an error.');
        },
        beforeSend: function() {
            console.log('Before Send');
        },
        success: function(data) {
            if(data.success === true){
                toastr.success('App settings updated.');
                if(setting_type === "all_website" && check === 1){
                    $("#popup-all-website").attr("onchange", "update_settings('"+store_name+"', 'all_website', 0)");
                }else{
                    $("#popup-all-website").attr("onchange", "update_settings('"+store_name+"', 'all_website', 1)")
                }

                if(setting_type === "order_status" && check === 1){
                    $("#popup-order-status").attr("onchange", "update_settings('"+store_name+"', 'order_status', 0)");
                }else{
                    $("#popup-order-status").attr("onchange", "update_settings('"+store_name+"', 'order_status', 1)")
                }

                if(setting_type === "percentage"){
                    $(".percentage-option").show();
                    $(".fixed-option").hide();
                }else if(setting_type === "fixed"){
                    $(".percentage-option").hide();
                    $(".fixed-option").show();
                }
            }else{
                toastr.error('Encountered an error.');
            }
        }
    });
}

function update_amount(type, amount){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        type: 'POST',
        url: '/update-amount',
        data: {
            "type" : type,
            "amount" : amount
        },
        error: function(data) {
            toastr.error('Encountered an error.');
        },
        success: function(data) {
            if(data.success === true){
                toastr.success('App settings updated.');
            }else{
                toastr.error('Encountered an error.');
            }
        }
    });
}
/*
** Name: Create Promotion | Data Table
** Description: Code for Progress bar and steps tabs
** Date: Dec 23, 2020
** Author: hammaad | Swishtag Dev
*/

$(document).ready( function () {
    $("#add-referral-button").click(function(event){
        event.preventDefault();
        var referral_name = $("#referralName").val();
        var referral_email = $("#referralEmail").val();
        check_referrals(referral_name, referral_email);
    });

    $('#update-settings').on('submit',(function(e) {
        e.preventDefault();
        var formData = new FormData(this);

        $.ajax({
            type:'POST',
            url: $(this).attr('action'),
            data:formData,
            cache:false,
            contentType: false,
            processData: false,
            success:function(data){
                toastr.success('Email Settings Updated');
            },
            error: function(data){
                if(data.status === 413){
                    toastr.error('Encountered an error. Max file size: 3MB');
                }else{
                    toastr.error('Encountered an error. Please try again');
                }
            }
        });
    }));



    // $('#update-popup-settings').on('submit',(function(e) {
    //     e.preventDefault();
    //     var formData = new FormData(this);

    //     $.ajax({
    //         type:'POST',
    //         url: $(this).attr('action'),
    //         data:formData,
    //         cache:false,
    //         contentType: false,
    //         processData: false,
    //         success:function(data){
    //             if(data.success === true){
    //                 toastr.success('Success')
    //             }else{
    //                 toastr.error('Error','We encountered an error!')
    //             }
    //         },
    //         error: function(data){
    //             toastr.error('Error','We encountered an error!')
    //         }
    //     });
    // }));

    $("#withdraw_button").click(function(){
        var name = $(this).attr("data-name");
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: 'POST',
            url: '/withdrwal-request',
            data: {
                "name" : name
            },
            error: function(data) {
                toastr.error('We encountered some error. Please try again')
                // $("#withdraw_button").remove();
            },
            success: function(data) {
                // console.log(data);
                toastr.success('Withdraw request submitted succesfully.');
                $("#withdraw_button").remove();
            }
        });
    });

    $(".withdrawal_status").change(function(){
        var withdrawal_id = $(this).attr("data-withdrawal");
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: 'POST',
            url: '/withdrawal-update-status',
            data: {
                "withdrawal_id" : withdrawal_id
            },
            error: function(data) {
                toastr.error('We encountered some error. Please try again')
            },
            success: function(data) {
                console.log(data);
                if(data.success === true){
                    toastr.success('Withdraw status changed succesfully.');
                    $(this).hide();
                    $("#pending-withdrawal-"+withdrawal_id).removeClass('badge-warning');
                    $("#pending-withdrawal-"+withdrawal_id).addClass('badge-success');
                    $("#pending-withdrawal-"+withdrawal_id).text('Completed');
                }
            }
        });
    });
});
