@extends('customer.sidebar')

@section('customer')
<div class="container-fluid py-4">
    <!-- Page Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="fw-bold text-dark mb-1">My Appointments</h3>
            <p class="text-muted small mb-0">Check the status of your booked legal appointments.</p>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Appointments Table -->
    <div class="card border-0 shadow-sm rounded-3">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light">
                        <tr class="text-secondary small text-uppercase">
                            <th class="ps-4">#ID</th>
                            <th>Lawyer ID</th>
                            <th>Date & Time</th>
                            <th>Meeting Type</th>
                            <th>Case Summary</th>
                            <th class="text-center">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($appointments as $appointment)
                            <tr>
                                <td class="ps-4 fw-bold text-primary">#{{ $appointment->id }}</td>
                                <td>
                                    <h6 class="mb-0 fw-semibold text-dark">
                                        {{ $appointment->lawyer->name ?? 'Lawyer #'.$appointment->lawyer_id }}
                                    </h6>
                                </td>
                                <td>
                                    <div class="fw-semibold text-dark">
                                        {{ \Carbon\Carbon::parse($appointment->appointment_date)->format('M d, Y') }}
                                    </div>
                                    <small class="text-muted">
                                        {{ \Carbon\Carbon::parse($appointment->appointment_time)->format('h:i A') }}
                                    </small>
                                </td>
                                <td>
                                    <span class="badge bg-light text-dark border px-3 py-2 rounded-2">
                                        {{ ucfirst($appointment->meeting_type) }}
                                    </span>
                                </td>
                                <td>
                                    <span class="text-truncate d-inline-block text-secondary" style="max-width: 200px;" title="{{ $appointment->case_summary }}">
                                        {{ $appointment->case_summary ?? 'N/A' }}
                                    </span>
                                </td>
                                <td class="text-center">
                                    @if($appointment->status == 'pending')
                                        <span class="badge bg-warning text-dark px-3 py-2 rounded-pill">Pending</span>
                                    @elseif($appointment->status == 'approved')
                                        <span class="badge bg-success px-3 py-2 rounded-pill">Approved</span>
                                    @elseif($appointment->status == 'rejected')
                                        <span class="badge bg-danger px-3 py-2 rounded-pill">Rejected</span>
                                    @else
                                        <span class="badge bg-secondary px-3 py-2 rounded-pill">{{ ucfirst($appointment->status) }}</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-5 text-muted">
                                    <h6 class="fw-semibold text-dark">No Appointments Found</h6>
                                    <p class="text-muted small mb-0">You haven't booked any appointments yet.</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
