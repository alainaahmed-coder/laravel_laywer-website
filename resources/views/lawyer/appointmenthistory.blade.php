@extends('lawyer.sidebar')

@section('lawyer')

<div class="p-2 sm:p-4 bg-slate-50 min-vh-100 w-100">

    <!-- Main Card -->
    <div class="bg-white rounded-4 shadow-sm border-0 overflow-hidden w-100">

        <!-- Header -->
        <div class="p-4 text-white"
             style="background: #1e293b;">

            <div class="d-flex align-items-center justify-content-between flex-wrap gap-3">

                <div>
                    <h3 class="fw-bold mb-1 text-white">
                        🕒 Appointment History
                    </h3>

                    <p class="mb-0 text-white-50 small">
                        View your completed customer appointments.
                    </p>
                </div>

                <div>
                    <span class="badge rounded-pill px-3 py-2"
                          style="background: rgba(34,197,94,.15);
                                 color: #22c55e;
                                 border: 1px solid rgba(34,197,94,.4);">

                        ✓ {{ isset($appointments) ? $appointments->count() : 0 }}
                        Completed
                    </span>
                </div>

            </div>
        </div>

        <!-- Table -->
        <div class="table-responsive">

            <table class="table table-hover align-middle mb-0">

                <thead style="background:#f8fafc;">
                    <tr class="text-uppercase small text-secondary fw-bold">

                        <th class="px-4 py-3">
                            Client
                        </th>

                        <th class="py-3">
                            Email
                        </th>

                        <th class="py-3 text-center">
                            Date
                        </th>

                        <th class="py-3 text-center">
                            Time
                        </th>

                        <th class="py-3 text-center">
                            Status
                        </th>

                    </tr>
                </thead>

                <tbody>

                    @forelse($appointments ?? [] as $appointment)

                        <tr>

                            <!-- Client -->
                            <td class="px-4 py-3">

                                <div class="d-flex align-items-center gap-3">

                                    <div class="rounded-circle d-flex align-items-center justify-content-center flex-shrink-0"
                                         style="
                                            width:42px;
                                            height:42px;
                                            background:#1e293b;
                                            color:#f59e0b;
                                            font-size:18px;
                                         ">
                                        👤
                                    </div>

                                    <div>
                                        <div class="fw-bold text-dark">
                                            {{ optional($appointment->customer)->name ?? 'Client' }}
                                        </div>

                                        <small class="text-secondary">
                                            Customer
                                        </small>
                                    </div>

                                </div>

                            </td>

                            <!-- Email -->
                            <td class="py-3">

                                <span class="text-secondary small">
                                    {{ optional($appointment->customer)->email ?? 'N/A' }}
                                </span>

                            </td>

                            <!-- Date -->
                            <td class="py-3 text-center">

                                <span class="fw-semibold text-dark small">
                                    📅
                                    {{ \Carbon\Carbon::parse($appointment->appointment_date)->format('d M, Y') }}
                                </span>

                            </td>

                            <!-- Time -->
                            <td class="py-3 text-center">

                                <span class="badge rounded-pill px-3 py-2"
                                      style="
                                        background:#eef2ff;
                                        color:#4f46e5;
                                        border:1px solid #c7d2fe;
                                      ">

                                    🕒 {{ $appointment->appointment_time }}

                                </span>

                            </td>

                            <!-- Status -->
                            <td class="py-3 text-center">

                                <span class="badge rounded-pill px-3 py-2"
                                      style="
                                        background:#ecfdf5;
                                        color:#16a34a;
                                        border:1px solid #bbf7d0;
                                      ">

                                    ✓ Completed

                                </span>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="5"
                                class="text-center py-5">

                                <div class="mb-2"
                                     style="font-size:40px;">
                                    📭
                                </div>

                                <h6 class="fw-bold text-dark mb-1">
                                    No Completed Appointments
                                </h6>

                                <p class="text-secondary small mb-0">
                                    You don't have any completed customer appointments yet.
                                </p>

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

@endsection
