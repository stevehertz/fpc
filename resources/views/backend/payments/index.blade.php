@extends('backend.layouts.app')

@section('content')
    @include('backend.includes.bread-crumbs')

      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Events Payments</h3>
                        </div>
                        <div class="card-body table-responsive">
                            <table id="data" class="table table-bordered table-striped table-sm">
                                <thead>
                                    <tr>
                                        <th style="width: 10px">SN</th>
                                        <th>Event Name</th>
                                        <th>Full Names</th>
                                        <th>Phone Used To pay</th>
                                        <th>Amount Paid</th>
                                        <th>Status</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $payment)
                                        <tr>
                                            <td>
                                                {{ $loop->iteration }}
                                            </td>
                                            <td>
                                                <a href="#}">
                                                    {{ $payment->event->name }}
                                                </a>
                                            </td>
                                            <td>
                                                {{ $payment->attendance->first_name }} 
                                                {{ $payment->attendance->last_name }}
                                            </td>
                                            <td>
                                                {{ $payment->phone }}
                                            </td>
                                            <td>
                                                {{ $payment->amount }}
                                            </td>
                                            <td>
                                                {{ \EventPaymentStatus::getName($payment->payment_status)  }}
                                            </td>
                                            <td class="col-md-1">
                                                
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
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->

@endsection

@push('scripts')
    <script>
        $(document).ready(function() {

        });
    </script>
@endpush
