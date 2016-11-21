var PreLoader = (function () {
    return {
        init: function () {
            $('#preloader').height($(window).height() + "px");

            $(window).on('load', function(){
                setTimeout(function(){
                    $('body').css("overflow-y","visible");
                    $('#preloader').fadeOut(200);
                }, 600);
            });
        }
    }
})();

var MetisMenu = (function () {
    return {
        init: function () {
            $('.metismenu').metisMenu({
                activeClass: 'active'
            });

            MetisMenu.handleActive();
        },

        handleActive: function () {
            var url = $('#activeUrl').val();

            $('.metismenu li a[href="'+ url +'"]').parent().addClass('active');
            $('.metismenu li a[href="'+ url +'"]').parentsUntil(".metismenu").last().addClass('active');

            var locationHref = $(location).attr('pathname').replace("/", "");
            var currentPage = $('a[href="' + locationHref + '"]');
            $(".sidebar").find(currentPage).addClass("current-page");
            currentPage.closest("ul").parent().addClass("current-block");
        }
    }
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
    }
})();

var DataTables = (function () {
    return {
        init: function () {
            DataTables.initStandardTable();
            DataTables.initSearchableTable();
            DataTables.initPaginatableTable();
            DataTables.handleSearchablePlaceholder();
        },

        initStandardTable: function () {
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
        },

        initSearchableTable: function () {
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
        },

        initPaginatableTable: function () {
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
        },

        handleSearchablePlaceholder: function () {
            $('.datatable.search').each(function() {
                var dataTableInfo = $(this).closest('.data-table');
                dataTableInfo.find('.dataTables_filter input').attr("placeholder", $(this).data('search'));
            });
        }
    }
})();

var Responsive = (function () {
    return {
        init: function () {
            Responsive.handleFullContentHeight();

            Responsive.handleResponsiveElements();

            $(window).resize(function() {
                Responsive.handleResponsiveElements(true);
            });

            if ($(window).width() <= 1024) {
                Responsive.changeTitlePosition();
            }

            $(window).resize(function(){
                if ($(window).width() <= 1024) {
                    Responsive.changeTitlePosition();
                } else {
                    var title = $(".page-title").remove();
                    $(".navbar-container > .pull-left").html(title);
                }
            });
        },

        handleFullContentHeight: function() {
            $('.container-fluid').css("min-height", $(window).height() - 150 + "px");

            if ($(window).resize()) {
                $('.container-fluid').css("min-height", $(window).height() - 150 + "px");
            }
        },

        handleResponsiveElements: function (onResize) {
            if ($(window).width() >= 1440) {
                $(".side-panel").addClass("open");
                $(".sidepanel-toggle").parent().addClass("open");
                if (onResize) {
                    $("body").addClass("fixed-sidebar-example small-content");
                } else {
                    $("body").addClass("small-content");
                }
            } else {
                $(".side-panel").removeClass("open");
                $(".sidepanel-toggle").parent().removeClass("open");
                $("body").removeClass("fixed-sidebar-example small-content");
            }
        },

        changeTitlePosition: function () {
            var title = $(".page-title").remove();

            if ($(".breadcrumb")[0]) {
                $(".breadcrumb").eq(0).after(title);
            } else {
                $(".container-fluid > .row").eq(0).before(title);
            }
        }
    }
})();

var ScrollBar = (function () {
    return {
        init: function () {
            ScrollBar.handleBodyScroll();
            ScrollBar.handleSidebarScroll();
            ScrollBar.handleContentScroll();
        },

        handleBodyScroll: function() {
            if ($(window).width() > 1024 && $("body").has(".navbar").length) {
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
        },

        handleSidebarScroll: function() {
            if ($(window).width() > 768) {
                $(".sidebar").mCustomScrollbar({
                    theme: "minimal",
                    scrollInertia: 0,
                    mouseWheel:{
                        preventDefault: true
                    }
                });
            } else {
                $(".sidebar").css("overflow-y", "auto");
            }
        },

        handleContentScroll: function() {
            if ($(".content-scroll")[0]) {
                $(".content-scroll").mCustomScrollbar({
                    theme: "minimal-dark",
                    scrollInertia: 50
                });
            }
        }
    }
})();

var WavesEffect = (function () {
    return {
        init: function () {
            Waves.attach('.btn');
            Waves.init();
        }
    }
})();

var MenuSearchBar = (function () {
    var submitIcon = $('.searchbox-icon');

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
    }
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
    }
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
    }
})();

