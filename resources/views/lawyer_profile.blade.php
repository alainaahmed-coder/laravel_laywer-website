<link href="{{asset('css/style.css')}}" rel="stylesheet">

@extends('user.navbar')

@section('user')

<section class="bg-navy py-4">
  <div class="container">
    <ol class="breadcrumb mb-0 small">
      <li class="breadcrumb-item"><a href="{{ url('/') }}" class="text-gold">Home</a></li>
      <li class="breadcrumb-item"><a href="#" class="text-gold">Find Lawyers</a></li>
      <li class="breadcrumb-item active text-white-50" aria-current="page" id="crumbName">{{ $lawyer->name }}</li>
    </ol>
  </div>
</section>

<main class="section pt-4">
  <div class="container">
    <div class="row g-4">

      <!-- LEFT COLUMN -->
      <div class="col-lg-7 col-xl-8">
        <div class="card-legal p-4 p-lg-5">
          <div class="d-flex flex-column flex-sm-row gap-4 align-items-sm-center">
            <!-- Profile Image with Fallback -->
            <img id="pImg"
                 src="{{ !empty($lawyer->image) ? asset('images/Lawyer/' . $lawyer->image) : asset('images/default-avatar.jpg') }}"
                 alt="Portrait of {{ $lawyer->name }}"
                 class="avatar avatar-lg">

            <div>
              <h1 class="h3 mb-1" id="pName">
                {{ $lawyer->name }}
                @if($lawyer->is_verified)
                  <i class="bi bi-patch-check-fill text-gold" title="Verified"></i>
                @endif
              </h1>

              <!-- Rating & Reviews Count -->
              <div class="rating mb-2" id="pRating">
                @php
                  $rating = $lawyer->rating ?? 5.0;
                  $totalReviews = $lawyer->reviews_count ?? count($lawyer->reviews ?? []);
                @endphp
                @for($i = 1; $i <= 5; $i++)
                  <i class="bi bi-star{{ $i <= round($rating) ? '-fill' : '' }} text-warning"></i>
                @endfor
                <span class="text-muted-legal small ms-1">{{ number_format($rating, 1) }} · {{ $totalReviews }} reviews</span>
              </div>

              <!-- Specialization, City & Experience Badges -->
              <div class="d-flex flex-wrap gap-2" id="pTags">
                @if($lawyer->specialization)
                  <span class="badge-spec small">{{ $lawyer->specialization }}</span>
                @endif
                <span class="badge-gold small"><i class="bi bi-geo-alt me-1"></i>{{ $lawyer->city }}</span>
                <span class="badge-spec small"><i class="bi bi-briefcase me-1"></i>{{ $lawyer->experience }} yrs experience</span>
              </div>
            </div>
          </div>

          <hr class="my-4">

          <!-- About Section -->
          <h2 class="h6 text-uppercase text-muted-legal">About</h2>
          <p class="mb-4" id="pBio">{{ $lawyer->bio ?? 'No biography available.' }}</p>

          <!-- Qualifications & Credentials -->
          <h2 class="h6 text-uppercase text-muted-legal">Qualifications &amp; credentials</h2>
          <ul class="list-unstyled d-grid gap-2 mb-4" id="pQuals">
            @if(is_array($lawyer->qualifications))
              @foreach($lawyer->qualifications as $qual)
                <li><i class="bi bi-check2-circle text-gold me-2"></i>{{ $qual }}</li>
              @endforeach
            @elseif(!empty($lawyer->qualifications))
              <li><i class="bi bi-check2-circle text-gold me-2"></i>{{ $lawyer->qualifications }}</li>
            @else
              <li class="text-muted small">N/A</li>
            @endif
          </ul>

          <!-- Contact & Location Info -->
          <div class="row g-3">
            <div class="col-sm-6">
              <div class="p-3 bg-light-gray rounded-3">
                <small class="text-muted-legal d-block">Office address</small>
                <span class="fw-semibold" id="pAddress">{{ $lawyer->office_address ?? $lawyer->city }}</span>
              </div>
            </div>
            <div class="col-sm-6">
              <div class="p-3 bg-light-gray rounded-3">
                <small class="text-muted-legal d-block">Consultation fee</small>
                <span class="fw-semibold text-navy fs-5" id="pFee">Rs. {{ number_format($lawyer->fee) }}</span>
              </div>
            </div>
          </div>
        </div>

        <!-- Reviews Section -->
        <div class="card-legal p-4 p-lg-5 mt-4">
          <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="h5 mb-0">Client reviews</h2>
            <span class="badge-gold" id="rSummary">{{ number_format($rating, 1) }} average from {{ $totalReviews }} clients</span>
          </div>
          <div class="d-grid gap-3" id="reviewList">
            @forelse($lawyer->reviews ?? [] as $review)
              <div class="p-3 border rounded-3">
                <div class="d-flex justify-content-between align-items-center">
                  <strong class="text-navy">{{ $review->user_name ?? 'Anonymous Client' }}</strong>
                  <small class="text-muted-legal">{{ $review->created_at ? $review->created_at->diffForHumans() : 'Recently' }}</small>
                </div>
                <div class="rating my-1">
                  @for($i = 1; $i <= 5; $i++)
                    <i class="bi bi-star{{ $i <= $review->rating ? '-fill' : '' }} text-warning"></i>
                  @endfor
                </div>
                <p class="mb-0 small text-muted-legal">{{ $review->comment ?? $review->text }}</p>
              </div>
            @empty
              <p class="text-muted small mb-0">No reviews available yet.</p>
            @endforelse
          </div>
        </div>
      </div>

      <!-- RIGHT COLUMN: BOOKING WIDGET -->
      <aside class="col-lg-5 col-xl-4">
        <div class="card-legal p-4 sticky-lg-top" style="top:88px">
          <h2 class="h5 mb-1">Book an appointment</h2>
          <p class="text-muted-legal small">Select a date, choose an available slot and confirm.</p>

          {{-- <form id="bookingForm" class="needs-validation" action="{{ route('appointments.store') }}" method="POST" novalidate>
            @csrf --}}
            <input type="hidden" name="lawyer_id" value="{{ $lawyer->id }}">
            <input type="hidden" name="time_slot" id="selectedSlot">

            <div class="mb-3">
              <label class="form-label small fw-semibold" for="bDate">Appointment date</label>
              <input type="date" class="form-control" name="appointment_date" id="bDate" required>
              <div class="invalid-feedback">Please choose a date.</div>
            </div>

            <!-- Tabs Navigation -->
            <ul class="nav nav-pills nav-pills-legal nav-fill gap-2 mb-3" role="tablist">
              <li class="nav-item" role="presentation">
                <button class="nav-link active" data-bs-toggle="pill" data-bs-target="#morningPane" type="button" role="tab">
                  <i class="bi bi-sunrise me-1"></i>Morning
                </button>
              </li>
              <li class="nav-item" role="presentation">
                <button class="nav-link" data-bs-toggle="pill" data-bs-target="#eveningPane" type="button" role="tab">
                  <i class="bi bi-sunset me-1"></i>Evening
                </button>
              </li>
            </ul>

            <!-- Dynamic Time Slots -->
            <div class="tab-content mb-3">
              <div class="tab-pane fade show active" id="morningPane" role="tabpanel">
                <div class="row g-2" id="morningSlots"></div>
              </div>
              <div class="tab-pane fade" id="eveningPane" role="tabpanel">
                <div class="row g-2" id="eveningSlots"></div>
              </div>
            </div>

            <div class="mb-3">
              <label class="form-label small fw-semibold" for="bMode">Meeting place / type</label>
              <select class="form-select" name="meeting_type" id="bMode" required>
                <option value="">Select meeting type</option>
                <option value="Office Visit">Office Visit</option>
                <option value="Video Call">Video Call</option>
                <option value="Phone Call">Phone Call</option>
                <option value="Court Premises">Court Premises</option>
              </select>
              <div class="invalid-feedback">Please select a meeting type.</div>
            </div>

            <div class="mb-3">
              <label class="form-label small fw-semibold" for="bNotes">Case summary <span class="text-muted-legal fw-normal">(optional)</span></label>
              <textarea class="form-control" name="case_summary" id="bNotes" rows="3" placeholder="Briefly describe your matter"></textarea>
            </div>

            <div class="alert alert-warning py-2 small d-none" id="slotAlert" role="alert">
              <i class="bi bi-exclamation-triangle me-1"></i> Please select an available time slot.
            </div>

            <div class="d-flex justify-content-between align-items-center bg-light-gray rounded-3 p-3 mb-3">
              <span class="small text-muted-legal">Total payable</span>
              <span class="fw-bold text-navy" id="bTotal">Rs. {{ number_format($lawyer->fee) }}</span>
            </div>

            <button type="submit" class="btn btn-gold w-100 py-2"><i class="bi bi-calendar2-check me-1"></i> Confirm Booking</button>
            <p class="text-muted-legal small text-center mt-3 mb-0"><i class="bi bi-shield-lock me-1"></i>Free cancellation up to 12 hours before.</p>
          </form>
        </div>
      </aside>
    </div>
  </div>
