@if (Route::is('backend.events.index'))
    <script>
        $(document).ready(function() {
            $(document).on('click', '.deleteEventBtn', function(e) {
                e.preventDefault();
                let event_id = $(this).data('id');
                let path = '{{ route('backend.events.delete', ':event') }}';
                path = path.replace(":event", event_id);
                let token = '{{ csrf_token() }}';
                Swal.fire({
                    title: '{{ trans('notifications.delete_alert') }}',
                    text: '{{ trans('notifications.delete_message') }}',
                    showDenyButton: false,
                    showCancelButton: true,
                    confirmButtonText: 'Delete',
                }).then((result) => {
                    /* Read more about isConfirmed, isDenied below */
                    if (result.isConfirmed) {
                        $.ajax({
                            type: "DELETE",
                            url: path,
                            data: {
                                _token: token
                            },
                            dataType: "json",
                            success: function(data) {
                                if (data['status']) {
                                    toastr.success(data['message']);
                                    setTimeout(() => {
                                        location.reload();
                                    }, 500);
                                }
                            }
                        });
                    } else if (result.isDenied) {
                        Swal.fire('Changes are not saved', '', 'info')
                    }
                });

            });
        });
    </script>
@endif