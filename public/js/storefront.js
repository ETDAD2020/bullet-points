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
    $(document).ready(function() {
        $("head").append('<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">');
    });
});



