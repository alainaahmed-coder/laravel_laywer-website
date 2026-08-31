@extends('user.navbar')

@section('user')

<link href="{{ asset('css/style.css') }}" rel="stylesheet">


<section class="bg-navy py-4">
    <div class="container">

        <ol class="breadcrumb mb-0 small">

            <li class="breadcrumb-item">
                <a href="{{ url('/') }}" class="text-gold">
                    Home
                </a>
            </li>

            <li class="breadcrumb-item">
                <a href="{{ route('lawyerfind') }}" class="text-gold">
                    Find Lawyers
                </a>
            </li>

            <li class="breadcrumb-item active text-white-50"
                aria-current="page"
                id="crumbName">

                {{ $lawyer->user->name ?? 'Lawyer' }}

            </li>

        </ol>

    </div>
</section>


<main class="section pt-4">

    <div class="container">

        <div class="row g-4">


            <!-- =====================================================
                 LEFT COLUMN
            ====================================================== -->

            <div class="col-lg-7 col-xl-8">

                <div class="card-legal p-4 p-lg-5">

                    <div class="d-flex flex-column flex-sm-row gap-4 align-items-sm-center">


                        <!-- Profile Image -->

                        <img
                            src="{{ asset('uploads/lawyers/' . $lawyer->image) }}"
                            alt="Lawyer Profile"
                            width="100"
                            height="100"
                            class="rounded-circle object-fit-cover">


                        <div>


                            <!-- Lawyer Name -->

                            <h1 class="h3 mb-1" id="pName">

                                {{ $lawyer->user->name ?? 'Lawyer' }}

                                @if($lawyer->is_verified)

                                <i
                                    class="bi bi-patch-check-fill text-gold"
                                    title="Verified">
                                </i>

                                @endif

                            </h1>


                            <!-- Rating -->

                            <div class="rating mb-2" id="pRating">

                                @php

                                $rating =
                                $lawyer->rating ?? 5.0;

                                $totalReviews =
                                $lawyer->total_reviews ?? 0;

                                @endphp


                                @for($i = 1; $i <= 5; $i++)

                                    <i
                                    class="bi bi-star{{ $i <= round($rating) ? '-fill' : '' }} text-warning">
                                    </i>

                                    @endfor


                                    <span class="text-muted-legal small ms-1">

                                        {{ number_format($rating, 1) }}

                                        ·

                                        {{ $totalReviews }}

                                        reviews

                                    </span>

                            </div>


                            <!-- Service / City / Experience -->

                            <div
                                class="d-flex flex-wrap gap-2"
                                id="pTags">

                                @if($lawyer->service)

                                <span class="badge-spec small">

                                    {{ $lawyer->service->name }}

                                </span>

                                @endif


                                @if($lawyer->city)

                                <span class="badge-gold small">

                                    <i class="bi bi-geo-alt me-1"></i>

                                    {{ $lawyer->city->name }}

                                </span>

                                @endif


                                <span class="badge-spec small">

                                    <i class="bi bi-briefcase me-1"></i>

                                    {{ $lawyer->experience ?? 0 }}

                                    yrs experience

                                </span>

                            </div>

                        </div>

                    </div>


                    <hr class="my-4">


                    <!-- ABOUT -->

                    <h2 class="h6 text-uppercase text-muted-legal">
                        About
                    </h2>


                    <p class="mb-4" id="pBio">

                        {{ $lawyer->bio ?? 'No biography available.' }}

                    </p>


                    <!-- QUALIFICATIONS -->

                    <h2 class="h6 text-uppercase text-muted-legal">

                        Qualifications &amp; credentials

                    </h2>


                    <ul
                        class="list-unstyled d-grid gap-2 mb-4"
                        id="pQuals">

                        @if(is_array($lawyer->qualifications))

                        @foreach($lawyer->qualifications as $qual)

                        <li>

                            <i class="bi bi-check2-circle text-gold me-2"></i>

                            {{ $qual }}

                        </li>

                        @endforeach

                        @elseif(!empty($lawyer->qualifications))

                        <li>

                            <i class="bi bi-check2-circle text-gold me-2"></i>

                            {{ $lawyer->qualifications }}

                        </li>

                        @else

                        <li class="text-muted small">

                            N/A

                        </li>

                        @endif

                    </ul>


                    <!-- CONTACT / LOCATION -->

                    <div class="row g-3">

                        <div class="col-sm-6">

                            <div class="p-3 bg-light-gray rounded-3">

                                <small class="text-muted-legal d-block">

                                    Office address

                                </small>


                                <span
                                    class="fw-semibold"
                                    id="pAddress">

                                    {{ $lawyer->office_address
                                        ?? ($lawyer->city->name ?? 'Not available') }}

                                </span>

                            </div>

                        </div>


                        <div class="col-sm-6">

                            <div class="p-3 bg-light-gray rounded-3">

                                <small class="text-muted-legal d-block">

                                    Consultation fee

                                </small>


                                <span
                                    class="fw-semibold text-navy fs-5"
                                    id="pFee">

                                    Rs.

                                    {{ number_format($lawyer->fee ?? 0) }}

                                </span>

                            </div>

                        </div>

                    </div>

                </div>



                <!-- =====================================================
                     REVIEWS
                ====================================================== -->

                <div class="card-legal p-4 p-lg-5 mt-4">

                    <div
                        class="d-flex justify-content-between align-items-center mb-4">

                        <h2 class="h5 mb-0">

                            Client reviews

                        </h2>


                        <span class="badge-gold" id="rSummary">

                            {{ number_format($rating, 1) }}

                            average from

                            {{ $totalReviews }}

                            clients

                        </span>

                    </div>


                    <div
                        class="d-grid gap-3"
                        id="reviewList">

                        @forelse($lawyer->reviews ?? [] as $review)

                        <div class="p-3 border rounded-3">

                            <div
                                class="d-flex justify-content-between align-items-center">

                                <strong class="text-navy">

                                    {{ $review->user_name ?? 'Anonymous Client' }}

                                </strong>


                                <small class="text-muted-legal">

                                    {{ $review->created_at
                                            ? $review->created_at->diffForHumans()
                                            : 'Recently' }}

                                </small>

                            </div>


                            <div class="rating my-1">

                                @for($i = 1; $i <= 5; $i++)

                                    <i
                                    class="bi bi-star{{ $i <= $review->rating ? '-fill' : '' }} text-warning">
                                    </i>

                                    @endfor

                            </div>


                            <p class="mb-0 small text-muted-legal">

                                {{ $review->comment ?? $review->text ?? '' }}

                            </p>

                        </div>

                        @empty

                        <p class="text-muted small mb-0">

                            No reviews available yet.

                        </p>

                        @endforelse

                    </div>

                </div>

            </div>



            <!-- =====================================================
                 RIGHT COLUMN - BOOKING
            ====================================================== -->

            <!-- ================= RIGHT COLUMN ================= -->

            <aside class="col-lg-5 col-xl-4">

                <div
                    class="card-legal p-4 sticky-lg-top"
                    style="top:88px">

                    <h2 class="h5 mb-1">
                        Book an appointment
                    </h2>

                    <p class="text-muted-legal small">
                        Select a date, choose an available slot and confirm.
                    </p>


                    <!-- Success -->
                    @if(session('success'))

                    <div class="alert alert-success py-2 small">

                        <i class="bi bi-check-circle me-1"></i>

                        {{ session('success') }}

                    </div>

                    @endif


                    <!-- Errors -->
                    @if($errors->any())

                    <div class="alert alert-danger py-2 small">

                        <ul class="mb-0 ps-3">

                            @foreach($errors->all() as $error)

                            <li>{{ $error }}</li>

                            @endforeach

                        </ul>

                    </div>

                    @endif


                    <!-- ================= BOOKING FORM ================= -->

                    <form
                        id="bookingForm"
                        action="{{ route('appointment.store') }}"
                        method="POST"
                        class="needs-validation"
                        novalidate>

                        @csrf


                        <!-- Lawyer ID -->

                        <input
                            type="hidden"
                            name="lawyer_id"
                            value="{{ $lawyer->id }}">


                        <!-- Selected Time -->

                        <input
                            type="hidden"
                            name="appointment_time"
                            id="selectedSlot"
                            value="">


                        <!-- ================= DATE ================= -->

                        <div class="mb-3">

                            <label
                                for="bDate"
                                class="form-label small fw-semibold">
                                Appointment date
                            </label>


                            <input
                                type="date"
                                class="form-control"
                                name="appointment_date"
                                id="bDate"
                                value="{{ $selectedDate }}"
                                min="{{ date('Y-m-d') }}"
                                required>


                            <div class="invalid-feedback">
                                Please choose a date.
                            </div>

                        </div>


                        <!-- ================= SELECTED DAY ================= -->

                        <div class="mb-3">

                            <div class="small text-muted-legal">

                                Selected day:

                                <strong class="text-navy">
                                    {{ $dayName }}
                                </strong>

                            </div>

                        </div>


                        <!-- ================= AVAILABLE SLOTS ================= -->

                        <div class="mb-3">

                            <label class="form-label small fw-semibold">

                                Available time slots

                            </label>


                            @if(!$schedule)

                            <div class="alert alert-warning py-2 small mb-0">

                                <i class="bi bi-calendar-x me-1"></i>

                                Lawyer is not available on
                                <strong>{{ $dayName }}</strong>.

                            </div>


                            @elseif(count($slots) === 0)

                            <div class="alert alert-warning py-2 small mb-0">

                                <i class="bi bi-calendar-x me-1"></i>

                                No slots are available for this date.

                            </div>


                            @else

                            <div class="row g-2">

                                @foreach($slots as $slot)

                                <div class="col-6">

                                    <button
                                        type="button"
                                        class="slot-btn w-100 {{ $slot['booked'] ? 'disabled' : '' }}"
                                        data-time="{{ $slot['time'] }}"
                                        {{ $slot['booked'] ? 'disabled' : '' }}>

                                        {{ $slot['display_time'] }}


                                        @if($slot['booked'])

                                        <small class="d-block text-danger">

                                            Booked

                                        </small>

                                        @endif

                                    </button>

                                </div>

                                @endforeach

                            </div>

                            @endif

                        </div>


                        <!-- ================= MEETING TYPE ================= -->

                        <div class="mb-3">

                            <label
                                class="form-label small fw-semibold"
                                for="bMode">

                                Meeting place / type

                            </label>


                            <select
                                class="form-select"
                                name="meeting_type"
                                id="bMode"
                                required>

                                <option value="">
                                    Select meeting type
                                </option>

                                <option value="Office Visit">
                                    Office Visit
                                </option>

                                <option value="Video Call">
                                    Video Call
                                </option>

                                <option value="Phone Call">
                                    Phone Call
                                </option>

                                <option value="Court Premises">
                                    Court Premises
                                </option>

                            </select>


                            <div class="invalid-feedback">

                                Please select a meeting type.

                            </div>

                        </div>


                        <!-- ================= CASE SUMMARY ================= -->

                        <div class="mb-3">

                            <label
                                class="form-label small fw-semibold"
                                for="bNotes">

                                Case summary

                                <span class="text-muted-legal fw-normal">

                                    (optional)

                                </span>

                            </label>


                            <textarea
                                class="form-control"
                                name="case_summary"
                                id="bNotes"
                                rows="3"
                                placeholder="Briefly describe your matter"></textarea>

                        </div>


                        <!-- ================= SLOT ALERT ================= -->

                        <div
                            class="alert alert-warning py-2 small d-none"
                            id="slotAlert">

                            <i class="bi bi-exclamation-triangle me-1"></i>

                            Please select an available time slot.

                        </div>


                        <!-- ================= TOTAL ================= -->

                        <div
                            class="d-flex justify-content-between align-items-center bg-light-gray rounded-3 p-3 mb-3">

                            <span class="small text-muted-legal">

                                Total payable

                            </span>


                            <span class="fw-bold text-navy">

                                Rs. {{ number_format($lawyer->fee ?? 0) }}

                            </span>

                        </div>


                        <!-- ================= SUBMIT ================= -->

                        <button
                            type="submit"
                            class="btn btn-gold w-100 py-2">

                            <i class="bi bi-calendar2-check me-1"></i>

                            Confirm Booking

                        </button>


                        <p
                            class="text-muted-legal small text-center mt-3 mb-0">

                            <i class="bi bi-shield-lock me-1"></i>

                            Free cancellation up to 12 hours before.

                        </p>

                    </form>

                </div>

            </aside>
        </div>

    </div>

