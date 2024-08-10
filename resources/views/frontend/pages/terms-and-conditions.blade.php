@extends('frontend.layout.app')

@section('content')
    <!-- Page Header Start -->
    @include('frontend.include.breadcrumb')

    <!-- Terms and Conditions Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="row g-4">
                <div class="col-lg-12 wow fadeInUp" data-wow-delay="0.1s">
                    <h2 class="mb-3">
                        T&C
                    </h2>
                    <h3>Categories of Membership</h3>
                    <h3>Ordinary Membership – Ksh. 20,000</h3>
                    <ul>
                        <li>Exporters</li>
                        <li>Farmers</li>
                        <li>Aggregators</li>
                    </ul>
                    <h3>Corporate Membership</h3>
                    <ul>
                        <li>Financial institutions</li>
                        <li>Certification Bodies</li>
                        <li>Input Suppliers</li>
                    </ul>
                    <h3>Terms and Conditions of Membership</h3>
                    <ol>
                        <li>To become a member, one must complete a membership form and pay the annual membership fee.</li>
                        <li>The membership fee is renewable each calendar year.</li>
                        <li>During the membership period, members enjoy the full benefits of the association.</li>
                        <li>Members are free to join other associations while being part of our membership.</li>
                        <li>Forging any of our certificates will incur a penalty fee of not less than Ksh. 100,000.</li>
                        <li>All payments must be made to our official company account. The account details are provided on the membership form. Note: The company is not liable for any payments made to accounts other than our official company account.</li>
                        <li>We assist in resolving conflicts between active members but are not responsible for conflicts involving third parties outside our membership.</li>
                    </ol>

                    <h3>Membership Benefits</h3>
                    <ul>
                        <li><b>Networking Opportunities:</b> Members can connect with potential clients and other fresh produce value chain actors through our meetings and interaction sessions.</li>
                        <li><b>Priority Access:</b> Members receive priority for programs, workshops, and training sessions.</li>
                        <li><b>Timely Information:</b> Our communications department ensures members receive timely updates on opportunities and relevant matters locally and internationally.</li>
                        <li><b>Exclusive Access:</b> Members can interact with each other through our WhatsApp group.</li>
                        <li><b>Dedicated Support:</b> Our dedicated team is accessible through office visits, emails, phone calls, WhatsApp, and social media to respond to inquiries promptly.</li>
                        <li><b>International Platforms:</b> Members can advertise and pitch their products and services at international standard platforms like the Kenya Fresh Produce Conference and Exhibition.</li>
                        <li><b>Visa Assistance:</b> We assist members in obtaining visas for international fresh produce expos by providing recommendation letters to embassies.</li>
                        <li><b>Market Intelligence:</b> Members receive accurate and timely information on market requirements and new trends.</li>
                    </ul>

                    <p>We are committed to supporting our members and providing them with the resources and opportunities they need to succeed in the fresh produce value chain.</p>
                </div>
            </div>
        </div>
        <!--/.container -->
    </div>
    <!-- Terms and Conditions End -->
@endsection
