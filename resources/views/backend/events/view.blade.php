@extends('backend.layouts.app')

@section('content')
    @include('backend.includes.bread-crumbs')
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3>
                                {{ $data->attendance->count() }}
                            </h3>

                            <p>
                                Total Attendances
                            </p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-bag"></i>
                        </div>
                        <a href="#" class="small-box-footer">
                            More info <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>
                <!-- ./col -->

                <div class="col-12 col-md-9">

                </div>
                <!--/.col -->
            </div>
            <!--/.row -->

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h1>
                                {{ $data->name }}
                            </h1>
                            <p>
                                {{ $data->description }}
                            </p>
                            <p>
                                <b>Status: </b> {{ EventStatus::getName($data->status) }}
                            </p>
                            <p>
                                <b>Theme: </b> {{ $data->theme }}
                            </p>
                            <p>
                                <b>Venue: </b> {{ $data->venue }}
                            </p>
                            <p>
                                <b>Starting Date: </b> {{ Carbon::parse($data->start_date)->format('F j, Y') }} <b>Ending Date: </b> {{ Carbon::parse($data->end_date)->format('F j, Y') }}
                            </p>

                            <p>
                                <b>Priority: </b> {{ EventPriority::getName($data->priority) }}
                            </p>

                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>
            </div>
            <!--/.row -->
        </div>
        <!--/.container-fluid -->
    </section>
    <!--/.content -->
@endsection
