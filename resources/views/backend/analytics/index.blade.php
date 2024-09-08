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
                            <h3 class="card-title">Online Visitors</h3>
                        </div>
                        <div class="card-body table-responsive">
                            <table id="data" class="table table-bordered table-striped table-sm">
                                <thead>
                                    <tr>
                                        <th style="width: 10px">SN</th>
                                        <th>Date</th>
                                        <th>Page Title</th>
                                        <th>Visitors</th>
                                        <th>Page Views</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $analytics)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $analytics['date'] }}</td>
                                            <td>{{ $analytics['pageTitle'] }}</td>
                                            <td>{{ $analytics['visitors'] }}</td>
                                            <td>{{ $analytics['pageViews'] }}</td>
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
