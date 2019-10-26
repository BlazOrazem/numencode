let Json = (function () {
    return {
        post: function (url, post, callback) {
            jQuery.ajax({
                type: 'POST',
                data: post,
                url: url,
                dataType: "json"
            }).then(function(data){
                callback(data);
            });
        },

        call: function (url, callback) {
            jQuery.ajax({
                url: url,
                dataType: "json"
            }).then(function(data){
                callback(data);
            });
        }
    };
})();

let Ajax = (function () {
    return {
        call: function (url, callback) {
            jQuery.ajax({
                type: 'GET',
                url: url,
                dataType: "html"
            }).then(function(data){
                callback(data);
            });
        }
    };
})();

let TapHover = (function () {
    return {
        init: function () {
            $('.taphover').on("touchstart", function (e) {
                "use strict"; //satisfy the code inspectors

                let link = $(this);

                if (link.hasClass('hover')) {
                    return true;
                } else {
                    link.addClass("hover");
                    $('.taphover').not(this).removeClass("hover");
                    e.preventDefault();

                    return false;
                }
            });
        }
    };
})();
