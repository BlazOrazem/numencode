$(function() {
    $('#side-menu').metisMenu();

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

    //$('#dataTables-example').DataTable({
    //    responsive: true
    //});

    $('#dataTables-example').DataTable( {
        responsive: {
            breakpoints: [
                { name: 'desktop',  width: Infinity },
                { name: 'tablet-l', width: 1024 },
                { name: 'tablet-p', width: 768 },
                { name: 'mobile-l', width: 480 },
                { name: 'mobile-p', width: 320 }
            ]
        }
    });
});

// Loads the correct sidebar on window load,
// collapses the sidebar on window resize.
// Sets the min-height of #page-wrapper to window size.
$(function() {
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

    var url = window.location;
    var element = $('ul.nav a').filter(function() {
        return this.href == url || url.href.indexOf(this.href) == 0;
    }).addClass('active').parent().parent().addClass('in').parent();
    if (element.is('li')) {
        element.addClass('active');
    }
});

//# sourceMappingURL=admin-app.js.map
