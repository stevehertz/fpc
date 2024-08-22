@extends('backend.layouts.app')

@section('content')
    @include('backend.includes.bread-crumbs')

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 col-md-8">
                    <div class="card card-primary">
                        <form @isset($data) id="updateEventForm" @else id="newEventForm" @endisset>
                            <div class="card-body">
                                @csrf
                                @isset($data)
                                    <input type="hidden" name="_method" value="PUT">
                                @endisset
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="name">
                                                Event Name
                                            </label>
                                            <input type="text" name="name" class="form-control" id="name"
                                                placeholder="Event Name"
                                                value="@isset($data) {{ $data->name }} @endisset"
                                                required>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="description">Event Description</label>
                                            <textarea name="description" id="description" class="form-control" rows="3" placeholder="Enter event description">@isset($data) {{ $data->description }} @endisset</textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="image">
                                                Featured Image
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
                                </div>

                                <div class="row">
                                    <div class="col-12 col-md-6">
                                        <div class="form-group">
                                            <label for="status">Event Status</label>
                                            <select name="status" id="status" class="form-control select2"
                                                style="width: 100%;">
                                                <option selected="selected" disabled="disabled">
                                                    Select the event status
                                                </option>
                                                @foreach (\EventStatus::toArray() as $key => $value)
                                                    <option value="{{ $key }}"
                                                        @if (isset($data) && $data->status == $key) selected="selected" @endif>
                                                        {{ $value }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <!-- /.form-group -->
                                    </div>

                                    <div class="col-12 col-md-6">
                                        <div class="form-group">
                                            <label for="priority">
                                                Event Priority
                                            </label>
                                            <select id="priority" name="priority" class="form-control select2"
                                                style="width: 100%;">
                                                <option disabled="disabled" selected="selected">Select Priority for the
                                                    event</option>
                                                @foreach (\EventPriority::toArray() as $key => $value)
                                                    <option value="{{ $key }}"
                                                        @if (isset($data) && $data->priority == $key) selected="selected" @endif>
                                                        {{ $value }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <!-- /.form-group -->
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-12 col-md-6">
                                        <div class="form-group">
                                            <label for="venue">Venue</label>
                                            <input type="text" name="venue" class="form-control" id="venue"
                                                placeholder="Venue"
                                                value="@isset($data) {{ $data->venue }} @endisset">
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <div class="form-group">
                                            <label for="theme">Theme</label>
                                            <input type="text" name="theme" class="form-control" id="theme"
                                                placeholder="Theme"
                                                value="@isset($data) {{ $data->theme }} @endisset">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-12 col-md-6">
                                        <div class="form-group">
                                            <label for="start_date">
                                                Starting Date
                                            </label>
                                            <input type="text" name="start_date" class="form-control datepicker"
                                                id="start_date" placeholder="Starting Date" required autocomplete="off"
                                                data-date-format="yyyy-mm-dd"
                                                value="@isset($data) {{ $data->start_date }} @endisset">
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <div class="form-group">
                                            <label for="end_date">
                                                Ending Date
                                            </label>
                                            <input type="text" name="end_date" class="form-control datepicker"
                                                id="end_date" placeholder="Ending Date" required autocomplete="off"
                                                data-date-format="yyyy-mm-dd"
                                                value="@isset($data) {{ $data->end_date }} @endisset">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                @isset($data)
                                    <button type="submit" class="btn btn-primary">
                                        Update
                                    </button>
                                @else
                                    <button type="submit" class="btn btn-primary">
                                        Create
                                    </button>
                                @endisset
                            </div>
                        </form>
                    </div>
                    <!--/.card -->
                </div>
                <div class="col-12 col-md-4">
                    <div class="card card-widget">
                        <div class="card-header">
                            <h3 class="card-title">
                                Events Banner Image
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
                                <img class="img-fluid pad" src="{{ asset('img/backend/default-150x150.png') }}"
                                    alt="Photo">
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
@endsection

@push('scripts')
    @include('backend.events.scripts')
@endpush
