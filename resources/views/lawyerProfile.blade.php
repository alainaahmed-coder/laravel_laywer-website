<section class="bg-navy py-4">
  <div class="container">
    <ol class="breadcrumb mb-0 small">
      <li class="breadcrumb-item"><a href="index.html" class="text-gold">Home</a></li>
      <li class="breadcrumb-item"><a href="lawyers.html" class="text-gold">Find Lawyers</a></li>
      <li class="breadcrumb-item active text-white-50" aria-current="page" id="crumbName">Profile</li>
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
            <img id="pImg" src="" alt="" class="avatar avatar-lg">
            <div>
              <h1 class="h3 mb-1" id="pName"></h1>
              <div class="rating mb-2" id="pRating"></div>
              <div class="d-flex flex-wrap gap-2" id="pTags"></div>
            </div>
          </div>

          <hr class="my-4">

          <h2 class="h6 text-uppercase text-muted-legal">About</h2>
          <p class="mb-4" id="pBio"></p>

          <h2 class="h6 text-uppercase text-muted-legal">Qualifications &amp; credentials</h2>
          <ul class="list-unstyled d-grid gap-2 mb-4" id="pQuals"></ul>

          <div class="row g-3">
            <div class="col-sm-6">
              <div class="p-3 bg-light-gray rounded-3">
                <small class="text-muted-legal d-block">Office address</small>
                <span class="fw-semibold" id="pAddress"></span>
              </div>
            </div>
            <div class="col-sm-6">
              <div class="p-3 bg-light-gray rounded-3">
                <small class="text-muted-legal d-block">Consultation fee</small>
                <span class="fw-semibold text-navy fs-5" id="pFee"></span>
              </div>
            </div>
          </div>
        </div>

        <!-- Reviews -->
        <div class="card-legal p-4 p-lg-5 mt-4">
          <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="h5 mb-0">Client reviews</h2>
            <span class="badge-gold" id="rSummary"></span>
          </div>
          <div class="d-grid gap-3" id="reviewList"></div>
        </div>
      </div>

      <!-- RIGHT COLUMN: BOOKING WIDGET -->
      <aside class="col-lg-5 col-xl-4">
        <div class="card-legal p-4 sticky-lg-top" style="top:88px">
          <h2 class="h5 mb-1">Book an appointment</h2>
          <p class="text-muted-legal small">Select a date, choose an available slot and confirm.</p>

          <form id="bookingForm" class="needs-validation" novalidate>
            <div class="mb-3">
              <label class="form-label small fw-semibold" for="bDate">Appointment date</label>
              <input type="date" class="form-control" id="bDate" required>
              <div class="invalid-feedback">Please choose a date.</div>
            </div>

            <ul class="nav nav-pills nav-pills-legal nav-fill gap-2 mb-3" role="tablist">
              <li class="nav-item" role="presentation">
                <button class="nav-link active" data-bs-toggle="pill" data-bs-target="#morningPane" type="button" role="tab"><i class="bi bi-sunrise me-1"></i>Morning</button>
              </li>
              <li class="nav-item" role="presentation">
                <button class="nav-link" data-bs-toggle="pill" data-bs-target="#eveningPane" type="button" role="tab"><i class="bi bi-sunset me-1"></i>Evening</button>
              </li>
            </ul>
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
              <select class="form-select" id="bMode" required>
                <option value="">Select meeting type</option>
                <option>Office Visit</option>
                <option>Video Call</option>
                <option>Phone Call</option>
                <option>Court Premises</option>
              </select>
              <div class="invalid-feedback">Please select a meeting type.</div>
            </div>

            <div class="mb-3">
              <label class="form-label small fw-semibold" for="bNotes">Case summary <span class="text-muted-legal fw-normal">(optional)</span></label>
              <textarea class="form-control" id="bNotes" rows="3" placeholder="Briefly describe your matter"></textarea>
            </div>

            <div class="alert alert-warning py-2 small d-none" id="slotAlert" role="alert">
              <i class="bi bi-exclamation-triangle me-1"></i> Please select an available time slot.
            </div>

            <div class="d-flex justify-content-between align-items-center bg-light-gray rounded-3 p-3 mb-3">
              <span class="small text-muted-legal">Total payable</span>
              <span class="fw-bold text-navy" id="bTotal"></span>
            </div>

            <button type="submit" class="btn btn-gold w-100 py-2"><i class="bi bi-calendar2-check me-1"></i> Confirm Booking</button>
            <p class="text-muted-legal small text-center mt-3 mb-0"><i class="bi bi-shield-lock me-1"></i>Free cancellation up to 12 hours before.</p>
          </form>
        </div>
      </aside>
    </div>
  </div>
</main>

<!-- Booking confirmation modal -->
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
        <a href="dashboard-customer.html" class="btn btn-navy w-100">Go to my appointments</a>
      </div>
    </div>
  </div>
</div>
