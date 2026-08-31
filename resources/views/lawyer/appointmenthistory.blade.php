@extends('lawyer.sidebar')

@section('laywer')

<div class="col-lg-9 col-xl-10">

    <div class="container-fluid py-4">

        {{-- ================= TABLE CARD ================= --}}
        <div class="card border-0 shadow-sm rounded-4 overflow-hidden">

            {{-- ================= CARD HEADER ================= --}}
            <div class="px-4 py-4"
                 style="background:#0f172a;">

                <div class="d-flex flex-wrap justify-content-between align-items-center gap-3">

                    <div>

                        <h4 class="fw-bold mb-1"
                            style="color:#ffffff;">

                            <i class="bi bi-clock-history me-2"
                               style="color:#fbbf24;">
                            </i>

                            Appointment History

                        </h4>

                        <p class="mb-0 small"
                           style="color:#cbd5e1;">

                            View your completed customer appointments.

                        </p>

                    </div>


                    {{-- COMPLETED COUNT --}}
                    <div class="d-flex align-items-center gap-2 px-3 py-2 rounded-3"
                         style="
                            background:#1e293b;
                            color:#ffffff;
                            border:1px solid #334155;
                         ">

                        <i class="bi bi-check-circle-fill"
                           style="color:#34d399;">
                        </i>

                        <span class="fw-bold small">

                            {{ $history->count() }} Completed

                        </span>

                    </div>

                </div>

            </div>


            {{-- ================= SUCCESS MESSAGE ================= --}}
            @if(session('success'))

                <div class="px-4 pt-4">

                    <div class="alert alert-success border-0 shadow-sm rounded-3 mb-0">

                        <i class="bi bi-check-circle-fill me-2"></i>

                        {{ session('success') }}

                    </div>

                </div>

            @endif


            {{-- ================= TABLE ================= --}}
            <div class="table-responsive">

                <table class="table align-middle mb-0">

                    {{-- ================= TABLE HEAD ================= --}}
                    <thead>

                        <tr style="
                            background-color:#0f172a !important;
                            color:#ffffff !important;
                        ">

                            <th class="px-4 py-3"
                                style="
                                    background-color:#0f172a !important;
                                    color:#ffffff !important;
                                    border-color:#1e293b !important;
                                ">

                                ID

                            </th>


                            <th class="px-4 py-3"
                                style="
                                    background-color:#0f172a !important;
                                    color:#ffffff !important;
                                    border-color:#1e293b !important;
                                ">

                                Client

                            </th>


                            <th class="px-4 py-3"
                                style="
                                    background-color:#0f172a !important;
                                    color:#ffffff !important;
                                    border-color:#1e293b !important;
                                ">

                                Email

                            </th>


                            <th class="px-4 py-3"
                                style="
                                    background-color:#0f172a !important;
                                    color:#ffffff !important;
                                    border-color:#1e293b !important;
                                ">

                                Date

                            </th>


                            <th class="px-4 py-3"
                                style="
                                    background-color:#0f172a !important;
                                    color:#ffffff !important;
                                    border-color:#1e293b !important;
                                ">

                                Time

                            </th>


                            <th class="px-4 py-3 text-center"
                                style="
                                    background-color:#0f172a !important;
                                    color:#ffffff !important;
                                    border-color:#1e293b !important;
                                ">

                                Status

                            </th>

                        </tr>

                    </thead>


                    {{-- ================= TABLE BODY ================= --}}
                    <tbody>

                        @forelse($history as $appointment)

                            <tr>

                                {{-- ID --}}
                                <td class="px-4 py-3">

                                    <span class="badge rounded-2 px-2 py-2"
                                          style="
                                            background:#f1f5f9;
                                            color:#334155;
                                          ">

                                        #{{ $appointment->id }}

                                    </span>

                                </td>


                                {{-- CLIENT --}}
                                <td class="px-4 py-3">

                                    <div class="d-flex align-items-center gap-3">

                                        {{-- CLIENT ICON --}}
                                        <div class="rounded-3 d-flex align-items-center justify-content-center"
                                             style="
                                                width:42px;
                                                height:42px;
                                                background:#0f172a;
                                                color:#fbbf24;
                                             ">

                                            <i class="bi bi-person-fill"></i>

                                        </div>


                                        {{-- CLIENT NAME --}}
                                        <div>

                                            <div class="fw-bold text-dark">

                                                {{ $appointment->customer->name ?? 'Unknown Client' }}

                                            </div>

                                            <small class="text-muted">

                                                Completed Client

                                            </small>

                                        </div>

                                    </div>

                                </td>


                                {{-- EMAIL --}}
                                <td class="px-4 py-3">

                                    <span class="text-muted small">

                                        {{ $appointment->customer->email ?? 'N/A' }}

                                    </span>

                                </td>


                                {{-- DATE --}}
                                <td class="px-4 py-3">

                                    <div class="d-flex align-items-center gap-2">

                                        <i class="bi bi-calendar3 text-primary"></i>

                                        <span class="fw-semibold small">

                                            {{ \Carbon\Carbon::parse($appointment->appointment_date)->format('d M, Y') }}

                                        </span>

                                    </div>

                                </td>


                                {{-- TIME --}}
                                <td class="px-4 py-3">

                                    <span class="badge rounded-2 px-2 py-2"
                                          style="
                                            background:#eef2ff;
                                            color:#4338ca;
                                          ">

                                        <i class="bi bi-clock me-1"></i>

                                        {{ \Carbon\Carbon::parse($appointment->appointment_time)->format('h:i A') }}

                                    </span>

                                </td>


                                {{-- STATUS --}}
                                <td class="px-4 py-3 text-center">

                                    <span class="badge rounded-pill px-3 py-2"
                                          style="
                                            background:#ecfdf5;
                                            color:#047857;
                                            border:1px solid #a7f3d0;
                                          ">

                                        <i class="bi bi-check-circle-fill me-1"></i>

                                        Completed

                                    </span>

                                </td>

                            </tr>

                        @empty

                            {{-- EMPTY STATE --}}
                            <tr>

                                <td colspan="6"
                                    class="text-center py-5">

                                    <div class="mb-3">

                                        <div class="mx-auto d-flex align-items-center justify-content-center rounded-4"
                                             style="
                                                width:70px;
                                                height:70px;
                                                background:#f1f5f9;
                                             ">

                                            <i class="bi bi-clock-history"
                                               style="
                                                font-size:32px;
                                                color:#94a3b8;
                                               ">
                                            </i>

                                        </div>

                                    </div>


                                    <h6 class="fw-bold text-dark mb-1">

                                        No Completed Appointments

                                    </h6>


                                    <p class="text-muted small mb-0">

                                        You don't have any completed appointments yet.

                                    </p>

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