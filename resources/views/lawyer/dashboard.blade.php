@extends('lawyer.sidebar')

@section('laywer')

<div class="w-100">

  <!-- OVERVIEW HEADER -->
  <div class="mb-4">
    <h1 class="h4 mb-1 text-navy">Welcome back, {{ auth()->user()->name }}</h1>
    <p class="text-muted-legal">Here is what's happening with your appointments and clients.</p>
  </div>

  <!-- SIMPLE STATS CARDS -->
  <div class="row g-3 mb-4">
    <div class="col-6 col-xl-3">
      <div class="card-legal stat-card p-3 shadow-sm border-0 rounded-3">
        <small class="text-muted-legal fw-semibold">Pending Requests</small>
        <div class="stat-value fs-3 fw-bold text-warning">{{ $pendingAppointments ?? 0 }}</div>
      </div>
    </div>
    <div class="col-6 col-xl-3">
      <div class="card-legal stat-card p-3 shadow-sm border-0 rounded-3">
        <small class="text-muted-legal fw-semibold">Approved / Active</small>
        <div class="stat-value fs-3 fw-bold text-primary">{{ $approvedAppointments ?? 0 }}</div>
      </div>
    </div>
    <div class="col-6 col-xl-3">
      <div class="card-legal stat-card p-3 shadow-sm border-0 rounded-3">
        <small class="text-muted-legal fw-semibold">Completed</small>
        <div class="stat-value fs-3 fw-bold text-success">{{ $completedAppointments ?? 0 }}</div>
      </div>
    </div>
    <div class="col-6 col-xl-3">
      <div class="card-legal stat-card p-3 shadow-sm border-0 rounded-3">
        <small class="text-muted-legal fw-semibold">Total Clients</small>
        <div class="stat-value fs-3 fw-bold text-navy">{{ $totalClients ?? 0 }}</div>
      </div>
    </div>
  </div>

  <!-- RECENT APPOINTMENTS TABLE -->
  <div class="card-legal p-4 shadow-sm border-0 rounded-4 bg-white">
    <div class="d-flex align-items-center justify-content-between mb-3">
      <h2 class="h6 text-uppercase text-muted-legal mb-0 fw-bold">Recent Appointments</h2>
      <a href="{{ route('lawyer.appointment.history') }}" class="btn btn-sm btn-link text-decoration-none">View All</a>
    </div>

    <div class="table-responsive">
      <table class="table table-hover align-middle mb-0">
        <thead class="table-light">
          <tr>
            <th>Client Name</th>
            <th>Date & Time</th>
            <th>Status</th>
          </tr>
        </thead>
        <tbody>
          @forelse($recentAppointments as $appointment)
            <tr>
              <td class="fw-semibold">{{ $appointment->user->name ?? 'Client' }}</td>
              <td>
                <div>{{ \Carbon\Carbon::parse($appointment->appointment_date ?? now())->format('d M Y') }}</div>
                <small class="text-muted">{{ $appointment->appointment_time ?? '' }}</small>
              </td>
              <td>
                @if(($appointment->status ?? 'pending') == 'approved')
                  <span class="badge bg-success-subtle text-success border border-success-subtle rounded-pill px-3">Approved</span>
                @elseif(($appointment->status ?? 'pending') == 'pending')
                  <span class="badge bg-warning-subtle text-warning border border-warning-subtle rounded-pill px-3">Pending</span>
                @else
                  <span class="badge bg-secondary-subtle text-secondary border border-secondary-subtle rounded-pill px-3">{{ ucfirst($appointment->status ?? 'Completed') }}</span>
                @endif
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="3" class="text-center text-muted py-4">No recent appointments found.</td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>

</div>

@endsection
