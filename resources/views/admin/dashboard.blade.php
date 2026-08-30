@extends('admin.sidebar')
@section('admin')
<main class="col-lg-12 col-xl-12">
  <section data-pane="overview">
    <h1 class="h4 mb-1">Platform dashboard</h1>
    <p class="text-muted-legal">System-wide activity for August 2026.</p>
    <div class="row g-3 mb-4">
      <div class="col-6 col-xl-3">
        <div class="card-legal stat-card p-3"><small class="text-muted-legal">Total lawyers</small>
          <div class="stat-value">{{$lawyers}}</div>
        </div>
      </div>
      <div class="col-6 col-xl-3">
        <div class="card-legal stat-card p-3"><small class="text-muted-legal">Total customers</small>
          <div class="stat-value">{{$Customers}}</div>
        </div>
      </div>
      <div class="col-6 col-xl-3">
        <div class="card-legal stat-card p-3"><small class="text-muted-legal">Total Cities</small>
          <div class="stat-value text-warning">{{$totleCities}}</div>
        </div>
      </div>
      <div class="col-6 col-xl-3">
        <div class="card-legal stat-card p-3"><small class="text-muted-legal">Complete Appointments</small>
          <div class="stat-value">3,486</div>
        </div>
      </div>
    </div>
    
    {{-- Latest Appointment Activity --}}
    <div class="row g-4">

      <div class="col-xl-12">

        <div class="card-legal p-3 h-100">

          {{-- Header --}}
          <div class="d-flex justify-content-between align-items-center mb-3">

            <div>
              <h2 class="h6 text-uppercase text-muted-legal mb-1">
                Latest Appointment Activity
              </h2>

              <p class="text-muted small mb-0">
                Recent approved and rejected appointments
              </p>
            </div>

            <a href="{{ route('admin.appointments') }}"
              class="btn btn-sm btn-navy px-3 rounded-3">
              View All
            </a>

          </div>


          {{-- Table --}}
          <div class="latest-appointments">

            <div class="table-responsive">

              <table>

                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Customer</th>
                    <th>Lawyer</th>
                    <th>Date</th>
                    <th>Time</th>
                    <th>Type</th>
                    <th>Case</th>
                    <th class="text-center">Status</th>
                  </tr>
                </thead>

                <tbody>

                  @forelse($appoinmnets as $appointment)

                  <tr>

                    <td>
                      <span class="appointment-id">
                        #{{ $appointment->id }}
                      </span>
                    </td>

                    <td>
                      <span class="customer-dot"></span>
                      <span class="customer-name">
                        {{ $appointment->customer->name ?? 'N/A' }}
                      </span>
                    </td>

                    <td>
                      <span class="lawyer-dot"></span>
                      <span class="lawyer-name">
                        {{ $appointment->lawyer->user->name ?? 'N/A' }}
                      </span>
                    </td>

                    <td>
                      {{ $appointment->appointment_date
                                ? $appointment->appointment_date->format('d M, Y')
                                : 'N/A' }}
                    </td>

                    <td>
                      {{ $appointment->appointment_time
                                ? \Carbon\Carbon::parse($appointment->appointment_time)->format('h:i A')
                                : 'N/A' }}
                    </td>

                    <td>
                      <span class="meeting-type">
                        {{ ucfirst($appointment->meeting_type ?? 'N/A') }}
                      </span>
                    </td>

                    <td>
                      {{ Str::limit($appointment->case_summary ?? 'N/A', 25) }}
                    </td>

                    <td class="text-center">

                      @if($appointment->status === 'approved')

                      <span class="status-approved">
                        <span class="status-dot"></span>
                        Approved
                      </span>

                      @elseif($appointment->status === 'pending')

                      <span class="status-rejected">
                        <span class="status-dot"></span>
                        Pending
                      </span>

                      @endif

                    </td>

                  </tr>

                  @empty

                  <tr>
                    <td colspan="8" class="text-center py-4">
                      No appointment activity found.
                    </td>
                  </tr>

                  @endforelse

                </tbody>

              </table>

            </div>

          </div>
        </div>

      </div>

    </div>
  

  </section>

  {{-- <section data-pane="approvals" class="d-none">
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



 --}}


  @endsection