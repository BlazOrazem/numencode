$(function() {
    $('#side-menu').metisMenu();

    var url = window.location;
    $('.sidebar-nav a[href="'+ url +'"]').addClass('active');

    $("#jstree").jstree({
        "types" : {
            "default" : {
                "icon" : "jt jt-page"
            },
            "folder" : {
                "icon" : "jt jt-folder"
            },
            "new" : {
                "icon" : "jt jt-new"
            }
        },
        "plugins" : [ "types" ]
    });

    $('table.data-table').DataTable({
        dom: '<"top"if>rt<"bottom"lp><"clear">',
        responsive: true,
        order: [],
        columnDefs: [{
            targets  : 'no-sort',
            orderable: false
        }]
    });

    // Loads the correct sidebar on window load,
    // collapses the sidebar on window resize.
    // Sets the min-height of #page-wrapper to window size.
    $(window).bind("load resize", function() {
        topOffset = 50;
        width = (this.window.innerWidth > 0) ? this.window.innerWidth : this.screen.width;
        if (width < 768) {
            $('div.navbar-collapse').addClass('collapse');
            topOffset = 100; // 2-row-menu
        } else {
            $('div.navbar-collapse').removeClass('collapse');
        }

        height = ((this.window.innerHeight > 0) ? this.window.innerHeight : this.screen.height) - 1;
        height = height - topOffset;
        if (height < 1) height = 1;
        if (height > topOffset) {
            $("#page-wrapper").css("min-height", (height) + "px");
        }
    });
});

//# sourceMappingURL=admin-app.js.map
