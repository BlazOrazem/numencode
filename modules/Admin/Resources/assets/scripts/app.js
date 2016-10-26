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
            var url = window.location;
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
                dom: '<"toolbar"><"clear-filter">rti',
                info: false,
                paging: true,
                responsive: true,
                columnDefs: [{
                    "targets": 'no-sort',
                    "orderable": false
                }]
            });

            $('.datatable.search:not(.paginate)').DataTable({
                dom: '<"toolbar"><"clear-filter">frti',
                info: false,
                paging: true,
                responsive: true,
                oLanguage: { "sSearch": "" },
                columnDefs: [{
                    "targets": 'no-sort',
                    "orderable": false
                }]
            });

            $('.datatable.search.paginate').DataTable({
                dom: '<"toolbar"><"top"fl>rt<"bottom"ip><"clear">',
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
                var dataTableInfo = $(this).closest('.data-info');
                dataTableInfo.find('.toolbar').html('<h5 class="zero-m">' + $(this).data('title') + '</h5>');
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


