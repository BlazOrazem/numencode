var Json = (function () {
    return {
        post: function (url, post, callback) {
            jQuery.ajax({
                type: 'POST',
                data: post,
                url: url,
                dataType: "json"
            }).success(function(data){
                callback(data);
            });
        },

        call: function (url, callback) {
            jQuery.ajax({
                url: url,
                dataType: "json"
            }).success(function(data){
                callback(data);
            });
        }
    };
})();

var Ajax = (function () {
    return {
        call: function (url, callback) {
            jQuery.ajax({
                type: 'GET',
                url: url,
                dataType: "html"
            }).success(function(data){
                callback(data);
            });
        }
    };
})();

var TapHover = (function () {
    return {
        init: function () {
            $('.taphover').on("touchstart", function (e) {
                "use strict"; //satisfy the code inspectors
                var link = $(this);
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
var http = http || {};

/* request */
http.token = function () {
    return $('meta[name=_token]').attr('content');
};

http.get = function (url, callback) {
    return $.getJSON(url, callback)
        .error(function (data) {
            http.handleAjaxError(data);
        });
};

http.post = function (url, data) {
    return $.ajax({
        url: url,
        dataType: 'json',
        method: 'POST',
        beforeSend: function (xhr) {
            xhr.setRequestHeader("Content-Type", "application/json");
            xhr.setRequestHeader("Accept", "application/json");
            xhr.setRequestHeader('X-CSRF-TOKEN', http.token());
        },
        data: JSON.stringify(data)
    });
};

http.put = function (url, data) {
    data._method = 'PUT';
    return http.post(url, data);
};

http.patch = function (url, data) {
    data._method = 'PATCH';
    return http.post(url, data);
};

http.delete = function (url, data) {
    data._method = 'DELETE';
    return http.post(url, data);
};

/* response */
http.handleAjaxError = function (data) {
    alert('AJAX error - details have been dumped to console.');
    console.log(data);
};

var PreLoader = (function () {
    return {
        init: function () {
            $('#preloader').height($(window).height() + "px");
            $(window).on('load', function(){
                setTimeout(function(){
                    $('body').css("overflow-y","visible");
                    $('#preloader').fadeOut(400);
                }, 800);
            });
        }
    };
})();

var Responsive = (function () {
    return {
        init: function () {
            if($(window).width() >= 1440){
                $(".side-panel").addClass("open");
                $(".sidepanel-toggle").parent().addClass("open");
                $("body").addClass("small-content");
            }
            else{
                $(".side-panel").removeClass("open");
                $(".sidepanel-toggle").parent().removeClass("open");
                $("body").removeClass("fixed-sidebar-example small-content");
            }

            $(window).resize(function(){
                if($(window).width() >= 1440){
                    $(".side-panel").addClass("open");
                    $(".sidepanel-toggle").parent().addClass("open");
                    $("body").addClass("fixed-sidebar-example small-content");
                }
                else{
                    $(".side-panel").removeClass("open");
                    $(".sidepanel-toggle").parent().removeClass("open");
                    $("body").removeClass("fixed-sidebar-example small-content");
                }
            });
        }
    };
})();

var MetisMenu = (function () {
    return {
        init: function () {
            var url = $('#activeUrl').val();

            $('.metismenu li a[href="'+ url +'"]').parent().addClass('active');
            $('.metismenu li a[href="'+ url +'"]').parentsUntil(".metismenu").last().addClass('active');

            $('.metismenu').metisMenu({
                activeClass: 'active'
            });
        }
    };
})();

var JsTree = (function () {
    return {
        init: function () {
            $('.jstree').jstree({
                'core' : {
                    'themes' : {
                        'responsive': false
                    }
                },
                'types' : {
                    'default' : {
                        'icon' : 'jt jt-page'
                    },
                    "folder" : {
                        "icon" : "jt jt-folder"
                    },
                    "new" : {
                        "icon" : "jt jt-new"
                    }
                },
                "plugins" : [ "types", "state" ]
            });
        }
    };
})();

var DataTables = (function () {
    return {
        init: function () {
            $('.datatable:not(.search):not(.search-paginate)').DataTable({
                dom: '<"clear-filter">rti',
                info: false,
                paging: false,
                responsive: true,
                columnDefs: [{
                    "targets": 'no-sort',
                    "orderable": false
                }]
            });

            $('.datatable.search:not(.paginate)').DataTable({
                dom: '<"clear-filter">frti',
                info: false,
                paging: false,
                responsive: true,
                oLanguage: { "sSearch": "" },
                columnDefs: [{
                    "targets": 'no-sort',
                    "orderable": false
                }]
            });

            $('.datatable.search.paginate').DataTable({
                dom: '<"top"lf>rt<"bottom"ip><"clear">',
                info: true,
                paging: true,
                responsive: true,
                oLanguage: { "sSearch": "" },
                columnDefs: [{
                    "targets": 'no-sort',
                    "orderable": false
                }]
            });

            $('.datatable').each(function() {
                var dataTableInfo = $(this).closest('.data-table');
                dataTableInfo.find('.dataTables_filter input').attr("placeholder", $(this).data('search'));
            });
        }
    };
})();

var ScrollBar = (function () {
    return {
        init: function () {
            // Scroll for body
            if($(window).width() > 1024 && $("body").has(".navbar").length){
                $("body").mCustomScrollbar({
                    theme: "minimal-dark",
                    scrollInertia: 200,
                    mouseWheel:{ scrollAmount: 150 },
                    callbacks:{
                        onCreate: function(){
                            $(".mCSB_scrollTools").last().addClass("body-scroll");
                        }
                    }
                });
            }

            // Scroll for sidebar
            if($(window).width() > 768){
                $(".sidebar").mCustomScrollbar({
                    theme: "minimal",
                    scrollInertia: 0,
                    mouseWheel:{
                        preventDefault: true
                    }
                });
            }
            else{
                $(".sidebar").css("overflow-y", "auto");
            }

            // Content scroll
            if($(".content-scroll")[0]){
                $(".content-scroll").mCustomScrollbar({
                    theme: "minimal-dark",
                    scrollInertia: 50
                });
            }
        }
    };
})();

var WavesEffect = (function () {
    return {
        init: function () {
            Waves.attach('.btn');
            Waves.init();
        }
    };
})();

var MenuSearchBar = (function () {
    return {
        init: function () {
            var submitIcon = $('.searchbox-icon'),
                inputBox = $('.searchbox-input'),
                searchBox = $('.searchbox'),
                isOpen = false;
            submitIcon.on("click", function () {
                if (isOpen === false) {
                    searchBox.addClass('searchbox-open');
                    inputBox.focus();
                    isOpen = true;
                } else {
                    searchBox.removeClass('searchbox-open');
                    if ($(window).width() < 769) {
                        setTimeout(function () {
                            $(".page-title").fadeIn(300);
                        }, 100);
                    }
                    inputBox.focusout();
                    isOpen = false;
                }
            });
            submitIcon.on("mouseup", function () {
                return false;
            });
            searchBox.on("mouseup", function () {
                return false;
            });
            $(document).on("mouseup", function () {
                if (isOpen === true) {
                    $('.searchbox-icon').css('display', 'block');
                    submitIcon.click();
                }
            });
        }
    };
})();

var DropDownMenu = (function () {
    return {
        init: function () {
            if($('.dropdown')[0]) {
                //Propagate
                $('body').on('click', '.dropdown.open .dropdown-menu', function(e){
                    e.stopPropagation();
                });

                $('.dropdown').on('shown.bs.dropdown', function (e) {
                    if($(this).attr('data-animation')) {
                        $animArray = [];
                        $animation = $(this).data('animation');
                        $animArray = $animation.split(',');
                        $animationIn = 'animated '+$animArray[0];
                        $animationOut = 'animated '+ $animArray[1];
                        $animationDuration = '';
                        if(!$animArray[2]) {
                            $animationDuration = 500; //if duration is not defined, default is set to 500ms
                        }
                        else {
                            $animationDuration = $animArray[2];
                        }

                        $(this).find('.dropdown-menu').removeClass($animationOut);
                        $(this).find('.dropdown-menu').addClass($animationIn);
                    }
                });

                $('.dropdown').on('hide.bs.dropdown', function (e) {
                    if($(this).attr('data-animation')) {
                        e.preventDefault();
                        $this = $(this);
                        $dropdownMenu = $this.find('.dropdown-menu');

                        $dropdownMenu.addClass($animationOut);
                        setTimeout(function(){
                            $this.removeClass('open');

                        }, $animationDuration);
                    }
                });
            }
        }
    };
})();

var FullScreenMode = (function () {
    return {
        init: function () {
            function toggleFullScreen() {
                if (!document.fullscreenElement &&
                    !document.mozFullScreenElement && !document.webkitFullscreenElement && !document.msFullscreenElement ) {
                    if (document.documentElement.requestFullscreen) {
                        document.documentElement.requestFullscreen();
                    } else if (document.documentElement.msRequestFullscreen) {
                        document.documentElement.msRequestFullscreen();
                    } else if (document.documentElement.mozRequestFullScreen) {
                        document.documentElement.mozRequestFullScreen();
                    } else if (document.documentElement.webkitRequestFullscreen) {
                        document.documentElement.webkitRequestFullscreen(Element.ALLOW_KEYBOARD_INPUT);
                    }
                } else {
                    if (document.exitFullscreen) {
                        document.exitFullscreen();
                    } else if (document.msExitFullscreen) {
                        document.msExitFullscreen();
                    } else if (document.mozCancelFullScreen) {
                        document.mozCancelFullScreen();
                    } else if (document.webkitExitFullscreen) {
                        document.webkitExitFullscreen();
                    }
                }
            }

            $('.fullscreen').on("click", function(e){
                toggleFullScreen();
                $('.fullscreen i').toggleClass("zmdi-fullscreen zmdi-fullscreen-exit");
                e.preventDefault();
            });

            $('.fullscreen-btn').on('click', function(e){
                e.preventDefault();
                element = $(this).closest(".content-box").get(0);
                if (
                    document.fullscreenElement ||
                    document.webkitFullscreenElement ||
                    document.mozFullScreenElement ||
                    document.msFullscreenElement
                ) {
                    element.classList.remove("is-fullscreen");
                    $(this).find("i").toggleClass("zmdi-fullscreen-exit zmdi-fullscreen");
                    if (document.exitFullscreen) {
                        document.exitFullscreen();
                    } else if (document.mozCancelFullScreen) {
                        document.mozCancelFullScreen();
                    } else if (document.webkitExitFullscreen) {
                        document.webkitExitFullscreen();
                    } else if (document.msExitFullscreen) {
                        document.msExitFullscreen();
                    }
                } else {
                    element.classList.add("is-fullscreen");
                    $(this).find("i").toggleClass("zmdi-fullscreen zmdi-fullscreen-exit");
                    if (element.requestFullscreen) {
                        element.requestFullscreen();
                    } else if (element.mozRequestFullScreen) {
                        element.mozRequestFullScreen();
                    } else if (element.webkitRequestFullscreen) {
                        element.webkitRequestFullscreen(Element.ALLOW_KEYBOARD_INPUT);
                    } else if (element.msRequestFullscreen) {
                        element.msRequestFullscreen();
                    }
                }
            });
        }
    };
})();

$(document).ready(function() {

    PreLoader.init();

    Responsive.init();

    MetisMenu.init();

    JsTree.init();

    DataTables.init();

    ScrollBar.init();

    WavesEffect.init();

    MenuSearchBar.init();

    DropDownMenu.init();

    FullScreenMode.init();

    Form.init();
});
var Form = (function () {

    /**
     * Define form classes, currently set for Bootstrap 3 admin theme.
     */
    var _formValidate = 'form-validate';
    var _successColor = 'success-color';
    var _inputSuccess = 'input-success';
    var _formGroup = 'form-group';
    var _helpBlock = 'help-block';
    var _hasError = 'has-error';

    return {
        init: function () {
            $('.' + _formValidate).bind('submit', function(e) {
                e.preventDefault(e);
                Form.validateForm($(this));
            });

            $('.' + _formValidate + ' input').bind('blur', function() {
                Form.validateInputField($(this));
            });

            $('input[name="toggle"]').bind('click', function() {
                http.post($(this).data('toggle'));
            });
        },

        serialize: function (form) {
            var data = form.serializeArray();
            var result = {};

            $.each(data, function(key, item) {
                result[item.name] = item.value;
            });

            return result;
        },

        errors: function (data) {
            return $.parseJSON(data.responseText);
        },

        getGroupFor: function (form, name) {
            return form.find('[name=' + name + ']').closest('.' + _formGroup);
        },

        failFor: function (item, errorMsg) {
            item.addClass(_hasError);
            item.find('label').removeClass(_successColor);
            item.find('input').removeClass(_inputSuccess);
            item.find('.' + _helpBlock).html(errorMsg.join(' '));
        },

        successFor: function (item) {
            item.removeClass(_hasError);
            item.find('label').addClass(_successColor);
            item.find('input').addClass(_inputSuccess);
            item.find('.' + _helpBlock).html('');
        },

        validateForm: function (form) {
            http.post(form.attr('action'), Form.serialize(form))
                .success(function() {
                    form[0].submit();
                })
                .error(function(data) {
                    $.each(Form.errors(data), function(fieldName, error) {
                        Form.failFor(Form.getGroupFor(form, fieldName), error);
                    });
                });
        },

        validateInputField: function (field) {
            var form = field.closest('form');
            var fieldName = field.attr('name');
            
            if ($(field).hasClass('uri-slug')) {
                $(field).val(Form.slugify($(field).val()));
            }

            if ($(field).hasClass('snake-slug')) {
                $(field).val(Form.snakify($(field).val()));
            }

            http.post(form.attr('action'), Form.serialize(form))
                .success(function() {
                    Form.successFor(Form.getGroupFor(form, fieldName));
                })
                .error(function(data) {
                    var item = Form.getGroupFor(form, fieldName);

                    if (item.hasClass(_hasError)) {
                        Form.successFor(item);
                    }

                    $.each(Form.errors(data), function(name, error) {
                        if (name == fieldName) {
                            Form.failFor(Form.getGroupFor(form, fieldName), error);
                        }
                    });
                });
        },

        slugify: function (text) {
            return text.toString().toLowerCase()
                .replace(/\s+/g, '-')           // Replace spaces with -
                .replace(/[^\w\-]+/g, '')       // Remove all non-word chars
                .replace(/\-\-+/g, '-')         // Replace multiple - with single -
                .replace(/^-+/, '')             // Trim - from start of text
                .replace(/-+$/, '');            // Trim - from end of text
        },

        snakify: function (text) {
            return text.toString().toLowerCase()
                .replace(/\s+/g, '_')           // Replace spaces with _
                .replace(/[^\w\-]+/g, '')       // Remove all non-word chars
                .replace(/__+/g, '_')           // Replace multiple _ with single _
                .replace(/^_+/, '')             // Trim _ from start of text
                .replace(/_+$/, '');            // Trim _ from end of text
        }
    };
})();
//# sourceMappingURL=app.js.map
