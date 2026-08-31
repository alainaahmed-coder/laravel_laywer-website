@extends('lawyer.sidebar')

@section('laywer')
<div class="w-100 overflow-hidden py-3">

    <!-- Card Wrapper -->
    <div class="card-legal shadow-sm border-0 rounded-4 overflow-hidden w-100 bg-white">

        <!-- Dark Header Block -->
        <div class="bg-navy p-4 text-white d-flex align-items-center justify-content-between flex-wrap gap-3">
            <div>
                <h3 class="h5 fw-bold mb-1 text-white d-flex align-items-center gap-2">
                    <span>🕒</span> Appointment History
                </h3>
                <p class="text-white-50 small mb-0">View your completed customer appointments.</p>
            </div>
            <div>
                <span class="badge bg-success bg-opacity-20 text-success border border-success px-3 py-2 rounded-pill">
                    ✓ {{ isset($appointments) ? $appointments->count() : 0 }} Completed
                </span>
            </div>
        </div>

        <!-- Table Container without Scroll -->
        <div class="w-100 overflow-hidden">
            <table class="table table-hover align-middle mb-0 w-100" style="table-layout: fixed;">
                <thead class="bg-light">
                    <tr class="text-uppercase small text-muted fw-bold border-bottom">
                        <th style="width: 8%;" class="ps-3 py-3">ID</th>
                        <th style="width: 27%;" class="py-3">Client</th>
                        <th style="width: 30%;" class="py-3">Email</th>
                        <th style="width: 15%;" class="py-3">Date</th>
                        <th style="width: 10%;" class="py-3">Time</th>
                        <th style="width: 10%;" class="py-3 text-end pe-3">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($appointments ?? [] as $appointment)
                        <tr>
                            <td class="ps-3 fw-bold text-muted">#{{ $appointment->id }}</td>
                            <td>
                                <div class="d-flex align-items-center gap-2">
                                    <div class="bg-dark text-warning rounded-circle d-flex align-items-center justify-content-center flex-shrink-0" style="width: 35px; height: 35px;">
                                        👤
                                    </div>
                                    <div class="lh-sm">
                                        <div class="fw-bold text-dark">{{ optional($appointment->customer)->name ?? 'Client' }}</div>
                                        <small class="text-muted">Completed Client</small>
                                    </div>
                                </div>
                            </td>
                            <td class="text-muted small text-break">{{ optional($appointment->customer)->email ?? 'N/A' }}</td>
                            <td>
                                <div class="fw-semibold text-dark small">
                                    📅 {{ \Carbon\Carbon::parse($appointment->appointment_date)->format('d M, Y') }}
                                </div>
                            </td>
                            <td>
                                <span class="badge bg-primary-subtle text-primary border border-primary-subtle px-2 py-1 small">
                                    🕒 {{ $appointment->appointment_time }}
                                </span>
                            </td>
                            <td class="text-end pe-3">
                                <span class="badge bg-success-subtle text-success border border-success-subtle rounded-pill px-3 py-1">
                                    ✓ Completed
                                </span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted py-4">No completed appointments found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </div>

</div>
@endsection
