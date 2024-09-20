@extends('frontend.layout.app')

@section('title', 'Sign up | ' . config('app.name'))

@section('content')
    @include('frontend.include.breadcrumb')

    <!-- Contact Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="row g-5">
                <div class="col-lg-6 wow fadeIn" data-wow-delay="0.1s">
                    <p class="fs-5 fw-bold text-primary">
                        {{ $data->name }}
                    </p>
                    <h1 class="display-5 mb-5">
                        REGISTER HERE
                    </h1>
                    <form id="registerExhibitionForm" method="POST">
                        @csrf
                        <input type="hidden" name="event_id" value="{{ $data->id }}"> 
                        <!-- Step 1 -->
                        <div class="row g-3 form-step">
                            <div class="col-12 col-md-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control" name="first_name" id="first_name"
                                        placeholder="First Name" required>
                                    <label for="first_name">First Name</label>
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control" name="last_name" id="last_name"
                                        placeholder="Last Name" required>
                                    <label for="last_name">Last Name</label>
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="form-floating">
                                    <input type="text" name="phone" class="form-control" id="phone"
                                        placeholder="Phone Number" required>
                                    <label for="phone">Phone Number</label>
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="form-floating">
                                    <input type="email" name="email" class="form-control" id="email"
                                        placeholder="Email Address" required>
                                    <label for="email">Email Address</label>
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="form-floating">
                                    <input type="text" name="organization" class="form-control" id="organization"
                                        placeholder="Organization" required>
                                    <label for="organization">Organization</label>
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="form-floating">
                                    <input type="text" name="position" class="form-control" id="position"
                                        placeholder="Position" required>
                                    <label for="position">Position</label>
                                </div>
                            </div>
                            <input type="hidden" name="user_type" value="{{ \ExhibitionRegisterAs::EXHIBITOR }}">
                            <div class="col-12">
                                <button class="btn btn-primary py-3 px-4 next-step" type="button">
                                    Next
                                </button>
                            </div>
                        </div>
                        <!-- Step 2 -->
                        <div class="row g-3 form-step d-one">
                            <div class="col-12 col-md-12">
                                <h2 class="mb-3">
                                    Payments Details
                                </h2>
                                <p>
                                    Complete payments
                                </p>
                                <ol>
                                    <li>Select</li>
                                    <li>Select Lipa na M-PESA</li>
                                    <li>Select Pay Bill</li>
                                    <li>Enter the following details</li>
                                </ol>
                                <div class="bg-light d-flex align-self-stretch box p-4">
                                    <p>
                                        Business Number: <b>400200</b> <br>
                                        Account Number: <b>01136507311500</b><br>
                                        Amount: <b>KES 50,000.00</b><br><br>
                                        {{-- or <br> <br>
                                        <a href="" class="">
                                            Tap to M-PESA
                                        </a> --}}
                                    </p>
                                </div>
                                <input type="hidden" name="amount" value="50000">
                                <input type="hidden" name="paid" value="50000">
                            </div>
                            <div class="col-12 col-md-12">
                                <div class="form-floating">
                                    <input type="text" class="form-control" name="transacted_phone" id="transactionPhone"
                                        placeholder="Enter Phone Number Used To Pay" required autofocus>
                                    <label for="transactionPhone">Phone Number Used To Pay</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <button class="btn btn-secondary py-3 px-4 previous-step" type="button">
                                    Previous
                                </button>
                                <button class="btn btn-primary py-3 px-4" type="submit">
                                    Register
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-lg-6 wow fadeIn" data-wow-delay="0.5s" style="min-height: 450px;">
                    <div class="position-relative rounded overflow-hidden h-100">
                        <iframe class="position-relative w-100 h-100"
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3988.8687817493305!2d36.86380107484185!3d-1.2500459987380472!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x182f1681c629b6ef%3A0x8748f86816536d3d!2sKenya%20school%20of%20monetary%20studies!5e0!3m2!1sen!2ske!4v1724083092534!5m2!1sen!2ske"
                            frameborder="0" style="min-height: 450px; border:0;" allowfullscreen="" aria-hidden="false"
                            tabindex="0"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Contact End -->
@endsection

@push('scripts')
    @include('frontend.exhibition.scripts')
@endpush
    