var ContentBlock = (function () {
    return {
        init: function () {
            //Click to remove content-block
            $(".close-btn").on("click", function(e){
                e.preventDefault();
                var removedBlock = $(this).closest(".content-box").fadeOut(200, function(){
                    $(this).remove();
                });
            });

            //Click to collapse block
            var collapsedBlock = false;
            $(".collapse-btn").on("click", function(e){
                e.preventDefault();
                if (!collapsedBlock){
                    $(this).closest(".content-box").find(".content").slideUp(200);
                    $(this).find("i").toggleClass("zmdi-minus zmdi-plus");
                    collapsedBlock = true;
                }
                else {
                    $(this).closest(".content-box").find(".content").slideDown(200);
                    $(this).find("i").toggleClass("zmdi-plus zmdi-minus");
                    collapsedBlock = false;
                }
            });

            //Click to refresh content-block
            $(".refresh-btn").on("click", function(e){
                var refreshBox = $(this).closest('div.content-box');
                $("<div class='refresh-preloader'><div class='preloader'><i>.</i><i>.</i><i>.</i></div></div>").appendTo(refreshBox).fadeIn(200);

                setTimeout(function(){
                    var refreshPreloader = refreshBox.find('.refresh-preloader'),
                        deletedRefreshBox = refreshPreloader.fadeOut(200, function(){
                            refreshPreloader.remove();
                        });
                },2500);

                e.preventDefault();
            });
        }
    }
})();

var FormComponents = (function () {
    return {
        init: function () {
            //selectpickers
            if($(".selectpicker")[0]){
                $('.selectpicker').selectpicker({
                    iconBase: "zmdi",
                    tickIcon: "zmdi-check"
                });
            }

            //Input fields
            if($('.fg-input')[0]) {
                $('body').on('focus', '.form-control', function(){
                    $(this).closest('.fg-input').addClass('fg-active');
                });

                $('body').on('blur', '.form-control', function(){
                    var p = $(this).closest('.form-group');
                    var i = p.find('.form-control').val();

                    if (p.hasClass('fg-float')) {
                        if (i.length === 0) {
                            $(this).closest('.fg-input').removeClass('fg-active');
                        }
                    } else {
                        $(this).closest('.fg-line').removeClass('fg-active');
                    }
                });
            }

            if($('.fg-float')[0]) {
                $('.fg-float .form-control').each(function(){
                    var i = $(this).val();

                    if (i.length !== 0) {
                        $(this).closest('.fg-input').addClass('fg-active');
                    }

                });
            }
            //Quantity buttons
            // This button will increment the value
            $('.qtyplus').on("click", function(e){
                // Stop acting like a button
                e.preventDefault();
                // Get the field name
                fieldName = $(this).attr('data-field');
                // Get its current value
                var currentVal = parseInt($('input[name='+fieldName+']').val());
                // If is not undefined
                if (!isNaN(currentVal)) {
                    // Increment
                    $('input[name='+fieldName+']').val(currentVal + 1);
                } else {
                    // Otherwise put a 0 there
                    $('input[name='+fieldName+']').val(0);
                }
            });

            // This button will decrement the value till 0
            $(".qtyminus").on("click", function(e) {
                // Stop acting like a button
                e.preventDefault();
                // Get the field nameg
                fieldName = $(this).attr('data-field');
                // Get its current value
                var currentVal = parseInt($('input[name='+fieldName+']').val());
                // If it isn't undefined or its greater than 0
                if (!isNaN(currentVal) && currentVal > 0) {
                    // Decrement one
                    $('input[name='+fieldName+']').val(currentVal - 1);
                } else {
                    // Otherwise put a 0 there
                    $('input[name='+fieldName+']').val(0);
                }
            });
        }
    }
})();

var Notifications = (function () {
    return {
        init: function () {
            $(".notification-container").mCustomScrollbar({
                theme: "minimal-dark",
                scrollInertia: 0,
                mouseWheel:{
                    preventDefault: true
                }
            });

            $('.notification>a').on('click', function (event) {
                $(this).parent().toggleClass('open');
            });

            $('body').on('click', function (e) {
                if (!$('.notification').is(e.target)
                    && $('.notification').has(e.target).length === 0
                    && $('.open').has(e.target).length === 0
                ) {
                    $('.notification').removeClass('open');
                }
            });

            $(".notification .clear-all").on("click", function(e){
                e.preventDefault();
                $(".notification-container").mCustomScrollbar("disable");
                $(".notification-container a").each(function(i){
                    setTimeout(function(){
                        $(".notification-container a").eq(i).addClass("animated fadeOutRight");
                    }, i * 50);
                });
                setTimeout(function(){
                    $(".check-ok").fadeIn(200);
                }, 800);
            });
        }
    }
})();

