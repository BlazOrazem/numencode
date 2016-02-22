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

Vue.http.headers.common['X-CSRF-TOKEN'] = $('meta[name="_token"]').attr('content');

Vue.component('datatable', {
    props: ['title', 'admin-id'],

    template: vars.template,

    data: function() {
        return {
            list: []
        };
    },

    created: function() {
        this.list = vars.data;
    },

    ready: function() {
        console.log(this.listArray);

        $('table.data-table').DataTable({
            dom: '<"top"if>rt<"bottom"lp><"clear">',
            responsive: true,
            order: [],
            columnDefs: [{
                targets  : 'no-sort',
                orderable: false
            }]
        });
    },

    methods: {
        submit: function(event, item) {
            var el = event.target;
            var requestType = this.getRequestType(el);

            swal({
                title: $(el).attr('title'),
                text: $(el).attr('notification'),
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Yes",
                cancelButtonText: "Cancel",
                closeOnConfirm: false
            }, function() {
                this
                    .$http[requestType]($(el).attr('action'))
                    .then(this.onComplete.bind(this, el, item))
                    .catch(this.onError);
            }.bind(this));
        },

        onComplete: function (el, item) {

            if ($(el).attr('completeTitle')) {
                swal({
                    title: $(el).attr('completeTitle'),
                    type: "success",
                    text: $(el).attr('completeText'),
                    timer: 1000,
                    showConfirmButton: false
                });
            }

            this.list.$remove(item);
        },

        onError: function (response) {
            if (response) {
                swal({
                    title: "Error",
                    type: "error",
                    text: response.data.message,
                    showConfirmButton: true
                });
            }
        },

        getRequestType: function (el) {
            var method = el.querySelector('input[name="_method"]');

            return (method ? method.value : el.method).toLowerCase();
        }
    }
});

new Vue({
    el: 'body'
});

//# sourceMappingURL=admin-app.js.map
