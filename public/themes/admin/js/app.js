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

http.postHtml = function (url, data) {
    return $.ajax({
        url: url,
        dataType: 'html',
        method: 'POST',
        beforeSend: function (xhr) {
            xhr.setRequestHeader('X-CSRF-TOKEN', http.token());
        },
        data: data
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

            //$(window).on('load', function(){
            //    setTimeout(function(){
            //        $('body').css("overflow-y","visible");
            //        $('#preloader').fadeOut(200);
            //    }, 600);
            //});
            $(window).on('load', function(){
                $('body').css("overflow-y","visible");
                $('#preloader').fadeOut(100);
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
            var item = $('.metismenu li a[href="'+ url +'"]');
            var itemBlock = item.parentsUntil(".metismenu").last();

            item.parent().addClass('active');

            itemBlock.addClass('active');
            itemBlock.find('ul.nav.collapse').addClass('in');

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
            var tree = $('.jstree');
            tree.bind('loaded.jstree', function(event, data) {
                data.instance.open_all();
            });
            tree.jstree({
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
            DataTables.initNonSortableTable();
            DataTables.handleSearchablePlaceholder();
        },

        initStandardTable: function () {
            $('.datatable:not(.search):not(.search-paginate):not(.non-sortable)').DataTable({
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

        initNonSortableTable: function () {
            $('.datatable.non-sortable').DataTable({
                dom: '<"clear-filter">rti',
                info: false,
                paging: false,
                ordering: false,
                responsive: true
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

var Collapse = (function () {
    return {
        init: function () {
            Collapse.buttons();
            Collapse.fix();
        },

        buttons: function () {
            $(".open-all-panels").on("click", function() {
                $(this).closest('.panel-group').find('.collapse').collapse('show');
            });

            $(".close-all-panels").on("click", function() {
                $(this).closest('.panel-group').find('.collapse').collapse('hide');
            });
        },

        fix: function () {
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

var Nestable = (function () {
    return {
        init: function () {
            $.fn.NestableList = function () {
                if (! this.length) return;
                if (typeof $.fn.nestable != 'undefined') {
                    this.nestable({
                        rootClass: 'nestable',
                        listNodeName: 'ul',
                        listClass: 'nestable-list',
                        itemClass: 'nestable-item',
                        dragClass: 'nestable-drag',
                        handleClass: 'nestable-handle-off',
                        collapsedClass: 'nestable-collapsed',
                        placeClass: 'nestable-placeholder',
                        emptyClass: 'nestable-empty'
                    });
                }
            };

            Nestable.bind();
        },

        bind: function () {
            $('.nestable').NestableList();
        }
    }
})();

var Editable = (function () {
    return {
        init: function () {
            $.fn.editable.defaults.mode = 'inline';

            $.fn.editable.defaults.params = function (params)
            {
                params._token = $('meta[name="_token"]').attr('content');
                return params;
            };

            Editable.bind();
        },

        bind: function () {
            $('.editable').editable({
                showbuttons: 'right',
                placement: 'top',
                onblur: 'ignore',
                type: 'wysihtml5',
                send:'always',
                wysihtml5: {
                    toolbar: {
                        "font-styles": true, // Font styling, e.g. h1, h2, etc. Default true
                        "emphasis": true,    // Italics, bold, etc. Default true
                        "lists": true,       // (Un)ordered lists, e.g. Bullets, Numbers. Default true
                        "link": true,        // Button to insert a link. Default true
                        "html": true,        // Button which allows you to edit the generated HTML. Default false
                        "image": false,      // Button to insert an image. Default true,
                        "color": false       // Button to change color of font
                    }
                },
                ajaxOptions: {
                    dataType: 'json',
                    type: 'patch'
                }
            });
        }
    }
})();

var Wysiwyg = (function () {
    return {
        init: function () {
            var editor_config = {
                path_absolute : "/admin/",
                selector: "textarea.wysiwyg-editor",
                plugins: [
                    "advlist autolink lists link image charmap print preview hr anchor pagebreak",
                    "searchreplace wordcount visualblocks visualchars code fullscreen",
                    "insertdatetime media nonbreaking save table contextmenu directionality",
                    "emoticons template paste textcolor colorpicker textpattern"
                ],
                toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media",
                relative_urls: false,
                file_browser_callback : function(field_name, url, type, win) {
                    var x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth;
                    var y = window.innerHeight|| document.documentElement.clientHeight|| document.getElementsByTagName('body')[0].clientHeight;

                    var cmsURL = editor_config.path_absolute + 'laravel-filemanager?field_name=' + field_name;
                    if (type == 'image') {
                        cmsURL = cmsURL + "&type=Images";
                    } else {
                        cmsURL = cmsURL + "&type=Files";
                    }

                    tinyMCE.activeEditor.windowManager.open({
                        file : cmsURL,
                        title : 'Filemanager',
                        width : x * 0.8,
                        height : y * 0.8,
                        resizable : "yes",
                        close_previous : "no"
                    });
                }
            };

            tinymce.init(editor_config);
        }
    }
})();

var Form = (function () {

    /**
     * Define form classes, currently set for Bootstrap 3 admin theme.
     */
    var formValidate = 'form-validate';
    var successColor = 'success-color';
    var inputSuccess = 'input-success';
    var formGroup = 'form-group';
    var helpBlock = 'help-block';
    var hasError = 'has-error';

    return {
        init: function () {
            $('form.' + formValidate + ' button.submit').on("click", function(event){
                event.preventDefault();

                var redirect = $(event.target.attributes['value']).val();
                var form = $(this).closest('form.' + formValidate);

                Form.validateForm(form, redirect);
            });

            $('.' + formValidate + ' input').bind('blur', function() {
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
            return form.find('[name="' + name + '"]').closest('.' + formGroup);
        },

        failFor: function (item, errorMsg) {
            item.addClass(hasError);
            item.find('label').removeClass(successColor);
            item.find('input').removeClass(inputSuccess);
            item.find('.' + helpBlock).html(errorMsg.join(' '));
        },

        successFor: function (item) {
            item.removeClass(hasError);
            item.find('label').addClass(successColor);
            item.find('input').addClass(inputSuccess);
            item.find('.' + helpBlock).html('');
        },

        validateForm: function (form, redirect) {
            http.post(form.attr('action'), Form.serialize(form))
                .success(function() {
                    var postForm = form[0];
                    if (typeof redirect !== 'undefined') {
                        $("<input type='hidden'/>").attr("name", 'redirect').val(redirect).appendTo(postForm);
                    }
                    postForm.submit();
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

                    if (item.hasClass(hasError)) {
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

    ContentBlock.init();

    FormComponents.init();

    Notifications.init();

    TimeDisplay.init();

    Tooltips.init();

    Popover.init();

    Collapse.init();

    SidePanel.init();

    MenuToggle.init();

    Nestable.init();

    Editable.init();

    Wysiwyg.init();

});
//# sourceMappingURL=app.js.map
