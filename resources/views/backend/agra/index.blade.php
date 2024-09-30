@extends('backend.layouts.app')

@section('content')
    @include('backend.includes.bread-crumbs')


    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary">
                        <!-- form start -->
                        <form action="{{ route('agra.store') }}" enctype="multipart/form-data" method="POST">
                            @csrf
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="exampleInputFile">File input</label>
                                            <div class="input-group">
                                                <div class="custom-file">
                                                    <input type="file" name="file" class="custom-file-input"
                                                        id="exampleInputFile">
                                                    <label class="custom-file-label" for="exampleInputFile">Choose
                                                        file</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--/.col -->
                                </div>
                                <!--/.row -->
                            </div>
                            <!--/.card-body -->
                            <div class="card-footer">

                                <button type="submit" class="btn btn-primary">
                                    Submit
                                </button>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!--/.row -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Agra Table</h3>
                            <div class="card-tools">
                                <a href="{{ route('agra.export') }}" class="btn btn-primary">
                                    Export
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover table-striped">
                                    <thead>
                                        <tr>
                                            <th>SN</th>
                                            <th>Name</th>
                                            <th>Organization</th>
                                            <th>Email</th>
                                            <th>Phone</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data as $agra)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $agra->name }}</td>
                                                <td>{{ $agra->organization }}</td>
                                                <td>{{ $agra->email }}</td>
                                                <td>{{ $agra->phone }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--/.container-fluid -->
    </section>
    <!--/.content -->
@endsection

