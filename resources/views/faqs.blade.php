@extends('layouts.main')
@section('title', 'Darjeeling Cab FAQs - Frequently Asked Questions')
@section('meta-tags')
    <meta name="description"
        content="Find answers to frequently asked questions about Darjeeling Cab. Learn about booking process, fares from NJP & Bagdogra, sightseeing, routes, safety, policies, and 24/7 support." />
    <meta name="keywords"
        content="Darjeeling Cab FAQ, NJP to Darjeeling taxi fare, Bagdogra to Darjeeling cab cost, Darjeeling sightseeing taxi, Gangtok cab service, taxi booking help, Darjeeling travel FAQ" />
    <meta name="author" content="Darjeeling Cab" />
    <meta property="og:locale" content="en_US">
    <meta property="og:type" content="website">
    <meta property="og:title" content="Darjeeling Cab FAQs - Frequently Asked Questions">
    <meta property="og:description"
        content="Darjeeling Cab answers your FAQs about cab booking, fares, sightseeing, NJP/Bagdogra routes, car types, safety, cancellation, and 24/7 taxi service in Darjeeling." />
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:site_name" content="Darjeeling Cab">
    <meta property=og:image content="{{ asset('assets/images/favicon.ico') }}">
@endsection

@section('content')
    <div class="container blogs-container">
        <div class="row">
            <h3 class="mb-4 page-title text-brand">Frequently Asked Questions</h3>

            <div class="col-md-12">
                <div class="accordion" id="faqAccordion">

                    {{-- General Booking --}}
                    <h4 class="mt-3 mb-2 text-brand">General Booking</h4>
                    @php
                        $faqs = [
                            'How can I book a cab with Darjeeling Cab?' =>
                                'You can book a cab online through our website, via WhatsApp, or by calling our customer support.',
                            'Can I book a taxi online or through WhatsApp?' =>
                                'Yes, both options are available. Online booking is quick and WhatsApp booking offers instant confirmation.',
                            'How early should I book my cab for October peak season?' =>
                                'We recommend booking at least 2–3 weeks in advance during October to ensure cab availability.',
                            'What payment options do you accept (cash, UPI, card)?' =>
                                'We accept cash, UPI, and online transfers. Card payments may be available on request.',
                            'Do I need to pay in advance to confirm my booking?' =>
                                'Yes, a small advance payment helps secure your booking, especially during peak tourist season.',
                        ];
                    @endphp
                    @foreach ($faqs as $q => $a)
                        <div class="accordion-item mb-2">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#{{ Str::slug($q) }}">
                                    {{ $q }}
                                </button>
                            </h2>
                            <div id="{{ Str::slug($q) }}" class="accordion-collapse collapse"
                                data-bs-parent="#faqAccordion">
                                <div class="accordion-body">{{ $a }}</div>
                            </div>
                        </div>
                    @endforeach

                    {{-- Routes & Services --}}
                    <h4 class="mt-3 mb-2 text-brand">Routes & Services</h4>
                    @php
                        $faqs = [
                            'What is the taxi fare from NJP to Darjeeling?' =>
                                'NJP to Darjeeling taxi fares start from ₹2,500 depending on vehicle type (Sedan, SUV, Innova).',
                            'How much does a Bagdogra to Darjeeling cab cost?' =>
                                'Bagdogra to Darjeeling cab fares usually range from ₹2,800–₹3,200 based on the car model.',
                            'Do you provide Darjeeling local sightseeing taxi service?' =>
                                'Yes, we offer sightseeing packages covering Tiger Hill, Batasia Loop, Tea Gardens, Peace Pagoda, and more.',
                            'Can I book a one-way cab from Darjeeling to Gangtok?' =>
                                'Yes, one-way and round-trip cab bookings to Gangtok are available.',
                            'Do you offer shared taxis or only private cabs?' =>
                                'Currently, we provide private cabs only to ensure comfort and safety.',
                        ];
                    @endphp
                    @foreach ($faqs as $q => $a)
                        <div class="accordion-item mb-2">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#{{ Str::slug($q) }}">
                                    {{ $q }}
                                </button>
                            </h2>
                            <div id="{{ Str::slug($q) }}" class="accordion-collapse collapse"
                                data-bs-parent="#faqAccordion">
                                <div class="accordion-body">{{ $a }}</div>
                            </div>
                        </div>
                    @endforeach

                    {{-- Cars & Comfort --}}
                    <h4 class="mt-3 mb-2 text-brand">Cars & Comfort</h4>
                    @php
                        $faqs = [
                            'What types of cars are available (Innova, WagonR, Sedan, SUV)?' =>
                                'We offer a wide range of cars including Hatchbacks (WagonR), Sedans, SUVs, and Innova for larger groups.',
                            'Are your taxis air-conditioned?' =>
                                'Yes, all our taxis are air-conditioned for your comfort.',
                            'Do your cabs have enough space for luggage?' =>
                                'Yes, depending on the car type. SUVs and Innovas are best suited for travelers with more luggage.',
                            'Is it safe for families and solo female travelers?' =>
                                'Absolutely, Darjeeling Cab prioritizes safety and ensures verified, professional drivers.',
                        ];
                    @endphp
                    @foreach ($faqs as $q => $a)
                        <div class="accordion-item mb-2">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#{{ Str::slug($q) }}">
                                    {{ $q }}
                                </button>
                            </h2>
                            <div id="{{ Str::slug($q) }}" class="accordion-collapse collapse"
                                data-bs-parent="#faqAccordion">
                                <div class="accordion-body">{{ $a }}</div>
                            </div>
                        </div>
                    @endforeach

                    {{-- Drivers & Safety --}}
                    <h4 class="mt-3 mb-2 text-brand">Drivers & Safety</h4>
                    @php
                        $faqs = [
                            'Are your drivers experienced and licensed?' =>
                                'Yes, all our drivers are licensed and experienced in hilly terrains.',
                            'Do drivers speak Hindi/English/Nepali?' =>
                                'Yes, most drivers are fluent in Hindi, Nepali, and conversational English.',
                            'Is night travel safe with Darjeeling Cab?' =>
                                'Yes, safety is our priority. Night travel is safe with our professional drivers.'
                        ];
                    @endphp
                    @foreach ($faqs as $q => $a)
                        <div class="accordion-item mb-2">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#{{ Str::slug($q) }}">
                                    {{ $q }}
                                </button>
                            </h2>
                            <div id="{{ Str::slug($q) }}" class="accordion-collapse collapse"
                                data-bs-parent="#faqAccordion">
                                <div class="accordion-body">{{ $a }}</div>
                            </div>
                        </div>
                    @endforeach

                    {{-- Tours & Packages --}}
                    <h4 class="mt-3 mb-2 text-brand">Tours & Packages</h4>
                    @php
                        $faqs = [
                            'Which sightseeing points are covered in Darjeeling local tour?' =>
                                'Our local tour covers Tiger Hill, Batasia Loop, Tea Gardens, Peace Pagoda, Rock Garden, and more.',
                            'Do you provide customized tour packages (Darjeeling + Sikkim + Kalimpong)?' =>
                                'Yes, we offer customizable multi-destination tour packages.',
                            'Can I hire a cab for multiple days?' =>
                                'Yes, cabs can be hired on a daily basis for long trips across North Bengal & Sikkim.',
                        ];
                    @endphp
                    @foreach ($faqs as $q => $a)
                        <div class="accordion-item mb-2">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#{{ Str::slug($q) }}">
                                    {{ $q }}
                                </button>
                            </h2>
                            <div id="{{ Str::slug($q) }}" class="accordion-collapse collapse"
                                data-bs-parent="#faqAccordion">
                                <div class="accordion-body">{{ $a }}</div>
                            </div>
                        </div>
                    @endforeach

                    {{-- Policies --}}
                    <h4 class="mt-3 mb-2 text-brand">Policies</h4>
                    @php
                        $faqs = [
                            'What is your cancellation and refund policy?' =>
                                'Full refund if cancelled 48 hours before journey. Partial charges may apply for last-minute cancellations.',
                            'What happens if my train/flight is delayed at NJP/Bagdogra?' =>
                                'We track your arrival and adjust pickup time accordingly. Extra waiting charges may apply beyond a certain limit.',
                            'Do you charge extra for waiting time?' =>
                                'Yes, minimal waiting charges apply beyond the complimentary waiting period.',
                        ];
                    @endphp
                    @foreach ($faqs as $q => $a)
                        <div class="accordion-item mb-2">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#{{ Str::slug($q) }}">
                                    {{ $q }}
                                </button>
                            </h2>
                            <div id="{{ Str::slug($q) }}" class="accordion-collapse collapse"
                                data-bs-parent="#faqAccordion">
                                <div class="accordion-body">{{ $a }}</div>
                            </div>
                        </div>
                    @endforeach

                    {{-- Contact & Support --}}
                    <h4 class="mt-3 mb-2 text-brand">Contact & Support</h4>
                    @php
                        $faqs = [
                            'How can I contact Darjeeling Cab customer support?' =>
                                'You can contact us via phone, WhatsApp, email, or through the contact form on our website.',
                            'Do you provide 24/7 cab service in Darjeeling?' =>
                                'Yes, Darjeeling Cab operates 24/7 for pickups, drops, and emergency travel needs.',
                        ];
                    @endphp
                    @foreach ($faqs as $q => $a)
                        <div class="accordion-item mb-2">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#{{ Str::slug($q) }}">
                                    {{ $q }}
                                </button>
                            </h2>
                            <div id="{{ Str::slug($q) }}" class="accordion-collapse collapse"
                                data-bs-parent="#faqAccordion">
                                <div class="accordion-body">{{ $a }}</div>
                            </div>
                        </div>
                    @endforeach

                </div>
            </div>
        </div>
    </div>
@endsection
