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

include('http://ajax.googleapis.com/ajax/libs/jquery/1.7.0/jquery.min.js', function() {

    var shop_domain = Shopify.shop;
    var page_url = $(location).attr("href");
    $(document).ready(function() {
        $('head').append('<link rel="stylesheet" href="https://a97a379064df.ngrok.io/css/storefront.css" type="text/css" />');
        $.getJSON("https://a97a379064df.ngrok.io/get-app-settings?shop_name=" + shop_domain, function (data) {
            var cart_page  = data[0].cart_page;
            var notification_type  = data[0].notification_type;
            var product_page  = data[0].product_page;
            console.log(data[0].product_id);
            console.log(data[0].variant_id);

            if(notification_type == "button_type" )
            {
                if(product_page != null)
                {
                    $("form[action*='/cart/add']").append('<div class="route-wrapper"> <div class="route-left"> <img src="https://a97a379064df.ngrok.io/css/shield.png" alt=""> <h6>Storeks Shipping Protection</h6> <p>Coverage for loss, Damage & Theft $0.98</p> </div> <div class="route-right"> <div class="onoffswitch"> <input type="checkbox" name="onoffswitch" class="onoffswitch-checkbox" id="myonoffswitch" tabindex="0" data-product="'+data[0].product_id+'" data-variant="'+data[0].variant_id+'"> <label class="onoffswitch-label" for="myonoffswitch"> <span class="onoffswitch-inner"></span> <span class="onoffswitch-switch"></span> </label> </div> </div> </div>');
                }else if(cart_page != null){
                    $("form[action='/cart']").append('<div class="route-cart route-wrapper"> <div class="route-left"> <img src="https://a97a379064df.ngrok.io/css/shield.png" alt=""> <h6>Storeks Shipping Protection</h6> <p>Coverage for loss, Damage & Theft $0.98</p> </div> <div class="route-right"> <div class="onoffswitch"> <input type="checkbox" name="onoffswitch" class="onoffswitch-checkbox" id="myonoffswitch" tabindex="0" data-product="'+data[0].product_id+'" data-variant="'+data[0].variant_id+'"> <label class="onoffswitch-label" for="myonoffswitch"> <span class="onoffswitch-inner"></span> <span class="onoffswitch-switch"></span> </label> </div> </div> </div>');
                }
            }else{
                if(product_page != null)
                {
                    $("form[action*='/cart/add']").after('<button class="storeks-modal-button">Click to get protection Insurance</button><div class="storeks-modal"> <div class="storeks-modal-container"><h2 style="position: absolute;left: 25%;z-index: 999;top: 10%;">Get your Insurance Now</h2> <div class="storeks-modal-left"><div class="route-wrapper"><div class="route-left"><img src="https://a97a379064df.ngrok.io/css/shield.png" alt=""><h6>Storeks Shipping Protection</h6><p>Coverage for loss, Damage & Theft $0.98</p> </div><div class="route-right"><div class="onoffswitch"><input type="checkbox" name="onoffswitch" class="onoffswitch-checkbox" id="myonoffswitch" tabindex="0" data-product="'+data[0].product_id+'" data-variant="'+data[0].variant_id+'"><label class="onoffswitch-label" for="myonoffswitch"><span class="onoffswitch-inner"></span><span class="onoffswitch-switch"></span></label></div></div></div></div> <button class="icon-button close-button"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 50 50"><path d="M 25 3 C 12.86158 3 3 12.86158 3 25 C 3 37.13842 12.86158 47 25 47 C 37.13842 47 47 37.13842 47 25 C 47 12.86158 37.13842 3 25 3 z M 25 5 C 36.05754 5 45 13.94246 45 25 C 45 36.05754 36.05754 45 25 45 C 13.94246 45 5 36.05754 5 25 C 5 13.94246 13.94246 5 25 5 z M 16.990234 15.990234 A 1.0001 1.0001 0 0 0 16.292969 17.707031 L 23.585938 25 L 16.292969 32.292969 A 1.0001 1.0001 0 1 0 17.707031 33.707031 L 25 26.414062 L 32.292969 33.707031 A 1.0001 1.0001 0 1 0 33.707031 32.292969 L 26.414062 25 L 33.707031 17.707031 A 1.0001 1.0001 0 0 0 32.980469 15.990234 A 1.0001 1.0001 0 0 0 32.292969 16.292969 L 25 23.585938 L 17.707031 16.292969 A 1.0001 1.0001 0 0 0 16.990234 15.990234 z"></path></svg></button></div></div><script>const body = document.querySelector("body"); const modal = document.querySelector(".storeks-modal"); const modalButton = document.querySelector(".storeks-modal-button"); const closeButton = document.querySelector(".storeks-close-button"); const scrollDown = document.querySelector(".storeks-scroll-down"); let isOpened = false; const openModal = () => { modal.classList.add("is-open"); body.style.overflow = "hidden";  }; const closeModal = () => {  modal.classList.remove("is-open"); body.style.overflow = "initial"; }; window.addEventListener("scroll", () => { if (window.scrollY > window.innerHeight / 3 && !isOpened) { isOpened = true; scrollDown.style.display = "none";  openModal(); } }); modalButton.addEventListener("click", openModal); closeButton.addEventListener("click", closeModal); document.onkeydown = evt => { evt = evt || window.event; evt.keyCode === 27 ? closeModal() : false; }</script>');
                }else if(cart_page != null)
                {
                    $("form[action='/cart']").after('<button class="storeks-modal-button">Click to get protection Insurance</button><div class="storeks-modal"> <div class="storeks-modal-container"><h2 style="position: absolute;left: 25%;z-index: 999;top: 10%;">Get your Insurance Now</h2> <div class="storeks-modal-left"><div class="route-cart1 route-wrapper"><div class="route-left"><img src="https://a97a379064df.ngrok.io/css/shield.png" alt=""><h6>Storeks Shipping Protection</h6><p>Coverage for loss, Damage & Theft $0.98</p> </div><div class="route-right"><div class="onoffswitch"><input type="checkbox" name="onoffswitch" class="onoffswitch-checkbox" id="myonoffswitch" tabindex="0" data-product="'+data[0].product_id+'" data-variant="'+data[0].variant_id+'"><label class="onoffswitch-label" for="myonoffswitch"><span class="onoffswitch-inner"></span><span class="onoffswitch-switch"></span></label></div></div></div></div> <button class="icon-button close-button"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 50 50"><path d="M 25 3 C 12.86158 3 3 12.86158 3 25 C 3 37.13842 12.86158 47 25 47 C 37.13842 47 47 37.13842 47 25 C 47 12.86158 37.13842 3 25 3 z M 25 5 C 36.05754 5 45 13.94246 45 25 C 45 36.05754 36.05754 45 25 45 C 13.94246 45 5 36.05754 5 25 C 5 13.94246 13.94246 5 25 5 z M 16.990234 15.990234 A 1.0001 1.0001 0 0 0 16.292969 17.707031 L 23.585938 25 L 16.292969 32.292969 A 1.0001 1.0001 0 1 0 17.707031 33.707031 L 25 26.414062 L 32.292969 33.707031 A 1.0001 1.0001 0 1 0 33.707031 32.292969 L 26.414062 25 L 33.707031 17.707031 A 1.0001 1.0001 0 0 0 32.980469 15.990234 A 1.0001 1.0001 0 0 0 32.292969 16.292969 L 25 23.585938 L 17.707031 16.292969 A 1.0001 1.0001 0 0 0 16.990234 15.990234 z"></path></svg></button></div></div><script>const body = document.querySelector("body"); const modal = document.querySelector(".storeks-modal"); const modalButton = document.querySelector(".storeks-modal-button"); const closeButton = document.querySelector(".storeks-close-button"); const scrollDown = document.querySelector(".storeks-scroll-down"); let isOpened = false; const openModal = () => { modal.classList.add("is-open"); body.style.overflow = "hidden";  }; const closeModal = () => {  modal.classList.remove("is-open"); body.style.overflow = "initial"; }; window.addEventListener("scroll", () => { if (window.scrollY > window.innerHeight / 3 && !isOpened) { isOpened = true; scrollDown.style.display = "none";  openModal(); } }); modalButton.addEventListener("click", openModal); closeButton.addEventListener("click", closeModal); document.onkeydown = evt => { evt = evt || window.event; evt.keyCode === 27 ? closeModal() : false; }</script>');
                }
            }
        });

        $(document).on('change', '#myonoffswitch', function(){
            if($("#myonoffswitch").prop('checked') == true){
                var product_id = $(this).attr('data-product')
                var variant_id = $(this).attr('data-variant');
                // $.getJSON("/products/" + product_id + ".js", function (product) {
                    $.ajax({
                        method: "POST",
                        dataType: "json",
                        data: {
                          quantity: 1,
                          id: variant_id
                        },
                        url: "/cart/add.js",
                        success: function (data) {
                            if ($(".route-cart")[0] || $(".route-cart1")[0]){
                                location.reload();
                            } else {
                                console.log(data)
                            }
                        }
                      });
                // });
            }else{
                console.log($(this).attr('data-product'));
                console.log($(this).attr('data-variant'));
            }
        });

        $(document).on('click', '.close-button', function(){
            $(".is-open").removeClass('is-open');
        });
    });
});


