@extends('lawyer.sidebar')


@section('laywer')


    <main class="col-lg-9 col-xl-10">

      <!-- OVERVIEW -->
      <section data-pane="overview">
        <h1 class="h4 mb-1">Welcome back, Hamza</h1>
        <p class="text-muted-legal">Here is what's happening with your legal matters.</p>

        <div class="row g-3 mb-4">
          <div class="col-6 col-xl-3"><div class="card-legal stat-card p-3"><small class="text-muted-legal">Active appointments</small><div class="stat-value">2</div></div></div>
          <div class="col-6 col-xl-3"><div class="card-legal stat-card p-3"><small class="text-muted-legal">Completed</small><div class="stat-value">7</div></div></div>
          <div class="col-6 col-xl-3"><div class="card-legal stat-card p-3"><small class="text-muted-legal">Lawyers consulted</small><div class="stat-value">4</div></div></div>
          <div class="col-6 col-xl-3"><div class="card-legal stat-card p-3"><small class="text-muted-legal">Total spent</small><div class="stat-value">28k</div></div></div>
        </div>

        <div class="row g-4">
          <div class="col-xl-7">
            <div class="card-legal p-4 h-100">
              <h2 class="h6 text-uppercase text-muted-legal">Upcoming appointment</h2>
              <div class="d-flex flex-column flex-sm-row gap-3 align-items-sm-center mt-3">
                <img src="https://i.pravatar.cc/240?img=12" class="avatar" alt="Adv. Bilal Ahmed Khan">
                <div class="flex-grow-1">
                  <h3 class="h6 mb-1">Adv. Bilal Ahmed Khan</h3>
                  <div class="d-flex flex-wrap gap-2 mb-2">
                    <span class="badge-spec small">Criminal Law</span>
                    <span class="badge-gold small">Office Visit</span>
                  </div>
                  <p class="small text-muted-legal mb-0"><i class="bi bi-calendar2 me-1"></i>24 Aug 2026 · 10:30 AM · Justice Plaza, Karachi</p>
                </div>
                <div class="d-grid gap-2">
                  <button class="btn btn-navy btn-sm">Reschedule</button>
                  <button class="btn btn-outline-navy btn-sm" data-bs-toggle="modal" data-bs-target="#cancelModal">Cancel</button>
                </div>
              </div>
              <div class="alert alert-warning small mt-4 mb-0"><i class="bi bi-info-circle me-1"></i>Bring your CNIC and any prior case documents to the meeting.</div>
            </div>
          </div>
          <div class="col-xl-5">
            <div class="card-legal p-4 h-100">
              <h2 class="h6 text-uppercase text-muted-legal mb-3">Recent consultations</h2>
              <div class="d-grid gap-3" id="recentList"></div>
            </div>
          </div>
        </div>
      </section>

    
    </main>
  </div>
</div>

<div class="modal fade" id="cancelModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content border-0 rounded-4">
      <div class="modal-header border-0"><h2 class="h5 modal-title">Cancel appointment?</h2><button class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button></div>
      <div class="modal-body pt-0 text-muted-legal">Cancelling within 12 hours of the slot may incur a fee. Are you sure you want to cancel your appointment with Adv. Bilal Ahmed Khan?</div>
      <div class="modal-footer border-0">
        <button class="btn btn-outline-navy" data-bs-dismiss="modal">Keep appointment</button>
        <button class="btn btn-danger" data-bs-dismiss="modal">Yes, cancel</button>
      </div>
    </div>
  </div>
</div>

@endsection
