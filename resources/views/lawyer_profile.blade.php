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
                aria-current="page">

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


                <!-- ================= LAWYER PROFILE ================= -->

                <div class="card-legal p-4 p-lg-5">

                    <div class="d-flex flex-column flex-sm-row gap-4 align-items-sm-center">


                        <!-- Profile Image -->

                        @if($lawyer->image)

                        <img
                            src="{{ asset('uploads/lawyers/' . $lawyer->image) }}"
                            alt="Lawyer Profile"
                            width="100"
                            height="100"
                            class="rounded-circle object-fit-cover">

                        @else

                        <div
                            class="rounded-circle bg-light d-flex align-items-center justify-content-center"
                            style="width:100px;height:100px;">

                            <i class="bi bi-person fs-1 text-muted"></i>

                        </div>

                        @endif


                        <div>


                            <!-- Lawyer Name -->

                            <h1 class="h3 mb-1">

                                {{ $lawyer->user->name ?? 'Lawyer' }}

                                @if($lawyer->is_verified)

                                <i
                                    class="bi bi-patch-check-fill text-gold"
                                    title="Verified">
                                </i>

                                @endif

                            </h1>


                            <!-- Rating -->

                            @php

                            /*
                            |--------------------------------------------------------------------------
                            | Real Feedback Rating
                            |--------------------------------------------------------------------------
                            */

                            $feedbackCount = $lawyer->feedbacks->count();

                            $feedbackAverage = $feedbackCount > 0
                            ? $lawyer->feedbacks->avg('rating')
                            : 0;

                            @endphp


                            <div class="rating mb-2">

                                @for($i = 1; $i <= 5; $i++)

                                    @if($i <=round($feedbackAverage))

                                    <i class="bi bi-star-fill text-warning"></i>

                                    @else

                                    <i class="bi bi-star text-warning"></i>

                                    @endif

                                    @endfor


                                    <span class="text-muted-legal small ms-1">

                                        {{ number_format($feedbackAverage, 1) }}

                                        ·

                                        {{ $feedbackCount }}

                                        reviews

                                    </span>

                            </div>


                            <!-- Service / City / Experience -->

                            <div class="d-flex flex-wrap gap-2">


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


                    <!-- ================= ABOUT ================= -->

                    <h2 class="h6 text-uppercase text-muted-legal">
                        About
                    </h2>

                    <p class="mb-4">

                        {{ $lawyer->bio ?? 'No biography available.' }}

                    </p>


                    <!-- ================= QUALIFICATIONS ================= -->

                    <h2 class="h6 text-uppercase text-muted-legal">

                        Qualifications &amp; credentials

                    </h2>


                    <ul class="list-unstyled d-grid gap-2 mb-4">

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


                    <!-- ================= CONTACT / LOCATION ================= -->

                    <div class="row g-3">

                        <div class="col-sm-6">

                            <div class="p-3 bg-light-gray rounded-3">

                                <small class="text-muted-legal d-block">

                                    Office address

                                </small>

                                <span class="fw-semibold">

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

                                <span class="fw-semibold text-navy fs-5">

                                    Rs.

                                    {{ number_format($lawyer->fee ?? 0) }}

                                </span>

                            </div>

                        </div>

                    </div>

                </div>



                <!-- =====================================================
                 CLIENT REVIEWS
            ====================================================== -->


                <div class="card-legal p-4 p-lg-5 mt-4">


                    <!-- Review Header -->

                    <div class="d-flex justify-content-between align-items-center mb-4">

                        <div>

                            <h2 class="h5 mb-1">

                                Client Reviews

                            </h2>

                            <p class="text-muted-legal small mb-0">

                                Feedback from clients who consulted this lawyer.

                            </p>

                        </div>


                        <!-- Average Rating -->

                        <div class="text-end">

                            @php

                            $reviewCount = $lawyer->feedbacks->count();

                            $averageRating = $reviewCount > 0
                            ? $lawyer->feedbacks->avg('rating')
                            : 0;

                            @endphp


                            <div class="fw-bold fs-5 text-navy">

                                {{ number_format($averageRating, 1) }}

                                <i class="bi bi-star-fill text-warning"></i>

                            </div>


                            <small class="text-muted-legal">

                                {{ $reviewCount }}

                                {{ $reviewCount == 1 ? 'Review' : 'Reviews' }}

                            </small>

                        </div>

                    </div>



                    <!-- ================= REVIEWS LIST ================= -->

                    <div class="d-grid gap-3">


                        @forelse($lawyer->feedbacks as $feedback)


                        <div class="p-3 border rounded-3">


                            <div class="d-flex justify-content-between align-items-start">


                                <!-- Customer -->

                                <div class="d-flex align-items-center">


                                    <!-- Customer Avatar -->

                                    <div
                                        class="rounded-circle bg-light-gray d-flex align-items-center justify-content-center me-3"
                                        style="width:45px;height:45px;">


                                        <img
                                            src="{{ asset('uploads/profile/' . $feedback->customer->profile_picture) }}"
                                            alt="Customer Profile"
                                            width="50"
                                            height="50"
                                            class="rounded-circle object-fit-cover">


                                    </div>


                                    <div>

                                        <strong class="text-navy d-block">

                                            {{ $feedback->customer->name ?? 'Anonymous Client' }}

                                        </strong>


                                        <small class="text-muted-legal">

                                            {{ $feedback->created_at
                                                ? $feedback->created_at->format('M d, Y')
                                                : 'Recently' }}

                                        </small>

                                    </div>

                                </div>



                                <!-- Stars -->

                                <div class="rating">

                                    @for($i = 1; $i <= 5; $i++)

                                        @if($i <=$feedback->rating)

                                        <i class="bi bi-star-fill text-warning"></i>

                                        @else

                                        <i class="bi bi-star text-warning"></i>

                                        @endif

                                        @endfor

                                </div>

                            </div>



                            <!-- Comment -->

                            @if($feedback->comment)

                            <p class="mb-0 mt-3 small text-muted-legal">

                                "{{ $feedback->comment }}"

                            </p>

                            @else

                            <p class="mb-0 mt-3 small text-muted-legal">

                                No comment provided.

                            </p>

                            @endif


                        </div>


                        @empty


                        <!-- No Reviews -->

                        <div class="text-center py-5">


                            <div class="mb-3">

                                <i
                                    class="bi bi-chat-square-text text-muted"
                                    style="font-size:3rem;">
                                </i>

                            </div>


                            <h6 class="fw-semibold text-navy">

                                No Reviews Yet

                            </h6>


                            <p class="text-muted-legal small mb-0">

                                This lawyer hasn't received any feedback yet.

                            </p>

                        </div>


                        @endforelse


                    </div>

                </div>


            </div>



            <!-- =====================================================
             RIGHT COLUMN - BOOKING
        ====================================================== -->

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

                            <li>

                                {{ $error }}

                            </li>

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

                                <strong>

                                    {{ $dayName }}

                                </strong>.

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

                                Rs.

                                {{ number_format($lawyer->fee ?? 0) }}

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
                    aria-label="Close">
                </button>

            </div>


            <div class="modal-body pt-0">


                <div class="text-center mb-4">

                    <i
                        class="bi bi-check-circle-fill text-gold"
                        style="font-size:3rem">
                    </i>


                    <p class="text-muted-legal mt-2 mb-0">

                        Your consultation request has been sent.

                        You will be notified once the lawyer approves it.

                    </p>

                </div>


                <ul
                    class="list-group list-group-flush small"
                    id="summaryList">
                </ul>

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
    ```

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