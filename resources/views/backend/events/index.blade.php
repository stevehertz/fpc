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
                            <h3 class="card-title">Events</h3>
                            <div class="card-tools">
                                <a href="{{ route('backend.events.create') }}" class="btn btn-success btn-sm">
                                    <i class="fas fa-plus"></i> New Event
                                </a>
                            </div>
                        </div>
                        <div class="card-body table-responsive">
                            <table id="data" class="table table-bordered table-striped table-sm">
                                <thead>
                                    <tr>
                                        <th style="width: 10px">SN</th>
                                        <th>Event Name</th>
                                        <th>Status</th>
                                        <th>Venue</th>
                                        <th>Theme</th>
                                        <th>Start Date</th>
                                        <th>End Date</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $event)
                                        <tr>
                                            <td>
                                                {{ $loop->iteration }}
                                            </td>
                                            <td>
                                                <a href="{{ route('backend.events.view', $event->id) }}">
                                                    {{ $event->name }}
                                                </a>
                                            </td>
                                            <td>
                                                {{ \EventStatus::getName($event->status) }}
                                            </td>
                                            <td>
                                                {{ $event->venue }}
                                            </td>
                                            <td>
                                                {{ $event->theme }}
                                            </td>
                                            <td>
                                                {{ \Carbon::parse($event->start_date)->format('d M, Y') }}
                                            </td>
                                            <td>
                                                {{ \Carbon::parse($event->end_date)->format('d M, Y') }}
                                            </td>
                                            <td class="col-md-1">
                                                @if (!$event->deleted_at)
                                                    <a href="{{ route('backend.events.edit', $event->id) }}"
                                                        class="btn btn-warning btn-sm">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <button type="button" class="btn btn-danger btn-sm deleteEventBtn"
                                                        data-id="{{ $event->id }}">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
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
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection

@push('scripts')
    @include('backend.events.scripts')
@endpush
