@extends('customer.sidebar')

@section('customer')

<div class="container-fluid py-4">

```
{{-- Page Header --}}
<div class="d-flex align-items-center justify-content-between mb-4">
    <div>
        <h3 class="fw-bold mb-1">Appointment History</h3>
        <p class="text-muted mb-0">
            View all your completed and cancelled past appointments.
        </p>
    </div>
</div>


{{-- Success Message --}}
@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="bi bi-check-circle me-2"></i>
        {{ session('success') }}

        <button type="button"
                class="btn-close"
                data-bs-dismiss="alert">
        </button>
    </div>
@endif


{{-- Error Message --}}
@if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <i class="bi bi-exclamation-circle me-2"></i>
        {{ session('error') }}

        <button type="button"
                class="btn-close"
                data-bs-dismiss="alert">
        </button>
    </div>
@endif


{{-- History Table Card --}}
<div class="card border-0 shadow-sm rounded-3">

    <div class="card-body p-0">

        <div class="table-responsive">

            <table class="table table-hover align-middle mb-0">

                <thead class="table-light">
                    <tr>

                        <th scope="col" class="ps-3">
                            #ID
                        </th>

                        <th scope="col">
                            Lawyer Name
                        </th>

                        <th scope="col">
                            Date
                        </th>

                        <th scope="col">
                            Time Slot
                        </th>

                        <th scope="col">
                            Status
                        </th>

                        <th scope="col" class="text-end pe-3">
                            Action
                        </th>

                    </tr>
                </thead>


                <tbody>

                    @forelse($appointments as $appointment)

                        <tr>

                            {{-- ID --}}
                            <td class="ps-3 fw-semibold">
                                #{{ $appointment->id }}
                            </td>


                            {{-- Lawyer Name --}}
                            <td>

                                <div class="d-flex align-items-center">

                                    @if(optional(optional($appointment->lawyer)->user)->profile_picture)

                                        <img src="{{ asset('uploads/profile/' . $appointment->lawyer->user->profile_picture) }}"
                                             class="rounded-circle me-2"
                                             width="36"
                                             height="36"
                                             style="object-fit: cover;"
                                             alt="Lawyer Avatar">

                                    @else

                                        <div class="rounded-circle bg-secondary text-white
                                                    d-flex align-items-center justify-content-center me-2"
                                             style="width:36px; height:36px; font-size:14px;">

                                            {{ strtoupper(
                                                substr(
                                                    optional(optional($appointment->lawyer)->user)->name ?? 'L',
                                                    0,
                                                    1
                                                )
                                            ) }}

                                        </div>

                                    @endif

                                    <span>
                                        {{ optional(optional($appointment->lawyer)->user)->name ?? 'N/A' }}
                                    </span>

                                </div>

                            </td>


                            {{-- Date --}}
                            <td>
                                {{ \Carbon\Carbon::parse($appointment->appointment_date)->format('M d, Y') }}
                            </td>


                            {{-- Time --}}
                            <td>
                                {{ $appointment->appointment_time }}
                            </td>


                            {{-- Status --}}
                            <td>

                                @if($appointment->status == 'completed')

                                    <span class="badge bg-success-subtle text-success
                                                 border border-success px-3 py-1 rounded-pill">

                                        <i class="bi bi-check-circle me-1"></i>
                                        Completed

                                    </span>

                                @elseif($appointment->status == 'cancelled')

                                    <span class="badge bg-danger-subtle text-danger
                                                 border border-danger px-3 py-1 rounded-pill">

                                        <i class="bi bi-x-circle me-1"></i>
                                        Cancelled

                                    </span>

                                @endif

                            </td>


                            {{-- Action --}}
                            <td class="text-end pe-3">

                                @if($appointment->status == 'completed')

                                    @if($appointment->feedback)

                                        {{-- Already Submitted --}}
                                        <span class="badge bg-success-subtle text-success
                                                     border border-success px-3 py-2 rounded-pill">

                                            <i class="bi bi-check-circle me-1"></i>
                                            Feedback Submitted

                                        </span>

                                    @else

                                        {{-- Feedback Button --}}
                                        <button type="button"
                                                class="btn btn-sm btn-outline-primary rounded-pill px-3"
                                                data-bs-toggle="modal"
                                                data-bs-target="#feedbackModal{{ $appointment->id }}">

                                            <i class="bi bi-star me-1"></i>
                                            Feedback

                                        </button>

                                    @endif

                                @else

                                    {{-- Cancelled appointment --}}
                                    <span class="text-muted small">
                                        —
                                    </span>

                                @endif

                            </td>

                        </tr>


                        {{-- ========================= --}}
                        {{-- Feedback Modal --}}
                        {{-- ========================= --}}

                        @if($appointment->status == 'completed' && !$appointment->feedback)

                            <div class="modal fade"
                                 id="feedbackModal{{ $appointment->id }}"
                                 tabindex="-1"
                                 aria-labelledby="feedbackModalLabel{{ $appointment->id }}"
                                 aria-hidden="true">

                                <div class="modal-dialog modal-dialog-centered">

                                    <div class="modal-content border-0 shadow-lg rounded-4">


                                        {{-- Modal Header --}}
                                        <div class="modal-header border-0 pb-0">

                                            <div>

                                                <h5 class="modal-title fw-bold"
                                                    id="feedbackModalLabel{{ $appointment->id }}">

                                                    Give Feedback

                                                </h5>

                                                <small class="text-muted">

                                                    Share your experience with this lawyer

                                                </small>

                                            </div>


                                            <button type="button"
                                                    class="btn-close"
                                                    data-bs-dismiss="modal"
                                                    aria-label="Close">
                                            </button>

                                        </div>


                                        {{-- Form --}}
                                        <form action="{{ route('customer.feedback.store') }}"
                                              method="POST">

                                            @csrf


                                            {{-- Appointment ID --}}
                                            <input type="hidden"
                                                   name="appointment_id"
                                                   value="{{ $appointment->id }}">


                                            <div class="modal-body px-4 py-4">


                                                {{-- Lawyer --}}
                                                <div class="text-center mb-4">

                                                    <div class="rounded-circle bg-primary bg-opacity-10
                                                                text-primary mx-auto mb-2
                                                                d-flex align-items-center justify-content-center"
                                                         style="width:60px; height:60px;">

                                                        <i class="bi bi-person-fill fs-3"></i>

                                                    </div>


                                                    <h6 class="fw-bold mb-1">

                                                        {{ optional(optional($appointment->lawyer)->user)->name ?? 'Lawyer' }}

                                                    </h6>


                                                    <small class="text-muted">

                                                        Appointment #{{ $appointment->id }}

                                                    </small>

                                                </div>


                                                {{-- Rating --}}
                                                <div class="mb-4 text-center">

                                                    <label class="form-label fw-semibold d-block mb-2">

                                                        How was your experience?

                                                    </label>


                                                    <div class="feedback-stars">

                                                        <input type="radio"
                                                               name="rating"
                                                               id="star5-{{ $appointment->id }}"
                                                               value="5"
                                                               required>

                                                        <label for="star5-{{ $appointment->id }}"
                                                               title="Excellent">

                                                            ★

                                                        </label>


                                                        <input type="radio"
                                                               name="rating"
                                                               id="star4-{{ $appointment->id }}"
                                                               value="4">

                                                        <label for="star4-{{ $appointment->id }}"
                                                               title="Very Good">

                                                            ★

                                                        </label>


                                                        <input type="radio"
                                                               name="rating"
                                                               id="star3-{{ $appointment->id }}"
                                                               value="3">

                                                        <label for="star3-{{ $appointment->id }}"
                                                               title="Good">

                                                            ★

                                                        </label>


                                                        <input type="radio"
                                                               name="rating"
                                                               id="star2-{{ $appointment->id }}"
                                                               value="2">

                                                        <label for="star2-{{ $appointment->id }}"
                                                               title="Fair">

                                                            ★

                                                        </label>


                                                        <input type="radio"
                                                               name="rating"
                                                               id="star1-{{ $appointment->id }}"
                                                               value="1">

                                                        <label for="star1-{{ $appointment->id }}"
                                                               title="Poor">

                                                            ★

                                                        </label>

                                                    </div>


                                                    <small class="text-muted">
                                                        Select 1 to 5 stars
                                                    </small>

                                                </div>


                                                {{-- Comment --}}
                                                <div class="mb-2">

                                                    <label class="form-label fw-semibold">

                                                        Your Feedback

                                                    </label>


                                                    <textarea name="comment"
                                                              class="form-control rounded-3"
                                                              rows="4"
                                                              maxlength="1000"
                                                              placeholder="Write your experience with this lawyer..."></textarea>


                                                    <small class="text-muted">
                                                        Maximum 1000 characters
                                                    </small>

                                                </div>

                                            </div>


                                            {{-- Footer --}}
                                            <div class="modal-footer border-0 px-4 pb-4">

                                                <button type="button"
                                                        class="btn btn-light rounded-pill px-4"
                                                        data-bs-dismiss="modal">

                                                    Cancel

                                                </button>


                                                <button type="submit"
                                                        class="btn btn-primary rounded-pill px-4">

                                                    <i class="bi bi-send me-1"></i>

                                                    Submit Feedback

                                                </button>

                                            </div>

                                        </form>

                                    </div>

                                </div>

                            </div>

                        @endif

                    @empty

                        <tr>

                            <td colspan="6"
                                class="text-center py-4 text-muted">

                                <i class="bi bi-clock-history fs-2 d-block mb-2"></i>

                                No appointment history found.

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>


    {{-- Pagination --}}
    @if($appointments->hasPages())

        <div class="card-footer bg-white border-0 py-3">

            {{ $appointments->links() }}

        </div>

    @endif

</div>
```

</div>

{{-- Feedback Stars CSS --}}

<style>

.feedback-stars {
    direction: rtl;
    display: inline-flex;
    justify-content: center;
    gap: 4px;
}

.feedback-stars input {
    display: none;
}

.feedback-stars label {
    font-size: 38px;
    color: #d1d5db;
    cursor: pointer;
    line-height: 1;
    transition: all 0.2s ease;
}

.feedback-stars label:hover,
.feedback-stars label:hover ~ label,
.feedback-stars input:checked ~ label {
    color: #ffc107;
    transform: scale(1.08);
}

</style>

@endsection
