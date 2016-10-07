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

var JsTree = (function () {
    return {
        init: function () {
            $('#jstree').jstree({
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
                "dom": '<"toolbar"><"clear-filter">rti',
                info: false,
                paging: true,
                responsive: true
            });

            $('.datatable.search:not(.paginate)').DataTable({
                "dom": '<"toolbar"><"clear-filter">frti',
                info: false,
                paging: true,
                responsive: true,
                "oLanguage": { "sSearch": "" }
            });

            $('.datatable.search.paginate').DataTable({
                "dom": '<"toolbar"><"top"fl>rt<"bottom"ip><"clear">',
                info: true,
                paging: true,
                responsive: true,
                "oLanguage": { "sSearch": "" }
            });

            $('.datatable').each(function() {
                var dataTableInfo = $(this).closest('.data-info');
                dataTableInfo.find('.toolbar').html('<h5 class="zero-m">' + $(this).data('title') + '</h5>');
                dataTableInfo.find('.dataTables_filter input').attr("placeholder", $(this).data('search'));
            });
        }
    };
})();

