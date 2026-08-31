@extends('customer.sidebar')

@section('customer')
<div class="container-fluid py-4">

    {{-- Welcome Header --}}
    <div class="d-flex align-items-center justify-content-between mb-4">
        <div>
            <h3 class="fw-bold mb-1">Dashboard Overview</h3>
            <p class="text-muted mb-0">Welcome back, <strong>{{ Auth::user()->name }}</strong>! Here is your appointment summary.</p>
        </div>
        <div>
            <a href="{{ route('customer.find.lawyer') }}" class="btn btn-primary shadow-sm">
                <i class="bi bi-search me-1"></i> Find & Book Lawyer
            </a>
        </div>
    </div>

    {{-- Analytics Cards Section --}}
    <div class="row g-3 mb-4">

        {{-- Total Appointments --}}
        <div class="col-12 col-sm-6 col-xl-4">
            <div class="card border-0 shadow-sm rounded-3 h-100 border-start border-4 border-primary">
                <div class="card-body d-flex align-items-center justify-content-between">
                    <div>
                        <span class="text-muted text-uppercase fw-semibold small">Total Bookings</span>
                        <h2 class="fw-bold my-1 text-dark">{{ $totalAppointments }}</h2>
                        <span class="badge bg-primary-subtle text-primary fw-medium">All Time</span>
                    </div>
                    <div class="rounded-circle bg-primary bg-opacity-10 p-3 text-primary fs-3">
                        <i class="bi bi-calendar-event"></i>
                    </div>
                </div>
            </div>
        </div>

        {{-- Pending Appointments --}}
        <div class="col-12 col-sm-6 col-xl-4">
            <div class="card border-0 shadow-sm rounded-3 h-100 border-start border-4 border-warning">
                <div class="card-body d-flex align-items-center justify-content-between">
                    <div>
                        <span class="text-muted text-uppercase fw-semibold small">Pending Approval</span>
                        <h2 class="fw-bold my-1 text-dark">{{ $pendingAppointments }}</h2>
                        <span class="badge bg-warning-subtle text-warning fw-medium">Awaiting response</span>
                    </div>
                    <div class="rounded-circle bg-warning bg-opacity-10 p-3 text-warning fs-3">
                        <i class="bi bi-hourglass-split"></i>
                    </div>
                </div>
            </div>
        </div>

        {{-- Approved / Confirmed Appointments --}}
        <div class="col-12 col-sm-6 col-xl-4">
            <div class="card border-0 shadow-sm rounded-3 h-100 border-start border-4 border-info">
                <div class="card-body d-flex align-items-center justify-content-between">
                    <div>
                        <span class="text-muted text-uppercase fw-semibold small">Confirmed Sessions</span>
                        <h2 class="fw-bold my-1 text-dark">{{ $approvedAppointments }}</h2>
                        <span class="badge bg-info-subtle text-info fw-medium">Scheduled</span>
                    </div>
                    <div class="rounded-circle bg-info bg-opacity-10 p-3 text-info fs-3">
                        <i class="bi bi-calendar-check"></i>
                    </div>
                </div>
            </div>
        </div>

        {{-- Completed Appointments --}}
        <div class="col-12 col-sm-6 col-xl-4">
            <div class="card border-0 shadow-sm rounded-3 h-100 border-start border-4 border-success">
                <div class="card-body d-flex align-items-center justify-content-between">
                    <div>
                        <span class="text-muted text-uppercase fw-semibold small">Completed Sessions</span>
                        <h2 class="fw-bold my-1 text-dark">{{ $completedAppointments }}</h2>
                        <span class="badge bg-success-subtle text-success fw-medium">Finished</span>
                    </div>
                    <div class="rounded-circle bg-success bg-opacity-10 p-3 text-success fs-3">
                        <i class="bi bi-check-circle-fill"></i>
                    </div>
                </div>
            </div>
        </div>

        {{-- Cancelled Appointments --}}
        <div class="col-12 col-sm-6 col-xl-4">
            <div class="card border-0 shadow-sm rounded-3 h-100 border-start border-4 border-danger">
                <div class="card-body d-flex align-items-center justify-content-between">
                    <div>
                        <span class="text-muted text-uppercase fw-semibold small">Cancelled</span>
                        <h2 class="fw-bold my-1 text-dark">{{ $cancelledAppointments }}</h2>
                        <span class="badge bg-danger-subtle text-danger fw-medium">Rejected / Cancelled</span>
                    </div>
                    <div class="rounded-circle bg-danger bg-opacity-10 p-3 text-danger fs-3">
                        <i class="bi bi-x-circle"></i>
                    </div>
                </div>
            </div>
        </div>

    </div>

    {{-- Recent Appointments Dynamic Table --}}
    <div class="card border-0 shadow-sm rounded-3">
        <div class="card-header bg-white py-3 d-flex align-items-center justify-content-between border-bottom-0">
            <h5 class="fw-bold mb-0 text-dark">Recent Appointments</h5>
          <a href="{{ route('customer.myappointments') }}" class="btn btn-sm btn-light border">
                View All <i class="bi bi-arrow-right ms-1"></i>
            </a>
        </div>
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th scope="col" class="ps-3">#ID</th>
                        <th scope="col">Lawyer Name</th>
                        <th scope="col">Date</th>
                        <th scope="col">Time Slot</th>
                        <th scope="col">Status</th>
                        <th scope="col" class="text-end pe-3">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($recentAppointments as $appointment)
                        <tr>
                            <td class="ps-3 fw-semibold">#{{ $appointment->id }}</td>
                            <td>
                                <div class="d-flex align-items-center">
                                    @if(optional(optional($appointment->lawyer)->user)->profile_picture)
                                        <img src="{{ asset('uploads/profile/' . $appointment->lawyer->user->profile_picture) }}"
                                             class="rounded-circle me-2"
                                             width="36" height="36"
                                             style="object-fit: cover;" alt="Lawyer Avatar">
                                    @else
                                        <div class="rounded-circle bg-secondary text-white d-flex align-items-center justify-content-center me-2"
                                             style="width: 36px; height: 36px; font-size: 14px;">
                                            {{ strtoupper(substr(optional(optional($appointment->lawyer)->user)->name ?? 'L', 0, 1)) }}
                                        </div>
                                    @endif
                                    <span>{{ optional(optional($appointment->lawyer)->user)->name ?? 'N/A' }}</span>
                                </div>
                            </td>
                            <td>{{ \Carbon\Carbon::parse($appointment->appointment_date)->format('M d, Y') }}</td>
                            <td>{{ $appointment->appointment_time }}</td>
                            <td>
                                @if($appointment->status == 'pending')
                                    <span class="badge bg-warning text-dark px-2 py-1">Pending</span>
                                @elseif($appointment->status == 'approved')
                                    <span class="badge bg-info px-2 py-1">Approved</span>
                                @elseif($appointment->status == 'completed')
                                    <span class="badge bg-success px-2 py-1">Completed</span>
                                @elseif($appointment->status == 'cancelled')
                                    <span class="badge bg-danger px-2 py-1">Cancelled</span>
                                @else
                                    <span class="badge bg-secondary px-2 py-1">{{ ucfirst($appointment->status) }}</span>
                                @endif
                            </td>
                            <td class="text-end pe-3">
                               <a href="{{ route('customer.myappointments') }}" class="btn btn-sm btn-light border">
                                    Details
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-4 text-muted">
                                <i class="bi bi-calendar-x fs-2 d-block mb-2"></i>
                                No recent appointments found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection
