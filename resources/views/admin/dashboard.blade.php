@extends('admin.sidebar')
@section('admin')
    <main class="col-lg-9 col-xl-10">
      <section data-pane="overview">
        <h1 class="h4 mb-1">Platform dashboard</h1>
        <p class="text-muted-legal">System-wide activity for August 2026.</p>
        <div class="row g-3 mb-4">
          <div class="col-6 col-xl-3"><div class="card-legal stat-card p-3"><small class="text-muted-legal">Total lawyers</small><div class="stat-value">1,214</div></div></div>
          <div class="col-6 col-xl-3"><div class="card-legal stat-card p-3"><small class="text-muted-legal">Total customers</small><div class="stat-value">18,930</div></div></div>
          <div class="col-6 col-xl-3"><div class="card-legal stat-card p-3"><small class="text-muted-legal">Pending approvals</small><div class="stat-value text-warning">27</div></div></div>
          <div class="col-6 col-xl-3"><div class="card-legal stat-card p-3"><small class="text-muted-legal">Appointments (30d)</small><div class="stat-value">3,486</div></div></div>
        </div>
        <div class="row g-4">
          <div class="col-xl-7"><div class="card-legal p-4 h-100">
            <h2 class="h6 text-uppercase text-muted-legal mb-3">Latest appointment activity</h2>
            <div class="d-grid gap-3" id="activityList"></div>
          </div></div>
          <div class="col-xl-5"><div class="card-legal p-4 h-100">
            <h2 class="h6 text-uppercase text-muted-legal mb-3">Bookings by practice area</h2>
            <div class="d-grid gap-3" id="areaBars"></div>
          </div></div>
        </div>
      </section>

      <section data-pane="approvals" class="d-none">
        <h1 class="h4 mb-3">Approve / reject lawyer profiles</h1>
        <div class="row g-4" id="approvalCards"></div>
      </section>

      <section data-pane="lawyers" class="d-none">
        <div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-3">
          <h1 class="h4 mb-0">Manage lawyers</h1>
          <input class="form-control w-auto" id="lawyerSearch" type="search" placeholder="Search lawyers">
        </div>
        <div class="card-legal p-0 overflow-hidden">
          <div class="table-responsive">
            <table class="table table-legal align-middle mb-0">
              <thead><tr><th>Lawyer</th><th>Specialization</th><th>City</th><th>Fee</th><th>Rating</th><th>Status</th><th></th></tr></thead>
              <tbody id="lawyerRows"></tbody>
            </table>
          </div>
        </div>
      </section>

      <section data-pane="customers" class="d-none">
        <h1 class="h4 mb-3">Manage customers</h1>
        <div class="card-legal p-0 overflow-hidden">
          <div class="table-responsive">
            <table class="table table-legal align-middle mb-0">
              <thead><tr><th>Name</th><th>Email</th><th>City</th><th>Bookings</th><th>Status</th><th></th></tr></thead>
              <tbody id="customerRows"></tbody>
            </table>
          </div>
        </div>
      </section>

      <section data-pane="logs" class="d-none">
        <div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-3">
          <h1 class="h4 mb-0">System-wide appointment logs</h1>
          <select class="form-select w-auto" id="logFilter">
            <option value="">All statuses</option>
            <option>Pending</option><option>Approved</option><option>Completed</option><option>Cancelled</option>
          </select>
        </div>
        <div class="card-legal p-0 overflow-hidden">
          <div class="table-responsive">
            <table class="table table-legal align-middle mb-0">
              <thead><tr><th>Ref</th><th>Client</th><th>Lawyer</th><th>Date</th><th>Mode</th><th>Fee</th><th>Status</th></tr></thead>
              <tbody id="logRows"></tbody>
            </table>
          </div>
        </div>
      </section>

      <section data-pane="areas" class="d-none">
        <div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-3">
          <h1 class="h4 mb-0">Manage practice areas</h1>
          <button class="btn btn-gold btn-sm" data-bs-toggle="modal" data-bs-target="#areaModal"><i class="bi bi-plus-lg me-1"></i>Add practice area</button>
        </div>
        <div class="row g-3" id="areaCards"></div>
      </section>

      <section data-pane="content" class="d-none">
        <h1 class="h4 mb-3">Manage homepage content</h1>
        <div class="card-legal p-4 p-lg-5">
          <form class="needs-validation row g-3" novalidate>
            <div class="alert alert-success d-none" data-role="form-alert">Homepage content published.</div>
            <div class="col-12"><label class="form-label small fw-semibold" for="cHead">Hero heading</label><input class="form-control" id="cHead" value="Find &amp; Book Top Legal Experts Instantly" required></div>
            <div class="col-12"><label class="form-label small fw-semibold" for="cSub">Hero subheadline</label><textarea class="form-control" id="cSub" rows="2">Compare verified lawyers by specialization, city, experience and consultation fee.</textarea></div>
            <div class="col-md-6"><label class="form-label small fw-semibold" for="cCta">Primary CTA label</label><input class="form-control" id="cCta" value="Search"></div>
            <div class="col-md-6"><label class="form-label small fw-semibold" for="cFeatured">Featured lawyers shown</label><input type="number" class="form-control" id="cFeatured" value="6" min="3" max="12"></div>
            <div class="col-12"><button class="btn btn-navy px-4" type="submit">Publish changes</button></div>
          </form>
        </div>
      </section>

    </main>
  </div>
</div>

<div class="modal fade" id="areaModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content border-0 rounded-4">
      <div class="modal-header border-0"><h2 class="h5 modal-title">Add practice area</h2><button class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button></div>
      <div class="modal-body pt-0">
        <label class="form-label small fw-semibold" for="newArea">Area name</label>
        <input class="form-control" id="newArea" placeholder="e.g. Immigration Law">
      </div>
      <div class="modal-footer border-0">
        <button class="btn btn-outline-navy" data-bs-dismiss="modal">Cancel</button>
        <button class="btn btn-gold" id="addArea" data-bs-dismiss="modal">Add area</button>
      </div>
    </div>
 





@endsection
