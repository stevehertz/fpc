@extends('backend.layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    @include('backend.includes.bread-crumbs')

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary">
                        <!-- form start -->
                        <form id="newPostForm">
                            @csrf
                            <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="newPostTitle">
                                                Title
                                            </label>
                                            <input type="text" name="title" class="form-control" id="newPostTitle"
                                                placeholder="Title">
                                        </div>
                                    </div>
                                    <!--/.col -->
                                </div>
                                <!--/.row -->
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="newPostContent">
                                                Content
                                            </label>
                                            <textarea id="newPostContent" name="content">
                                                Place <em>some</em> <u>text</u> <strong>here</strong>
                                            </textarea>
                                        </div>
                                    </div>
                                    <!--/.col -->
                                </div>
                                <!--/.row -->
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="newPostFeaturedImage">
                                                Featured Image
                                            </label>
                                            <div class="input-group">
                                                <div class="custom-file">
                                                    <input type="file" name="featured_image" class="custom-file-input"
                                                        id="newPostFeaturedImage">
                                                    <label class="custom-file-label" for="newPostFeaturedImage">
                                                        Choose file
                                                    </label>
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
                                    Publish
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!--/.row -->
        </div>
        <!--/.container-fluid -->
    </section>
    <!--/.content -->
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            // Summernote
            $('#newPostContent').summernote({
                height: 300,
                callbacks: {
                    onImageUpload: function(files) {
                        uploadImage(files[0]);
                    }
                }
            });

            function uploadImage(file) {
                let path = '{{ route('posts.upload') }}';
                let data = new FormData();
                data.append("image", file);
                $.ajax({
                    type: "POST",
                    url: path,
                    data: data,
                    contentType: false,
                    processData: false,
                    success: function(url) {
                        $('#body').summernote('insertImage', url);
                    },
                    error: function(data) {
                        toastr.error('There was an error uploading the image');
                    }
                });
            }

            $('#newPostForm').submit(function(e) {
                e.preventDefault();
                let form = $(this);
                let formData = new FormData(form[0]);
                formData.append('content', $('#newPostContent').val());
                let path = '{{ route('posts.store') }}';
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
                            'Publish'
                        );
                        form.find('button[type=submit]').attr('disabled', false);
                    },
                    success: function(data) {
                        if (data['status']) 
                        {
                            toastr.success(data['message']);
                            setTimeout(() => {
                                window.location.href = '{{ route('posts.index') }}'
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
@endpush
