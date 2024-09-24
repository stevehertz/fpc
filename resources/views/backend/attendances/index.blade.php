@extends('backend.layouts.app')

@section('content')
    @include('backend.includes.bread-crumbs')

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 col-sm-4">
                    <div class="info-box bg-light">
                        <div class="info-box-content">
                            <span class="info-box-text text-center text-muted">
                                Total Registered
                            </span>
                            <span class="info-box-number text-center text-muted mb-0">
                                {{ count($data) }}
                            </span>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-4">
                    <div class="info-box bg-light">
                        <div class="info-box-content">
                            <span class="info-box-text text-center text-muted">
                                Delegates Registered
                            </span>
                            <span class="info-box-number text-center text-muted mb-0">
                                {{ count($delegates) }}
                            </span>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-4">
                    <div class="info-box bg-light">
                        <div class="info-box-content">
                            <span class="info-box-text text-center text-muted">
                                Exhibitors Registered
                            </span>
                            <span class="info-box-number text-center text-muted mb-0">
                                {{ count($exhibitors) }}
                            </span>
                        </div>
                    </div>
                </div>

            </div>
            <div class="row">
                <div class="col-12 col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('backend.attendance.index') }}" method="GET">
                                @csrf
                                <div class="row">
                                    <div class="col-md-4 col-12">
                                        <div class="form-group">
                                            <label>Events</label>
                                            <select required name="event_id" class="form-control select2"
                                                style="width: 100%;">
                                                <option selected="selected" disabled="disabled">
                                                    Select Events
                                                </option>
                                                @forelse ($events as $event)
                                                    <option value="{{ $event->id }}"
                                                        @isset($filter_data)
                                                            @if (!empty($filter_data['event_id']) && $filter_data['event_id'] == $event->id)
                                                                selected = "selected"
                                                            @endif
                                                        @endisset>
                                                        {{ $event->name }}
                                                    </option>
                                                @empty
                                                @endforelse
                                            </select>
                                        </div>
                                        <!-- /.form-group -->
                                    </div>
                                    <div class="col-md-4 col-12">
                                        <div class="form-group">
                                            <label>Registered User Type</label>
                                            <select name="user_type" class="form-control select2" style="width: 100%;">
                                                <option selected="selected" disabled="disabled">
                                                    Select Registered User Type
                                                </option>
                                                @foreach (\ExhibitionRegisterAs::toArray() as $key => $value)
                                                    <option value="{{ $key }}"
                                                        @isset($filter_data)
                                                            @if (!empty($filter_data['user_type']) && $filter_data['user_type'] == $key)
                                                                selected = "selected"
                                                            @endif
                                                        @endisset>
                                                        {{ $value }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <!-- /.form-group -->
                                    </div>
                                    <div class="col-md-2 col-12">
                                        <div class="form-group">
                                            <label>&nbsp;</label>
                                            <button type="submit" class="btn btn-block btn-outline-primary">
                                                <i class="fas fa-search"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="col-md-2 col-12">
                                        <div class="form-group">
                                            <label>&nbsp;</label>
                                            <a href="{{ route('backend.attendance.index') }}"
                                                class="btn btn-block btn-outline-primary">
                                                <i class="fas fa-sync"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Attendances</h3>
                        </div>
                        <div class="card-body table-responsive">
                            <table id="data" class="table table-bordered table-striped table-sm">
                                <thead>
                                    <tr>
                                        <th style="width: 10px">SN</th>
                                        <th>Full Names</th>
                                        <th>Event Name</th>
                                        <th>Phone Number</th>
                                        <th>Email Address</th>
                                        <th>Organization</th>
                                        <th>Position</th>
                                        <th>Registered As</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $attendance)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>
                                                {{ $attendance->first_name }} {{ $attendance->last_name }}
                                            </td>
                                            <td>
                                                <a href="{{ route('backend.events.view', $attendance->event->id) }}">
                                                    {{ $attendance->event->name }}
                                                </a>
                                            </td>
                                            <td>{{ $attendance->phone }}</td>
                                            <td>{{ $attendance->email }}</td>
                                            <td>{{ $attendance->organization }}</td>
                                            <td>
                                                @if ($attendance->user_type == \ExhibitionRegisterAs::DELEGATE)
                                                    {{ \DelegatesPosition::getName($attendance->position) }}
                                                @else
                                                    {{ $attendance->position }}
                                                @endif
                                            </td>
                                            <td>
                                                {{ \ExhibitionRegisterAs::getName($attendance->user_type) }}
                                            </td>
                                            <td>
                                                @if ($attendance->confirmation_status == \EventAttendanceConfirmationStatus::CONFIRMED)
                                                    <span class="badge badge-success">
                                                        {{ \EventAttendanceConfirmationStatus::getName(\EventAttendanceConfirmationStatus::CONFIRMED) }}
                                                    </span>
                                                @else
                                                    @if ($attendance->user_type == \ExhibitionRegisterAs::DELEGATE)
                                                        <a href="javascript:void(0)" data-id="{{ $attendance->id }}"
                                                            class="btn btn-sm btn-success confirmAttendanceBtn">
                                                            CONFIRM
                                                        </a>
                                                    @else
                                                        <a href="javascript:void(0)" data-id="{{ $attendance->id }}"
                                                            class="btn btn-sm btn-success confirmExhibitorsAttendanceBtn">
                                                            CONFIRM
                                                        </a>
                                                    @endif
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
            </div>
            <!--/.row -->
        </div>
    </section>
    <!--/.content -->
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {

            $(document).on('click', '.confirmAttendanceBtn', function(e) {
                e.preventDefault();
                let attendance_id = $(this).data('id');
                let path = '{{ route('backend.attendance.confirm', ':attendance_id') }}';
                path = path.replace(":attendance_id", attendance_id);
                let token = '{{ csrf_token() }}';
                Swal.fire({
                    title: '{{ trans('notifications.delete_alert') }}',
                    text: '{{ trans('notifications.confirm_attendance') }}',
                    icon: 'warning',
                    showDenyButton: false,
                    showCancelButton: true,
                    confirmButtonText: 'Confirm',
                    cancelButtonText: 'No'
                }).then((result) => {
                    /* Read more about isConfirmed, isDenied below */
                    if (result.isConfirmed) {
                        $.ajax({
                            type: "GET",
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
                                    }, 1000);
                                }
                            }
                        });
                    } else if (result.dismiss === Swal.DismissReason.cancel) {
                        Swal.fire({
                            title: 'Reason for Cancellation',
                            input: 'textarea',
                            inputPlaceholder: 'Enter your reason for cancelling here...',
                            showCancelButton: true,
                            confirmButtonText: 'Submit',
                            cancelButtonText: 'Close',
                            preConfirm: (reasons) => {
                                if (!reasons) {
                                    toastr.error(
                                        'Please enter a reason for cancelling');
                                }
                                return {
                                    reasons
                                };
                            }
                        }).then((reasonResult) => {
                            if (reasonResult.isConfirmed && reasonResult.value) {

                                const data = {
                                    reasons: reasonResult.value.reasons,
                                    _token: '{{ csrf_token() }}' // Include CSRF token for security
                                };

                                let path =
                                    '{{ route('backend.attendance.cancel.attendance', ':attendance') }}';
                                path = path.replace(':attendance', attendance_id);
                                $.ajax({
                                    type: "POST",
                                    url: path,
                                    data: data,
                                    dataType: "json",
                                    success: function(data) {
                                        if (data['status']) {
                                            toastr.success(data['message']);
                                            setTimeout(() => {
                                                location.reload();
                                            }, 1000);
                                        }
                                    }
                                });
                            }
                        });
                    }
                });
            });

            $(document).on('click', '.confirmExhibitorsAttendanceBtn', function(e) {
                e.preventDefault();
                let attendance_id = $(this).data('id');
                // When the confirm button is clicked
                Swal.fire({
                    title: 'Are you sure?',
                    text: "Do you want to proceed with this action?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Confirm',
                    cancelButtonText: 'No'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // If user clicks "Yes", show another alert with a form for payment details
                        Swal.fire({
                            title: 'Payment Details',
                            html: `
                            <form id="attendanceConfirmationForm">
                                <label for="amount">Paid Amount:</label>
                                <input type="number" id="amount" name="paid" class="swal2-input" placeholder="Enter Paid amount">
                                <label for="phone">Transaction Code:</label>
                                <input type="text" id="phone" name="phone" class="swal2-input" placeholder="Enter phone number used to pay">
                            </form>`,
                            confirmButtonText: 'Submit',
                            preConfirm: () => {
                                // Collect data from the form
                                const amount = Swal.getPopup().querySelector('#amount')
                                    .value;
                                const phone = Swal.getPopup().querySelector(
                                    '#phone').value;
                                if (!amount || !phone) {
                                    Swal.showValidationMessage(
                                        'Please enter both amount and transaction code'
                                    );
                                }
                                return {
                                    amount,
                                    phone
                                };
                            }
                        }).then((formResult) => {
                            if (formResult.isConfirmed) {
                                // Process payment details form submission

                                const data = {
                                    paid: formResult.value.amount,
                                    phone: formResult.value.phone,
                                    _token: '{{ csrf_token() }}' // Include CSRF token for security
                                };

                                let path =
                                    '{{ route('backend.attendance.confirm.exhibitor.attendance', ':attendance') }}';
                                path = path.replace(':attendance', attendance_id);
                                $.ajax({
                                    type: "POST",
                                    url: path,
                                    data: data,
                                    dataType: "json",
                                    success: function(data) {
                                        if (data['status']) {
                                            toastr.success(data['message']);
                                            setTimeout(() => {
                                                location.reload();
                                            }, 1000);
                                        }else{
                                            toastr.error(data['message']);
                                        }
                                    },
                                    error: function(data) {
                                        var errors = data.responseJSON;
                                        var errorsHtml = '<ul>';
                                        $.each(errors['errors'], function(key,
                                            value) {
                                            errorsHtml += '<li>' +
                                                value + '</li>';
                                        });
                                        errorsHtml += '</ul>';
                                        toastr.error(errorsHtml);
                                    }
                                });


                            }
                        });
                    } else if (result.dismiss === Swal.DismissReason.cancel) {
                        // If user clicks "No", show an alert with a text area for stating reasons
                        Swal.fire({
                            title: 'Reason for Cancellation',
                            input: 'textarea',
                            inputPlaceholder: 'Enter your reason for cancelling here...',
                            showCancelButton: true,
                            confirmButtonText: 'Submit',
                            cancelButtonText: 'Close',
                            preConfirm: (reasons) => {
                                if (!reasons) {
                                    toastr.error(
                                        'Please enter a reason for cancelling');
                                }
                                return {
                                    reasons
                                };
                            }
                        }).then((reasonResult) => {
                            if (reasonResult.isConfirmed && reasonResult.value) {

                                const data = {
                                    reasons: reasonResult.value.reasons,
                                    _token: '{{ csrf_token() }}' // Include CSRF token for security
                                };

                                let path =
                                    '{{ route('backend.attendance.cancel.attendance', ':attendance') }}';
                                path = path.replace(':attendance', attendance_id);
                                $.ajax({
                                    type: "POST",
                                    url: path,
                                    data: data,
                                    dataType: "json",
                                    success: function(data) {
                                        if (data['status']) {
                                            toastr.success(data['message']);
                                            setTimeout(() => {
                                                location.reload();
                                            }, 1000);
                                        }
                                    }
                                });
                            }
                        });
                    }
                });


            });

        });
    </script>
@endpush
