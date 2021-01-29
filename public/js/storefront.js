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
    var page_url = $(location).attr("href");
    $(document).ready(function() {
        $.getJSON("https://disable-right-click.ecomvert.net/get-app-settings?shop_name=" + shop_domain, function (data) {
            console.log(data);
            var disable_right_click  = data[0].disable_right_click;
            var disable_f12  = data[0].disable_f12;
            var disable_copy  = data[0].disable_copy;
            var disable_ctrl_shift_i  = data[0].disable_ctrl_shift_i;
            var disable_ctrl_anykey  = data[0].disable_ctrl_anykey;
            var disable_text_image_selection  = data[0].disable_text_image_selection;

            if(disable_right_click == "true"){
                document.oncontextmenu = document.body.oncontextmenu = function() {
                    return false;
                }
            }

            if(disable_f12 == "true"){
                document.onkeypress = function(event) {
                    event = (event || window.event);
                    if (event.keyCode == 123) {
                        return false;
                    }
                }
                document.onmousedown = function(event) {
                    event = (event || window.event);
                    if (event.keyCode == 123) {
                        return false;
                    }
                }
                document.onkeydown = function(event) {
                    event = (event || window.event);
                    if (event.keyCode == 123) {
                        return false;
                    }
                }
            }

            if(disable_copy == "true"){
                document.addEventListener("copy", function(evt) {
                    evt.clipboardData.setData("text/plain", "");
                    evt.preventDefault();
                }, false);
            }

            if(disable_ctrl_shift_i == "true"){
                document.onkeypress = function(event) {
                    event = (event || window.event);
                    if ((event.ctrlKey && event.shiftKey && event.keyCode == 73) || (event.ctrlKey && event.shiftKey && event.keyCode == 74) || (event.keyCode == 123)) {
                        return false;
                    }
                    if ((event.metaKey && event.shiftKey && event.keyCode == 73) || (event.metaKey && event.shiftKey && event.keyCode == 74) || (event.keyCode == 123)) {
                        console.log("cmd key");
                        return false;
                    }
                }
                document.onmousedown = function(event) {
                    event = (event || window.event);
                    if ((event.ctrlKey && event.shiftKey && event.keyCode == 73) || (event.ctrlKey && event.shiftKey && event.keyCode == 74) || (event.keyCode == 123)) {
                        return false;
                    }
                    if ((event.metaKey && event.shiftKey && event.keyCode == 73) || (event.metaKey && event.shiftKey && event.keyCode == 74) || (event.keyCode == 123)) {
                        console.log("cmd key");
                        return false;
                    }
                }
                document.onkeydown = function(event) {
                    event = (event || window.event);
                    if ((event.ctrlKey && event.shiftKey && event.keyCode == 73) || (event.ctrlKey && event.shiftKey && event.keyCode == 74) || (event.keyCode == 123)) {
                        return false;
                    }
                    if ((event.metaKey && event.shiftKey && event.keyCode == 73) || (event.metaKey && event.shiftKey && event.keyCode == 74) || (event.keyCode == 123)) {
                        console.log("cmd key");
                        return false;
                    }
                }
            }

            if(disable_ctrl_anykey == "true"){
                document.onkeypress = function(event) {
                    event = (event || window.event);
                    if ((event.ctrlKey && event.shiftKey && event.keyCode != 1) || (event.ctrlKey && event.keyCode != 1) || (event.keyCode == 123)) {
                        return false;
                    }
                    if ((event.metaKey && event.shiftKey && event.keyCode != 1) || (event.metaKey && event.keyCode != 1) || (event.keyCode == 123)) {
                        console.log("cmd key");
                        return false;
                    }
                }
                document.onmousedown = function(event) {
                    event = (event || window.event);
                    if ((event.ctrlKey && event.shiftKey && event.keyCode != 1) || (event.ctrlKey && event.keyCode != 1) || (event.keyCode == 123)) {
                        return false;
                    }
                    if ((event.metaKey && event.shiftKey && event.keyCode != 1) || (event.metaKey && event.keyCode != 1) || (event.keyCode == 123)) {
                        console.log("cmd key");
                        return false;
                    }
                }
                document.onkeydown = function(event) {
                    event = (event || window.event);
                    if ((event.ctrlKey && event.shiftKey && event.keyCode != 1) || (event.ctrlKey && event.keyCode != 1) || (event.keyCode == 123)) {
                        return false;
                    }
                    if ((event.metaKey && event.shiftKey && event.keyCode != 1) || (event.metaKey && event.keyCode != 1) || (event.keyCode == 123)) {
                        console.log("cmd key");
                        return false;
                    }
                }
            }

            if(disable_text_image_selection == "true"){
                $("body").css({"user-select": "none"});
                $("img").css({ "-o-user-drag": "none"});
            }
        });

    });

});


