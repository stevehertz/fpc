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
                        <form @isset($data) id="updatePostForm" @else id="newPostForm" @endisset>
                            @csrf
                            @isset($data)
                                <input type="hidden" name="_method" value="PUT">
                            @endisset
                            <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="newPostTitle">
                                                Title
                                            </label>
                                            <input type="text" name="title" class="form-control" id="newPostTitle"
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
                                            <label for="newPostFeaturedImage">
                                                Featured Image
                                            </label>
                                            <div class="input-group">
                                                <div class="custom-file">
                                                    <input type="file" name="featured_image" class="custom-file-input"
                                                        id="newPostFeaturedImage"
                                                        value="@isset($data) {{ $data->featured_image }} @endisset">
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

                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="newPostContent">
                                                Content
                                            </label>
                                            <textarea id="newPostContent" name="content">
                                                @isset($data){!! $data->content !!}@endisset
                                            </textarea>
                                        </div>
                                    </div>
                                    <!--/.col -->
                                </div>
                                <!--/.row -->

                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label>Date Posted:</label>
                                            <div class="input-group date" id="reservationdatetime"
                                                data-target-input="nearest">
                                                <input type="text" name="posted_at" placeholder="Date Posted"
                                                    class="form-control datetimepicker-input"
                                                    data-target="#reservationdatetime" />
                                                <div class="input-group-append" data-target="#reservationdatetime"
                                                    data-toggle="datetimepicker">
                                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- /.form group -->
                                    </div>
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
                                Featured Image
                            </h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            @isset($data)
                                @if ($data->featured_image)
                                    {{-- {{ $data->featured_image  }} --}}
                                    <img class="img-fluid pad" src="{{ asset('img/' . $data->featured_image) }}" alt="Photo">
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