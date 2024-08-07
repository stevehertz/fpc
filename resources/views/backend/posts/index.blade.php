@extends('backend.layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    @include('backend.includes.bread-crumbs')

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Blog Posts</h3>
                            <div class="card-tools">
                                <a href="{{ route('posts.create') }}" class="btn btn-success btn-sm">
                                    <i class="fas fa-plus"></i> New Post
                                </a>
                            </div>
                        </div>
                        <div class="card-body table-responsive">
                            <table id="data" class="table table-bordered table-striped table-sm">
                                <thead>
                                    <tr>
                                        <th style="width: 10px">SN</th>
                                        <th>Title</th>
                                        <th>Author</th>
                                        <th>Created At</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $post)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $post->title }}</td>
                                            <td>{{ $post->user->first_name }} {{ $post->user->last_name }}</td>
                                            <td>
                                                @isset($post->posted_at)
                                                    {{ date('d M Y', strtotime($post->posted_at)) }}
                                                @else
                                                    {{ $post->created_at->format('d M Y') }}
                                                @endisset
                                            </td>
                                            <td class="col-sm-2">
                                                @if (!$post->deleted_at)
                                                    <a href="{{ route('posts.edit', $post->id) }}"
                                                        class="btn btn-warning btn-sm">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <button type="button" class="btn btn-danger btn-sm deletePostBtn"
                                                        data-id="{{ $post->id }}">
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
    <script>
        $(document).ready(function() {
            $("#data").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

            $(document).on('click', '.deletePostBtn', function(e) {
                e.preventDefault();
                let post_id = $(this).data('id');
                let path = '{{ route('posts.delete', ':post') }}';
                path = path.replace(":post", post_id);
                let token = '{{ csrf_token() }}';
                Swal.fire({
                    title: 'Are you sure?',
                    text: 'You want to remove this post',
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
@endpush
