@extends('backend.layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    @include('backend.includes.bread-crumbs')

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-8">
                    <div class="card card-primary">
                        <!-- form start -->
                        <form @isset($data) id="updateSliderForm" @else id="newSliderForm" @endisset>
                            @csrf
                            @isset($data)
                                <input type="hidden" name="_method" value="PUT">
                            @endisset
                            <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="title">
                                                Title
                                            </label>
                                            <input type="text" name="title" class="form-control" id="title"
                                                placeholder="Title"
                                                value="@isset($data) {{ $data->title }} @endisset">
                                        </div>
                                    </div>
                                    <!--/.col -->
                                </div>
                                <!--/.row -->
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="image">
                                                Image
                                            </label>
                                            <div class="input-group">
                                                <div class="custom-file">
                                                    <input type="file" name="image" class="custom-file-input"
                                                        id="image"
                                                        value="@isset($data) {{ $data->image }} @endisset">
                                                    <label class="custom-file-label" for="image">
                                                        Choose file
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--/.col -->
                                </div>
                                <!--/.row -->

                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="description">
                                                Description
                                            </label>
                                            <textarea id="description" class="contentDescription" name="description">
                                                @isset($data)
{!! $data->description !!}
@endisset
                                            </textarea>
                                        </div>
                                    </div>
                                    <!--/.col -->
                                </div>
                                <!--/.row -->
                            </div>
                            <!--/.card-body -->
                            <div class="card-footer">
                                @isset($data)
                                    <button type="submit" class="btn btn-primary">
                                        Update
                                    </button>
                                @else
                                    <button type="submit" class="btn btn-primary">
                                        Publish
                                    </button>
                                @endisset
                            </div>
                        </form>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card card-widget">
                        <div class="card-header">
                            <h3 class="card-title">
                                Slide Image
                            </h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            @isset($data)
                                @if ($data->image)
                                    {{-- {{ $data->featured_image  }} --}}
                                    <img class="img-fluid pad" src="{{ asset('img/' . $data->image) }}" alt="Photo">
                                @else
                                    <img class="img-fluid pad" src="{{ asset('img/backend/default-150x150.png') }}"
                                        alt="Photo">
                                @endif
                            @else
                                <img class="img-fluid pad" src="{{ asset('img/backend/default-150x150.png') }}" alt="Photo">
                            @endisset
                        </div>
                    </div>
                    <!-- /.card -->
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


            function uploadImage(file) {
                let path = '{{ route('sliders.upload') }}';
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

            $('#newSliderForm').submit(function(e) {
                e.preventDefault();
                let form = $(this);
                let formData = new FormData(form[0]);
                formData.append('description', $('#image').val());
                let path = '{{ route('sliders.store') }}';
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
                        if (data['status']) {
                            toastr.success(data['message']);
                            setTimeout(() => {
                                window.location.href = '{{ route('sliders.index') }}'
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

            @isset($data)
                $('#updateSliderForm').submit(function(e) {
                    e.preventDefault();
                    let form = $(this);
                    let formData = new FormData(form[0]);
                    formData.append('description', $('#image').val());
                    let path = '{{ route('sliders.update', $data->id) }}';
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
                                    window.location.href = '{{ route('sliders.index') }}'
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
            @endisset

        });
    </script>
@endpush
