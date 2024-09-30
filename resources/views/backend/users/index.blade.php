@extends('backend.layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    @include('backend.includes.bread-crumbs')

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">
                                Users
                            </h3>
                            <div class="card-tools">
                                <a href="#" class="btn btn-success btn-sm">
                                    <i class="fas fa-user-plus"></i> New User
                                </a>
                            </div>
                        </div>
                        <div class="card-body table-responsive">
                            <table id="data" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>SN</th>
                                        <th>Full Names</th>
                                        <th>Profile</th>
                                        <th>Phone Number</th>
                                        <th>Email Address</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $user)
                                        <tr>
                                            <td>
                                                {{ $loop->iteration }}
                                            </td>
                                            <td>
                                                {{ $user->first_name }} {{ $user->last_name }}
                                            </td>
                                            <td>
                                                
                                            </td>
                                            <td>
                                                {{ $user->phone }}
                                            </td>
                                            <td>
                                                {{ $user->email }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {

        });
    </script>
@endpush
