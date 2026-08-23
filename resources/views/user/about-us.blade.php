@extends('user.navbar') {{-- Apne layout file se extend karein --}}

@section('user')

<style>
    .legalease-bg { background-color: #0c1821; color: #ffffff; }
    .gold-text { color: #d39e25; }
    .gold-bg { background-color: #d39e25; color: #000; font-weight: 600; border: none; }
    .gold-border { border: 1px solid #d39e25; }
    .card-custom { background-color: #142433; border: 1px solid #22374a; border-radius: 12px; }

    /* Accordion Custom Styling */
    .accordion-button-custom {
        background-color: #142433 !important;
        color: #ffffff !important;
        border: 1px solid #22374a;
        font-weight: 500;
        padding: 1.1rem 1.25rem;
    }
    .accordion-button-custom:not(.collapsed) {
        color: #d39e25 !important;
        border-color: #d39e25;
        box-shadow: none;
    }
    .accordion-button-custom::after {
        filter: invert(1); /* Arrow icon white */
    }
    .accordion-body-custom {
        background-color: #081118;
        color: #ffffff !important; /* Pure White Text */
        border: 1px solid #22374a;
        border-top: none;
        line-height: 1.7;
    }
</style>

<div class="legalease-bg py-5">
    <div class="container py-4">

        <!-- Hero Section -->
        <div class="text-center mb-5">
            <span class="badge gold-border gold-text px-3 py-2 rounded-pill mb-3">About LegalEase</span>
            <h1 class="display-4 fw-bold mb-3 text-light">Empowering Access to Legal Justice</h1>
            <p class=" col-lg-8 mx-auto lead ">
                LegalEase is Pakistan's leading digital platform connecting citizens with verified advocates, legal consultants, and High Court practitioners instantly.
            </p>
        </div>

        <!-- Stats Section -->
        <div class="row text-center mb-5 g-4">
            <div class="col-md-3">
                <div class="card-custom p-4">
                    <h2 class="gold-text fw-bold">1,200+</h2>
                    <p class=" mb-0">Verified Advocates</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card-custom p-4">
                    <h2 class="gold-text fw-bold">98%</h2>
                    <p class=" mb-0">Case Satisfaction Rate</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card-custom p-4">
                    <h2 class="gold-text gold-text fw-bold">15+</h2>
                    <p class=" mb-0">Cities Covered</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card-custom p-4">
                    <h2 class="gold-text fw-bold">2 Min</h2>
                    <p class=" mb-0">Instant Consultation Booking</p>
                </div>
            </div>
        </div>

        <!-- How It Works Section -->
        <div class="mb-5 text-center ">
            <h2 class="fw-bold mb-4 text-light">How <span class="gold-text">LegalEase</span> Works</h2>
            <div class="row g-4 text-start">
                <div class="col-md-4">
                    <div class="card-custom p-4 h-100">
                        <div class="gold-text fs-3 mb-2">01.</div>
                        <h5 class="fw-bold">Search & Filter</h5>
                        <p class=" small">Find verified lawyers by city, field of specialization (Corporate, Criminal, Family), and consultation fees.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card-custom p-4 h-100">
                        <div class="gold-text fs-3 mb-2">02.</div>
                        <h5 class="fw-bold">Book Slot</h5>
                        <p class=" small">Choose an available time slot for online video consultation or in-person chamber meetings.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card-custom p-4 h-100">
                        <div class="gold-text fs-3 mb-2">03.</div>
                        <h5 class="fw-bold">Get Legal Solution</h5>
                        <p class=" small">Consult with experienced advocates, share document scans securely, and resolve legal matters smoothly.</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Frequently Asked Questions (10 FAQs) -->
        <div class="my-5">
            <div class="text-center mb-4">
                <span class="badge gold-border gold-text px-3 py-2 rounded-pill mb-2">Got Questions?</span>
                <h2 class="fw-bold text-light">Frequently Asked Questions (<span class="gold-text">FAQs</span>)</h2>
            </div>

            <div class="accordion col-lg-10 mx-auto" id="faqAccordion">

                <!-- FAQ 1 -->
                <div class="accordion-item bg-transparent border-0 mb-3">
                    <h2 class="accordion-header">
                        <button class="accordion-button accordion-button-custom rounded-top" type="button" data-bs-toggle="collapse" data-bs-target="#faq1">
                            1. Are all advocates listed on LegalEase officially verified?
                        </button>
                    </h2>
                    <div id="faq1" class="accordion-collapse collapse show" data-bs-parent="#faqAccordion">
                        <div class="accordion-body accordion-body-custom rounded-bottom">
                            Yes, absolutely. Every lawyer who registers on LegalEase undergoes a thorough background verification process. We verify their Bar Council license card, High Court or Subordinate Court practice credentials, and professional background before approving their profile.
                        </div>
                    </div>
                </div>

                <!-- FAQ 2 -->
                <div class="accordion-item bg-transparent border-0 mb-3">
                    <h2 class="accordion-header">
                        <button class="accordion-button accordion-button-custom collapsed rounded" type="button" data-bs-toggle="collapse" data-bs-target="#faq2">
                            2. How do online legal consultations work?
                        </button>
                    </h2>
                    <div id="faq2" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                        <div class="accordion-body accordion-body-custom rounded-bottom">
                            Once you select a lawyer and book an available time slot, a secure video call meeting link is automatically generated and sent to your email and dashboard. You can join the private consultation directly through your browser or mobile phone.
                        </div>
                    </div>
                </div>

                <!-- FAQ 3 -->
                <div class="accordion-item bg-transparent border-0 mb-3">
                    <h2 class="accordion-header">
                        <button class="accordion-button accordion-button-custom collapsed rounded" type="button" data-bs-toggle="collapse" data-bs-target="#faq3">
                            3. Can I schedule an in-person chamber meeting instead of online video?
                        </button>
                    </h2>
                    <div id="faq3" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                        <div class="accordion-body accordion-body-custom rounded-bottom">
                            Yes! Each advocate's profile displays their physical chamber address and office timings. While booking, you can choose between "Online Video Consultation" or "Chamber Visit" depending on your preference.
                        </div>
                    </div>
                </div>

                <!-- FAQ 4 -->
                <div class="accordion-item bg-transparent border-0 mb-3">
                    <h2 class="accordion-header">
                        <button class="accordion-button accordion-button-custom collapsed rounded" type="button" data-bs-toggle="collapse" data-bs-target="#faq4">
                            4. How can a lawyer register and offer services on LegalEase?
                        </button>
                    </h2>
                    <div id="faq4" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                        <div class="accordion-body accordion-body-custom rounded-bottom">
                            Advocates can click on the "Join as Lawyer" button in the top navigation bar, fill out their details, upload their Bar Council ID card and practice domain info. Our admin team reviews the application within 24-48 hours for approval.
                        </div>
                    </div>
                </div>

                <!-- FAQ 5 -->
                <div class="accordion-item bg-transparent border-0 mb-3">
                    <h2 class="accordion-header">
                        <button class="accordion-button accordion-button-custom collapsed rounded" type="button" data-bs-toggle="collapse" data-bs-target="#faq5">
                            5. Are my legal discussions and documents kept confidential?
                        </button>
                    </h2>
                    <div id="faq5" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                        <div class="accordion-body accordion-body-custom rounded-bottom">
                            100% yes. We take client attorney privilege and data privacy very seriously. All document shares, communication channels, and consultation notes are encrypted and accessible only to you and your chosen legal advisor.
                        </div>
                    </div>
                </div>

                <!-- FAQ 6 -->
                <div class="accordion-item bg-transparent border-0 mb-3">
                    <h2 class="accordion-header">
                        <button class="accordion-button accordion-button-custom collapsed rounded" type="button" data-bs-toggle="collapse" data-bs-target="#faq6">
                            6. What specializations or practice areas are covered?
                        </button>
                    </h2>
                    <div id="faq6" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                        <div class="accordion-body accordion-body-custom rounded-bottom">
                            LegalEase covers almost all legal fields in Pakistan, including Criminal Law, Civil Litigation, Family & Divorce Disputes, Corporate & Business Law, Property & Land Affidavits, Tax Advisory, and Intellectual Property Law.
                        </div>
                    </div>
                </div>

                <!-- FAQ 7 -->
                <div class="accordion-item bg-transparent border-0 mb-3">
                    <h2 class="accordion-header">
                        <button class="accordion-button accordion-button-custom collapsed rounded" type="button" data-bs-toggle="collapse" data-bs-target="#faq7">
                            7. How are consultation fees determined?
                        </button>
                    </h2>
                    <div id="faq7" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                        <div class="accordion-body accordion-body-custom rounded-bottom">
                            Consultation fees are set directly by the individual advocates based on their experience level, legal domain, and reputation. All fees are displayed clearly upfront on the lawyer's profile card with zero hidden charges.
                        </div>
                    </div>
                </div>

                <!-- FAQ 8 -->
                <div class="accordion-item bg-transparent border-0 mb-3">
                    <h2 class="accordion-header">
                        <button class="accordion-button accordion-button-custom collapsed rounded" type="button" data-bs-toggle="collapse" data-bs-target="#faq8">
                            8. Can I reschedule or cancel a booked appointment?
                        </button>
                    </h2>
                    <div id="faq8" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                        <div class="accordion-body accordion-body-custom rounded-bottom">
                            Yes, you can easily reschedule or cancel an appointment through your Client Dashboard up to 2 hours prior to the scheduled meeting time.
                        </div>
                    </div>
                </div>

                <!-- FAQ 9 -->
                <div class="accordion-item bg-transparent border-0 mb-3">
                    <h2 class="accordion-header">
                        <button class="accordion-button accordion-button-custom collapsed rounded" type="button" data-bs-toggle="collapse" data-bs-target="#faq9">
                            9. What happens if a lawyer misses the scheduled consultation?
                        </button>
                    </h2>
                    <div id="faq9" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                        <div class="accordion-body accordion-body-custom rounded-bottom">
                            In the rare event that a lawyer is unable to attend the session, you will instantly receive an option to re-book a priority session with the same lawyer or receive a full refund/credit to book another advocate.
                        </div>
                    </div>
                </div>

                <!-- FAQ 10 -->
                <div class="accordion-item bg-transparent border-0 mb-3">
                    <h2 class="accordion-header">
                        <button class="accordion-button accordion-button-custom collapsed rounded" type="button" data-bs-toggle="collapse" data-bs-target="#faq10">
                            10. How can I contact LegalEase customer support for help?
                        </button>
                    </h2>
                    <div id="faq10" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                        <div class="accordion-body accordion-body-custom rounded-bottom">
                            You can reach out to our dedicated support team via our Contact Us page, send an email directly to support@legalease.pk, or call our official helpline during standard operating hours.
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </div>
</div>

@endsection