</main>



<!-- ============================================================
     BOOKING CONFIRMATION MODAL
============================================================= -->

<div
    class="modal fade"
    id="confirmModal"
    tabindex="-1"
    aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered">

        <div class="modal-content border-0 rounded-4">


            <div class="modal-header border-0">

                <h3 class="modal-title h5">

                    Appointment submitted

                </h3>


                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                    aria-label="Close"></button>

            </div>


            <div class="modal-body pt-0">

                <div class="text-center mb-4">

                    <i
                        class="bi bi-check-circle-fill text-gold"
                        style="font-size:3rem"></i>


                    <p class="text-muted-legal mt-2 mb-0">

                        Your consultation request has been sent.
                        You will be notified once the lawyer approves it.

                    </p>

                </div>


                <ul
                    class="list-group list-group-flush small"
                    id="summaryList"></ul>

            </div>


            <div class="modal-footer border-0">

                <button
                    type="button"
                    class="btn btn-gold"
                    data-bs-dismiss="modal">

                    Close

                </button>

            </div>

        </div>

    </div>

</div>



<!-- ============================================================
     REAL BOOKING JAVASCRIPT
============================================================= -->

<script>
    document.addEventListener("DOMContentLoaded", function() {

        const dateInput =
            document.getElementById("bDate");

        const selectedSlot =
            document.getElementById("selectedSlot");

        const bookingForm =
            document.getElementById("bookingForm");

        const slotAlert =
            document.getElementById("slotAlert");


        // ==========================================
        // DATE CHANGE
        // ==========================================

        dateInput.addEventListener("change", function() {

            if (!this.value) {
                return;
            }


            // Reload page with selected date
            const url =
                new URL(window.location.href);

            url.searchParams.set(
                "appointment_date",
                this.value
            );


            window.location.href =
                url.toString();

        });


        // ==========================================
        // SLOT SELECT
        // ==========================================

        document.addEventListener(
            "click",
            function(event) {

                const button =
                    event.target.closest(".slot-btn");


                if (!button || button.disabled) {
                    return;
                }


                document
                    .querySelectorAll(".slot-btn")
                    .forEach(function(btn) {

                        btn.classList.remove("active");

                    });


                button.classList.add("active");


                selectedSlot.value =
                    button.dataset.time;


                slotAlert.classList.add(
                    "d-none"
                );

            }
        );


        // ==========================================
        // FORM VALIDATION
        // ==========================================

        bookingForm.addEventListener(
            "submit",
            function(event) {

                this.classList.add(
                    "was-validated"
                );


                if (!this.checkValidity()) {

                    event.preventDefault();

                    return;

                }


                if (!selectedSlot.value) {

                    event.preventDefault();

                    slotAlert.classList.remove(
                        "d-none"
                    );

                    slotAlert.scrollIntoView({
                        behavior: "smooth",
                        block: "center"
                    });

                }

            }
        );

    });
</script>


@endsection