@if (Route::is('backend.events.create'))
    <script>
        $(document).ready(function() {

            $('#newEventForm').submit(function(e) {
                e.preventDefault();
                let form = $(this);
                let formData = new FormData(form[0]);
                let path = '{{ route('backend.events.store') }}';
                $.ajax({
                    type: "POST",
                    url: path,
                    data: formData,
                    dataType: "json",
                    contentType: false,
                    processData: false,
                    beforeSend: function() {
                        form.find('button[type=submit]').html(
                            '<i class="fa fa-spinner fa-spin"></i>'
                        );
                        form.find('button[type=submit]').attr('disabled', true);
                    },
                    complete: function() {
                        form.find('button[type=submit]').html(
                            'Create'
                        );
                        form.find('button[type=submit]').attr('disabled', false);
                    },
                    success: function(data) {
                        if (data['status']) {
                            toastr.success(data['message']);
                            setTimeout(() => {
                                window.location.href =
                                    '{{ route('backend.events.index') }}'
                            }, 1000);
                        } else {
                            toastr.error(data['message']);
                            setTimeout(() => {
                                location.reload();
                            }, 1000);
                        }
                    },
                    error: function(data) {
                        var errors = data.responseJSON;
                        var errorsHtml = '<ul>';
                        $.each(errors['errors'], function(key, value) {
                            errorsHtml += '<li>' + value + '</li>';
                        });
                        errorsHtml += '</ul>';
                        toastr.error(errorsHtml);
                    }
                });
            });

        });
    </script>
@endif

@isset($data)
    @if (Route::is('backend.events.edit', $data->id))
        <script>
            $(document).ready(function() {
                $('#updateEventForm').submit(function(e) {
                    e.preventDefault();
                    let form = $(this);
                    let formData = new FormData(form[0]);
                    let path = '{{ route('backend.events.update', $data->id) }}';
                    $.ajax({
                        type: "POST",
                        url: path,
                        data: formData,
                        dataType: "json",
                        contentType: false,
                        processData: false,
                        beforeSend: function() {
                            form.find('button[type=submit]').html(
                                '<i class="fa fa-spinner fa-spin"></i>'
                            );
                            form.find('button[type=submit]').attr('disabled', true);
                        },
                        complete: function() {
                            form.find('button[type=submit]').html(
                                'Update'
                            );
                            form.find('button[type=submit]').attr('disabled', false);
                        },
                        success: function(data) {
                            if (data['status']) {
                                toastr.success(data['message']);
                                setTimeout(() => {
                                    window.location.href =
                                        '{{ route('backend.events.index') }}'
                                }, 1000);
                            } else {
                                toastr.error(data['message']);
                                setTimeout(() => {
                                    location.reload();
                                }, 1000);
                            }
                        },
                        error: function(data) {
                            var errors = data.responseJSON;
                            var errorsHtml = '<ul>';
                            $.each(errors['errors'], function(key, value) {
                                errorsHtml += '<li>' + value + '</li>';
                            });
                            errorsHtml += '</ul>';
                            toastr.error(errorsHtml);
                        }
                    });
                });
            });
        </script>
    @endif
@endisset

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
