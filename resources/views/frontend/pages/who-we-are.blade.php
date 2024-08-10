@extends('frontend.layout.app')

@section('content')
    <!-- Page Header Start -->
    @include('frontend.include.breadcrumb')

    <!-- Who wer are Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="row g-4">
                <div class="col-lg-8 wow fadeInUp who-we-are-texts" data-wow-delay="0.1s">
                    <h2 class="mb-3">
                        Background
                    </h2>
                    <p>
                        Fresh Produce Consortium of Kenya (FPC Kenya) is trade Association committed to driving the growth
                        and success of fresh produce companies in Kenya and their partners. Registered in 2018, FPC Kenya is
                        a new outlook of an association which started in 2013 as the Kenya Association of Fruits and
                        Vegetable Exporters of Kenya (KEFE). However, in 2018 the Association took a name, Fresh Produce
                        Consortium of Kenya in response to the growing need to address challenges faced by players in the
                        domestic market space.
                    </p>

                    <p>
                        The FPC Kenya comprises of producers, traders and service providers for Kenya’s fresh horticultural
                        produce. FPC Kenya represents the interests of member companies (including family-owned, private and
                        publicly traded businesses as well as local and regional companies) throughout the fresh produce
                        supply chain. With increased diversity of its membership, and in view of the opportunities presented
                        in domestic and regional markets, it was necessary to change the mandate of FPC Kenya.
                    </p>

                    <p>
                        FPC Kenya’s current mandate is to promote the growth and success of fresh produce companies and
                        their partners, with greater focus on the domestic and regional markets. FPC Kenya is governed by a
                        board of 9 people, all of them representing exporting companies. A Chief Executive Officer was
                        appointed to represent the association. So far there is not yet a functional secretariat.
                    </p>
                </div>
                <div class="col-lg-4 wow fadeInUp" data-wow-delay="0.1s">
                    <p class="who-we-are-details">
                        <img src="{{ asset('img/who-we-are.jpg') }}" alt="" class="img-fluid">
                    </p>
                </div>
            </div>
        </div>
    </div>
    <!-- Who wer are End -->
@endsection
