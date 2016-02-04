Vue.directive('ajax', {
    params: ['title', 'notification', 'completeTitle', 'completeText'],

    bind: function () {
        this.el.addEventListener(
            'submit', this.onSubmit.bind(this)
        );
    },

    onSubmit: function (e) {
        var requestType = this.getRequestType();

        var el = this;

        if (requestType == 'delete') {
            swal({
                title: el.params.title,
                text: el.params.notification,
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Yes",
                cancelButtonText: "Cancel",
                closeOnConfirm: false
            }, function() {
                el.vm
                    .$http[requestType](el.el.action)
                    .then(el.onComplete.bind(el))
                    .catch(el.onError.bind(el));
            });
        } else {
            el.vm
                .$http[requestType](el.el.action)
                .then(el.onComplete.bind(el))
                .catch(el.onError.bind(el));
        }

        e.preventDefault();
    },

    onComplete: function () {
        if (this.params.completeTitle) {
            swal({
                title: this.params.completeTitle,
                type: "success",
                text: this.params.completeText,
                timer: 1000,
                showConfirmButton: false
            });
        }
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

    getRequestType: function () {
        var method = this.el.querySelector('input[name="_method"]');

        return (method ? method.value : this.el.method).toLowerCase();
    }
});
