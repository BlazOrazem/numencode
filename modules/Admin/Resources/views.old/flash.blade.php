@if (session()->has('flash_message'))
    <script>
        swal({
            title: "{{ session('flash_message.title') }}",
            text: "{{ session('flash_message.message') }}",
            type: "{{ session('flash_message.level') }}",
            timer: 2000,
            showConfirmButton: false
        });
    </script>
@endif

@if (session()->has('flash_message_overlay'))
    <script>
        swal({
            title: "{{ session('flash_message_overlay.title') }}",
            text: "{{ session('flash_message_overlay.message') }}",
            type: "{{ session('flash_message_overlay.level') }}",
            confirmButtonText: "{{ session('flash_message_overlay.button') }}"
        });
    </script>
@endif

<script>
    $('.btn-confirmation').click(function(e) {
        e.preventDefault();

        var form = $(this).closest('form');

        swal({
            title: "Are you sure?",
            text: "This action is irreversible!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes, delete it!",
            cancelButtonText: "Cancel",
            closeOnConfirm: false
        }, function() {
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
</script>