<div class="container-xxl py-5">
    <div class="container">
        <div class="row g-5 align-items-center">
            <div class="col-lg-4 col-md-5 wow fadeInUp" data-wow-delay="0.1s">
                @if ($criticalEvent->image == 'img/events/noimage.png')
                    <img class="img-fluid rounded" data-wow-delay="0.1s" src="{{ asset('img/events/event-2.jpg') }}">
                @else
                    <img class="img-fluid rounded" data-wow-delay="0.1s"
                        src="{{ asset('img/' . $criticalEvent->image) }}">
                @endif
            </div>
            <div class="col-lg-8 col-md-7 wow fadeInUp" data-wow-delay="0.3s">
                <h1 class="display-1 text-primary mb-0">
                    {{ \Carbon::parse($criticalEvent->start_date)->format('Y') }}
                </h1>
                <p class="text-primary mb-4">
                    Upcoming Event
                </p>
                <h1 class="display-5 mb-4">
                    {{ $criticalEvent->name }}
                </h1>
                <h2>
                    THEME
                </h2>
                <h4 class="eventsTheme">
                    {{ $criticalEvent->theme }}
                </h4>
                <p class="mb-4">
                    <b>DATE:</b> {{ Carbon\Carbon::parse($criticalEvent->start_date)->format('jS') }} to 
                    {{ Carbon\Carbon::parse($criticalEvent->end_date)->format('jS F Y') }}                    
                </p>
                <p class="mb-4">
                    <b>VENUE:</b> {{ $criticalEvent->venue }}
                </p>
                <a class="btn btn-primary py-3 px-4" href="{{ route('delegates.sign-up', $criticalEvent->slug) }}">
                    Deligates Registration
                </a>
                <a class="btn btn-primary py-3 px-4"
                    href="{{ route('sign.up.for.conference.and.exhibition', $criticalEvent->slug) }}">
                    Exhibitor Registration
                </a>
            </div>

        </div>
    </div>
</div>