var TimeDisplay = (function () {
    var datetime = null,
        time = null,
        date = null;

    return {
        init: function () {
            if ($('.current-date')[0] && $('.time')[0]) {
                TimeDisplay.datetime = $('.current-date');
                TimeDisplay.time = $('.time');

                TimeDisplay.update();
                setInterval(TimeDisplay.update, 1000);
            }
        },

        update: function() {
            TimeDisplay.date = moment(new Date());
            TimeDisplay.datetime.html(TimeDisplay.date.format('DD MMMM YYYY <br> dddd'));
            TimeDisplay.time.html(TimeDisplay.date.format('H:mm:ss'));
        }
    }
})();

var Tooltips = (function () {
    return {
        init: function () {
            if ($('[data-toggle="tooltip"]')[0]) {
                $('[data-toggle="tooltip"]').tooltip({
                    container: "body"
                });
            }
        }
    }
})();

var Popover = (function () {
    return {
        init: function () {
            if ($('[data-toggle="popover"]')[0]) {
                $('[data-toggle="popover"]').popover();
            }
        }
    }
})();

var CollapseFix = (function () {
    return {
        init: function () {
            if ($('.collapse')[0]) {

                //Add active class for opened items
                $('.collapse').on('show.bs.collapse', function (e) {
                    $(this).closest('.panel').find('.panel-heading').addClass('active');
                });

                $('.collapse').on('hide.bs.collapse', function (e) {
                    $(this).closest('.panel').find('.panel-heading').removeClass('active');
                });

                //Add active class for pre opened items
                $('.collapse.in').each(function(){
                    $(this).closest('.panel').find('.panel-heading').addClass('active');
                });
            }
        }
    }
})();

var SidePanel = (function () {
    return {
        init: function () {
            $(".side-panel .tab-pane").mCustomScrollbar({
                theme: "minimal",
                scrollInertia: 0,
                mouseWheel:{
                    preventDefault: true
                }
            });

            $(".sidepanel-toggle").on("click", function(e){
                e.preventDefault();
                $(this).parent().toggleClass("open");
                $(".side-panel").toggleClass("open");
            });

            $('body').on('click', '.menu-toggle', function(e){
                e.preventDefault();

                var $elem = '.sidebar';
                var $elem2 = '.menu-toggle';

                $(".side-panel").removeClass('open');
                $('.sidepanel-toggle').parent().removeClass("open");
                //When clicking outside
                if ($('body').hasClass('open-menu')) {
                    $(document).on('click', function (e) {
                        if (($(e.target).closest($elem).length === 0) && ($(e.target).closest($elem2).length === 0)) {
                            setTimeout(function(){
                                if(!$("body").hasClass("fixed-sidebar")){
                                    $('body').removeClass('open-menu');
                                    $(".logo").hide();
                                }
                                $($elem2).removeClass("toggled");
                                $(".menu-toggle i").removeClass("zmdi-arrow-left").addClass("zmdi-menu");

                                $(".menu-overlay").fadeOut(300, function(){
                                    $(".menu-overlay").remove();
                                });
                            });
                        }
                    });
                }
            });

            $('body').on('click', '.sidepanel-toggle', function(e){
                e.preventDefault();

                var $elem = '.side-panel';
                var $elem2 = '.sidepanel-toggle';

                $(".more-options, .notification").removeClass('open');

                //When clicking outside
                if ($('.side-panel').hasClass('open')) {
                    $(document).on('click', function (e) {
                        if (($(e.target).closest($elem).length === 0) && ($(e.target).closest($elem2).length === 0)) {
                            setTimeout(function(){
                                $(".side-panel").removeClass('open');
                                $($elem2).parent().removeClass("open");
                            });
                        }
                    });
                }
            });

            $(".more-options a, .notification a").on("click", function(){
                $(".side-panel").removeClass('open');
                $('.sidepanel-toggle').parent().removeClass("open");
            });
        }
    }
})();

var MenuToggle = (function () {
    return {
        init: function () {
            $(".menu-toggle").on("click", function(){
                $("body").toggleClass("open-menu");
                $(this).toggleClass("toggled");
                $(".menu-toggle i").toggleClass("zmdi-menu zmdi-arrow-left");
                if($(window).width() < 768){
                    $("body").append("<div class='menu-overlay'></div>");
                    $(".menu-overlay").fadeIn(300);
                }
                if($("body").hasClass("open-menu")){
                    if($(window).width() >= 1024){
                        setTimeout(function(){
                            $(".logo").show();
                        },300);
                    }
                }
                else{
                    $(".logo").hide();
                    $(".menu-overlay").fadeOut(100, function(){
                        $(".menu-overlay").remove();
                    });
                }
            });

            $(window).on("resize", function(){
                if ($("body").hasClass("open-menu")) {
                    if($(window).width() >= 1024){
                        setTimeout(function(){
                            $(".logo").show();
                        },300);
                    }

                    if($(window).width() < 1024){
                        $(".logo").hide();
                    }
                }
            });
        }
    }
})();