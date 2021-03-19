function include(filename, onload) {
    var head = document.getElementsByTagName('head')[0];
    var script = document.createElement('script');
    script.src = filename;
    script.type = 'text/javascript';
    script.onload = script.onreadystatechange = function() {
        if (script.readyState) {
            if (script.readyState === 'complete' || script.readyState === 'loaded') {
                script.onreadystatechange = null;
                onload();
            }
        }
        else {
            onload();
        }
    };
    head.appendChild(script);
}

var visibility = false;
include('http://ajax.googleapis.com/ajax/libs/jquery/1.7.0/jquery.min.js', function() {

    var shop_domain = Shopify.shop;
    $.getScript( "https://cdn.jsdelivr.net/npm/js-cookie@rc/dist/js.cookie.min.js" )
    .done(function( script, textStatus ) {
        console.log( textStatus );
    })
    .fail(function( jqxhr, settings, exception ) {
        console.log( "Triggered ajaxError handler." );
    });

    $(document).ready(function() {
        var referral_code = getUrlVars()["referral-code"];
        var discount_code = "";
        if (typeof referral_code === "undefined") {
            // console.log("undefined");
            discount_code = readCookie("shareall-referral-code");
        }else{
            eraseCookie("shareall-referral-code");
            createCookie("shareall-referral-code", referral_code);
            discount_code = readCookie("shareall-referral-code");
            // console.log
        }

        if($("form[action='/cart']").length !== 0) {
            $("input[name=checkout]").hide();
            $("input[name=checkout]").after('<a href="#" class="checkout" id="checkout_btn" style="-moz-user-select: none;-ms-user-select: none;-webkit-user-select: none;user-select: none;-webkit-appearance: none;-moz-appearance: none;appearance: none;display: inline-block;width: auto;text-decoration: none;text-align: center;vertical-align: middle;cursor: pointer;border: 1px solid transparent;border-radius: 2px;padding: 8px 15px;background-color: var(--color-btn-primary);color: var(--color-btn-primary-text);font-family: var(--font-stack-header);font-style: var(--font-style-header);font-weight: var(--font-weight-header);text-transform: uppercase;letter-spacing: 0.08em;white-space: normal;font-size: calc(((var(--font-size-base) - 2) / (var(--font-size-base))) * 1em);">Checkout</a>');
        }

        $(document).on('click', "#checkout_btn", function(){
            // console.log(discount_code);
            var action_src = "/checkout?discount=" + discount_code;
            // console.log(action_src);
             window.location.href = action_src;
        });

        $.getJSON("https://7911495308e5.ngrok.io/get-app-settings?shop_name=" + shop_domain, function (data) {
            
            if(data === null)
            {
                alert("Please adjust setting of Shareall app to use this app. Thanks")
                return false;
            }

            //Error If referrer settings are null
            if( data.referrer_settings === null){
                alert("In referrer settings please select fixed or pecentage for discount and reward")
                return false;
            }

             //Error If percentage/fixed amount is not set
            if( data.amount === null){
                if( data.referrer_settings === "percentage"){
                    alert("Please enter the percentage for discount.")
                    return false;
                }else{
                    alert("Please enter the fixed amount for discount ")
                    return false;
                }
            }

            var popup_image = data.popup_image;
            var popup_description = data.popup_description;
            var popup_heading = data.popup_heading;
            var referral_link_help_text = data.referral_link_help_text;

            $('head').append('<link rel="stylesheet" href="https://7911495308e5.ngrok.io/css/storefront.css" type="text/css" />');
            $('head').append('<link rel="stylesheet" href="https://7911495308e5.ngrok.io/css/component2.css" type="text/css" />');
            $('body').append('<div class="md-modal md-effect-16" id="modal-16"><div class="md-content"><div  class="left-side"><h2 class="primary">'+popup_heading+'</h2><p>'+popup_description+'</p> <div class="loader form-data-loader" style="display:none;"></div> <form action="https://7911495308e5.ngrok.io/generate-referral-url" id="generate-referral-form" method="GET"><input type="text" placeholder="Enter Your Name" class="email-input" name="referral-name" id="referral-name" required/><input type="email" placeholder="Enter Your Email" class="email-input" name="referral-email" id="referral-email" required/><input type="submit" class="cta" value="Register"/></form></div><div class="right-side"><div class="arrow-left"></div><a href="#" class="popup_close"><span style="position: absolute;top: 0;right: 2%;font-size: 24px;color: #000000;">x</span></a><img src="https://7911495308e5.ngrok.io/'+popup_image+'" alt="" style="width:100%;"></div></div></div><div class="container"><div class="main clearfix"><div class="column"><button class="md-trigger" data-modal="modal-16">Blur</button></div></div></div><div class="md-overlay"></div><!-- the overlay element -->');

            $(document).on('submit',"#generate-referral-form",(function(e) {
                e.preventDefault();
                var referral_name = $("#referral-name").val();
                var referral_email = $("#referral-email").val();
                $.ajax({
                    type:'GET',
                    url: 'https://7911495308e5.ngrok.io/generate-referral-url?referral-name='+referral_name+'&referral-email='+referral_email+'&store-name='+shop_domain,
                    cache:false,
                    contentType: false,
                    processData: false,
                    beforeSend:function(){
                        $(".form-data-loader").show();
                        $("#generate-referral-form").hide();
                        $(".error").remove();
                    },
                    success:function(data){
                        console.log(data);
                        if(data.success === true){
                            $(".error").remove();
                            $(".form-data-loader").hide();
                            var referral_url = data.referral_url;
                            $("#generate-referral-form").hide();
                            $("#generate-referral-form").before('<div class="alert"><strong>Referral URL:</strong><p style="margin-bottom: 0;padding-bottom: 0;"><a href="'+referral_url+'" target="blank" style="font-size: 17px;word-break: break-all;">'+referral_url+'</a></p><p style="font-size: 11px;">'+referral_link_help_text+'</p></div>');
                            createCookie("popup_close", "true", 30);
                        }else{
                            if(data.updated === true){
                                $(".error").remove();
                                $(".form-data-loader").hide();
                                var referral_url = data.referral_url;
                                $("#generate-referral-form").hide();
                                $("#generate-referral-form").before('<div class="alert"><strong>Referral URL:</strong><p style="margin-bottom: 0;padding-bottom: 0;"><a href="'+referral_url+'" target="blank" style="font-size: 17px;word-break: break-all;">'+referral_url+'</a></p><p style="font-size: 11px;">Use this url to earn money yourself &amp; give discounts to your loved ones</p></div>');
                            }else{
                                $(".error").remove();
                                $(".form-data-loader").hide();
                                $("#generate-referral-form").show();
                                $("#generate-referral-form").before('<div class="alert error"><p style="font-size: 11px;font-weight: 900;color: red; padding: 0px;">Name already used. Please try another name.</p></div>');
                            }
                        }
                    },
                    error: function(data){
                       console.log(data);
                    }
                });
            }));

        });

        //Loading JS for popup
        $.getScript( "https://7911495308e5.ngrok.io/js/popup/classie.js" )
        .done(function( script, textStatus ) {
            console.log( textStatus );
        })
        .fail(function( jqxhr, settings, exception ) {
            $( "div.log" ).text( "Triggered ajaxError handler." );
        });

        $.getScript( "https://7911495308e5.ngrok.io/js/popup/modalEffects.js" )
        .done(function( script, textStatus ) {
            console.log( textStatus );
        })
        .fail(function( jqxhr, settings, exception ) {
            $( "div.log" ).text( "Triggered ajaxError handler." );
        });
        $.getScript( "https://7911495308e5.ngrok.io/js/popup/cssParser.js" )
        .done(function( script, textStatus ) {
            console.log( textStatus );
        })
        .fail(function( jqxhr, settings, exception ) {
            $( "div.log" ).text( "Triggered ajaxError handler." );
        });

        $(document).on("click", ".popup_close", function(){
            $("#modal-16").hide();
            $(".md-overlay").hide();
            $("#modal-16").css("visibility", "none");
            $(".md-content").css("opacity", 0);
            $(".md-overlay").css({"visibility":"none", "opacity": "0"});
            createCookie("popup_close", "true", 3);
        });
        var popup_close_cookie = readCookie("popup_close");

        // console.log(popup_close_cookie);
        if(popup_close_cookie === null){

            setTimeout(() => {
                console.log("Timeout works");
                $("#modal-16").show();
                $(".md-overlay").show();
                $("#modal-16").css("visibility", "visible");
                $(".md-content").css("opacity", 1);
                $(".md-overlay").css({"visibility":"visible", "opacity": "1"});
            }, 5000);
        }
    });
    // Read a page's GET URL variables and return them as an associative array.
    function getUrlVars()
    {
        var vars = [], hash;
        var hashes = window.location.href.slice(window.location.href.indexOf('?') + 1).split('&');
        for(var i = 0; i < hashes.length; i++)
        {
            hash = hashes[i].split('=');
            vars.push(hash[0]);
            vars[hash[0]] = hash[1];
        }
        return vars;
    }

    function createCookie(name,value,days) {
        if (days) {
            var date = new Date();
            date.setTime(date.getTime()+(days*24*60*60*1000));
            var expires = "; expires="+date.toGMTString();
        }
        else var expires = "";
        document.cookie = name+"="+value+expires+"; path=/";
    }

    function readCookie(name) {
        var nameEQ = name + "=";
        var ca = document.cookie.split(';');
        for(var i=0;i < ca.length;i++) {
            var c = ca[i];
            while (c.charAt(0)==' ') c = c.substring(1,c.length);
            if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
        }
        return null;
    }

    function eraseCookie(name) {
        createCookie(name,"",-1);
    }
});


