@extends('lawyer.sidebar')

@section('laywer')

<div class="col-lg-9 col-xl-10">
    <div class="w-100">

        {{-- ================= HEADER ================= --}}
        <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">

            <div>
                <h2 class="fw-bold text-dark mb-1">
                    My Clients
                </h2>

                <p class="text-muted small mb-0">
                    Manage your approved appointments and client records.
                </p>
            </div>

            {{-- CLIENT COUNT --}}
            <div class="d-flex align-items-center gap-2 px-3 py-2 rounded-3"
                style="background:#0f172a; color:#fff;">

                <i class="bi bi-people-fill text-warning"></i>

                <span class="fw-bold small">
                    {{ $clients->count() }} Active Clients
                </span>

            </div>

        </div>


        {{-- ================= SUCCESS MESSAGE ================= --}}
        @if(session('success'))

        <div class="alert alert-success border-0 shadow-sm rounded-3 small fw-semibold">

            <i class="bi bi-check-circle-fill me-2"></i>

            {{ session('success') }}

        </div>

        @endif


        {{-- ================= CLIENT TABLE ================= --}}
        <div class="card border-0 shadow-sm rounded-4 overflow-hidden">

            <div class="table-responsive">

                <table class="table align-middle mb-0"
                    style="border-collapse: separate; border-spacing: 0;">

                    {{-- TABLE HEADER --}}
                    <thead>
                        <tr>
                            <th class="px-4 py-3 small text-white"
                                style="background-color:#0f172a !important; color:#fff !important;">
                                Client
                            </th>

                            <th class="px-4 py-3 small text-white"
                                style="background-color:#0f172a !important; color:#fff !important;">
                                Phone
                            </th>

                            <th class="px-4 py-3 small text-white"
                                style="background-color:#0f172a !important; color:#fff !important;">
                                Date
                            </th>

                            <th class="px-4 py-3 small text-white"
                                style="background-color:#0f172a !important; color:#fff !important;">
                                Time
                            </th>

                            <th class="px-4 py-3 small text-white"
                                style="background-color:#0f172a !important; color:#fff !important;">
                                Meeting Type
                            </th> 

                            <th class="px-4 py-3 small text-white text-center"
                                style="background-color:#0f172a !important; color:#fff !important;">
                                Actions
                            </th>

                        </tr>
                    </thead>


                    {{-- TABLE BODY --}}
                    <tbody>

                        @forelse($clients as $appointment)

                        <tr>                    
                            {{-- CLIENT --}}
                            <td class="px-4 py-3">

                                <div class="d-flex align-items-center gap-3">

                                    {{-- Avatar --}}
                                    <div class="rounded-3 d-flex align-items-center justify-content-center fw-bold"
                                        style="
                                            width:42px;
                                            height:42px;
                                            background:#0f172a;
                                            color:#fbbf24;
                                         ">

                                        {{ strtoupper(substr($appointment->customer->name ?? 'C', 0, 1)) }}

                                    </div>


                                    <div>

                                        <div class="fw-bold text-dark">

                                            {{ $appointment->customer->name ?? 'Unknown Client' }}

                                        </div>
                                    </div>

                                </div>

                            </td>


                            {{-- EMAIL --}}
                            <td class="px-4 py-3">

                                <span class="text-muted small">

                                    {{ $appointment->customer->phone ?? 'N/A' }}

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
                             <td class="px-4 py-3">

                                <span class="text-muted small">

                                    {{ $appointment->meeting_type ?? 'N/A' }}

                                </span>

                            </td>


                            {{-- ACTIONS --}}
                            <td class="px-4 py-3 text-center">

                                <div class="d-flex justify-content-center gap-2 flex-wrap">

                                    {{-- COMPLETED --}}
                                    <form
                                        action="{{ route('lawyer.client.completed', $appointment->id) }}"
                                        method="POST">

                                        @csrf

                                        <button
                                            type="submit"
                                            onclick="return confirm('Mark this appointment as completed?')"
                                            class="btn btn-sm rounded-2 fw-semibold px-3"
                                            style="
                                                background:#ecfdf5;
                                                color:#047857;
                                                border:1px solid #a7f3d0;
                                            ">

                                            <i class="bi bi-check-circle me-1"></i>

                                            Completed

                                        </button>

                                    </form>


                                    {{-- NOT COMPLETED --}}
                                    <form
                                        action="{{ route('lawyer.client.not_completed', $appointment->id) }}"
                                        method="POST">

                                        @csrf

                                        <button
                                            type="submit"
                                            onclick="return confirm('Mark this appointment as not completed?')"
                                            class="btn btn-sm rounded-2 fw-semibold px-3"
                                            style="
                                                background:#fef2f2;
                                                color:#b91c1c;
                                                border:1px solid #fecaca;
                                            ">

                                            <i class="bi bi-x-circle me-1"></i>

                                            Not Completed

                                        </button>

                                    </form>

                                </div>

                            </td>

                        </tr>

                        @empty

                        {{-- EMPTY STATE --}}
                        <tr>

                            <td colspan="6" class="text-center py-5">

                                <div class="mb-3">

                                    <i class="bi bi-people text-secondary"
                                        style="font-size:50px;">
                                    </i>

                                </div>

                                <h6 class="fw-bold text-dark">
                                    No Active Clients
                                </h6>

                                <p class="text-muted small mb-0">
                                    No approved appointments are available right now.
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