</main>

<!-- Booking Confirmation Modal -->
<div class="modal fade" id="confirmModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content border-0 rounded-4">
      <div class="modal-header border-0">
        <h3 class="modal-title h5">Appointment confirmed</h3>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body pt-0">
        <div class="text-center mb-4">
          <i class="bi bi-check-circle-fill text-gold" style="font-size:3rem"></i>
          <p class="text-muted-legal mt-2 mb-0">Your consultation request has been sent. You will be notified once the lawyer approves it.</p>
        </div>
        <ul class="list-group list-group-flush small" id="summaryList"></ul>
      </div>
      <div class="modal-footer border-0">
        {{-- <a href="{{ route('dashboard.customer') }}" class="btn btn-navy w-100">Go to my appointments</a> --}}
      </div>
    </div>
  </div>
</div>

<!-- Time Slots Engine & Validation Script -->
<script>
document.addEventListener("DOMContentLoaded", function () {
  const TIME_SLOTS = {
    morning: ["09:00 AM", "10:00 AM", "11:00 AM", "11:30 AM"],
    evening: ["02:00 PM", "03:30 PM", "05:00 PM", "06:30 PM"]
  };

  const el = (i) => document.getElementById(i);
  const today = new Date();
  const iso = (d) => d.toISOString().slice(0, 10);

  el("bDate").min = iso(today);
  const tomorrow = new Date(today.getTime() + 86400000);
  el("bDate").value = iso(tomorrow);

  let selected = null;

  function renderSlots() {
    const day = new Date(el("bDate").value || iso(tomorrow)).getDay();
    const build = (list, target) => {
      el(target).innerHTML = list.map((t, i) => {
        const taken = (i + day) % 4 === 0;
        return `<div class="col-6"><button type="button" class="slot-btn" data-time="${t}" ${taken ? "disabled" : ""}>${t}</button></div>`;
      }).join("");
    };
    build(TIME_SLOTS.morning, "morningSlots");
    build(TIME_SLOTS.evening, "eveningSlots");
    selected = null;
    el("selectedSlot").value = "";
  }

  document.addEventListener("click", function (e) {
    const btn = e.target.closest(".slot-btn");
    if (!btn || btn.disabled) return;
    document.querySelectorAll(".slot-btn").forEach((b) => b.classList.remove("active"));
    btn.classList.add("active");
    selected = btn.dataset.time;
    el("selectedSlot").value = selected;
    el("slotAlert").classList.add("d-none");
  });

  el("bDate").addEventListener("change", renderSlots);
  renderSlots();

  el("bookingForm").addEventListener("submit", function (e) {
    this.classList.add("was-validated");
    if (!this.checkValidity()) {
      e.preventDefault();
      return;
    }
    if (!selected) {
      e.preventDefault();
      el("slotAlert").classList.remove("d-none");
      return;
    }

    // Modal show code (agar AJAX booking ho ya preview dikhana ho)
    el("summaryList").innerHTML = `
      <li class="list-group-item d-flex justify-content-between px-0"><span class="text-muted-legal">Lawyer</span><strong>{{ $lawyer->name }}</strong></li>
      <li class="list-group-item d-flex justify-content-between px-0"><span class="text-muted-legal">Specialization</span><strong>{{ $lawyer->specialization }}</strong></li>
      <li class="list-group-item d-flex justify-content-between px-0"><span class="text-muted-legal">Date</span><strong>${el("bDate").value}</strong></li>
      <li class="list-group-item d-flex justify-content-between px-0"><span class="text-muted-legal">Time</span><strong>${selected}</strong></li>
      <li class="list-group-item d-flex justify-content-between px-0"><span class="text-muted-legal">Meeting type</span><strong>${el("bMode").value}</strong></li>
      <li class="list-group-item d-flex justify-content-between px-0"><span class="text-muted-legal">Fee</span><strong>Rs. {{ number_format($lawyer->fee) }}</strong></li>`;
  });
});
</script>

@endsection
