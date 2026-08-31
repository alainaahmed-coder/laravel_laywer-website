@extends('customer.sidebar')

@section('customer')
<div class="container-fluid py-4">

    {{-- Page Header --}}
    <div class="d-flex align-items-center justify-content-between mb-4">
        <div>
            <h3 class="fw-bold mb-1">Appointment History</h3>
            <p class="text-muted mb-0">View all your completed and cancelled past appointments.</p>
        </div>
    </div>

    {{-- History Table Card --}}
    <div class="card border-0 shadow-sm rounded-3">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th scope="col" class="ps-3">#ID</th>
                            <th scope="col">Lawyer Name</th>
                            <th scope="col">Date</th>
                            <th scope="col">Time Slot</th>
                            <th scope="col">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($appointments as $appointment)
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
                                    @if($appointment->status == 'completed')
                                        <span class="badge bg-success-subtle text-success border border-success px-3 py-1 rounded-pill">Completed</span>
                                    @elseif($appointment->status == 'cancelled')
                                        <span class="badge bg-danger-subtle text-danger border border-danger px-3 py-1 rounded-pill">Cancelled</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-4 text-muted">
                                    <i class="bi bi-clock-history fs-2 d-block mb-2"></i>
                                    No appointment history found.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Pagination links --}}
        @if($appointments->hasPages())
            <div class="card-footer bg-white border-0 py-3">
                {{ $appointments->links() }}
            </div>
        @endif
    </div>

</div>
@endsection
