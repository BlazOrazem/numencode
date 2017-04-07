@if(session()->has('flash_message'))
    <script>
        toastr.options = {
            "closeButton": true,
            "debug": false,
            "newestOnTop": true,
            "progressBar": true,
            "positionClass": "toast-bottom-right",
            "preventDuplicates": true,
            "onclick": null,
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": "{{ session('flash_message.timeout') ?: 5000 }}",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        };

        toastr["{{ session('flash_message.level') }}"]("{{ session('flash_message.message') }}", "{{ session('flash_message.title') }}");
    </script>
@endif

@if(session()->has('flash_message_overlay'))
    <script>
        toastr.options = {
            "closeButton": true,
            "debug": false,
            "newestOnTop": true,
            "progressBar": false,
            "positionClass": "toast-bottom-right",
            "preventDuplicates": true,
            "onclick": null,
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": 0,
            "extendedTimeOut": 0,
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut",
            "tapToDismiss": false
        };

        toastr["{{ session('flash_message.level') }}"]("{{ session('flash_message.message') }}", "{{ session('flash_message.title') }}");
    </script>
@endif

<script>
    $('.btn-logout').on("click", function (e) {
        e.preventDefault();

        var target = $(this);

        swal({
            title: "@lang('admin::flash.logout.title')",
            text: "@lang('admin::flash.logout.notice')",
            type: "info",
            showCancelButton: true,
            confirmButtonClass: 'btn-info',
            confirmButtonText: "@lang('admin::flash.logout.confirm_button')",
            cancelButtonText: "@lang('admin::flash.logout.cancel_button')",
            closeOnConfirm: false
        }, function () {
            window.location.href = $(target).attr('href');
        });
    });

    $('.btn-confirmation').on("click", function (e) {
        e.preventDefault();

        var form = $(this).closest('form');

        swal({
            title: "@lang('admin::flash.delete.title')",
            text: "@lang('admin::flash.delete.notice')",
            type: "warning",
            showCancelButton: true,
            confirmButtonClass: 'btn-danger',
            confirmButtonText: "@lang('admin::flash.delete.confirm_button')",
            cancelButtonText: "@lang('admin::flash.delete.cancel_button')",
            closeOnConfirm: false
        }, function () {
            swal({
                title: "Deleted",
                type: "success",
                timer: 1000,
                showConfirmButton: false
            });
            setTimeout(function () {
                form[0].submit();
            }, 800);
        });
    });

    $(".ajax-confirmation").on("click", function (e) {
        e.preventDefault();

        var form = $(this).closest('form');
        var inputData = form.serialize();
        var route = form.attr('action');
        var htmlElement = form.closest(form.data('element'));

        swal({
            title: "@lang('admin::flash.delete.title')",
            text: "@lang('admin::flash.delete.notice')",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#FFBB33",
            confirmButtonText: "@lang('admin::flash.delete.confirm_button')",
            cancelButtonText: "@lang('admin::flash.delete.cancel_button')",
            closeOnConfirm: false,
            closeOnCancel: true
        },
        function (isConfirm) {
            if (isConfirm) {
                $.ajax({
                    url: route,
                    type: 'POST',
                    data: inputData,
                    success: function(data) {
                        var messageType = data.type ? data.type : "success";
                        if (messageType != 'error') {
                            htmlElement.remove();
                        }
                        swal(data.title, data.msg, messageType);
                    }
                });
            }
        });
    });
</script>