@extends('lawyer.sidebar')

@section('laywer')

<style>
    /* ===============================
       APPOINTMENT REQUESTS UI
    =============================== */

    .requests-page {
        width: 100%;
        padding: 10px 0;
    }

    .requests-table-card {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 2px 10px rgba(15, 23, 42, 0.05);
    }

    /* IMPORTANT:
       Bootstrap .table styles ko override karne ke liye
       direct TH background use kiya gaya hai.
    */
    .requests-table thead tr th {
        background-color: #0f172a !important;
        color: #ffffff !important;
        border: none !important;
        font-size: 12px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        padding: 16px 20px !important;
        white-space: nowrap;
    }

    .requests-table tbody td {
        padding: 16px 20px !important;
        border-color: #f1f5f9 !important;
        vertical-align: middle;
    }

    .requests-table tbody tr {
        transition: 0.2s ease;
    }

    .requests-table tbody tr:hover {
        background-color: #f8fafc !important;
    }

    .request-id {
        display: inline-block;
        padding: 6px 10px;
        background: #f1f5f9;
        color: #334155;
        border: 1px solid #e2e8f0;
        border-radius: 8px;
        font-size: 11px;
        font-weight: 700;
        font-family: monospace;
    }

    .customer-avatar {
        width: 42px;
        height: 42px;
        min-width: 42px;
        border-radius: 10px;
        background: #0f172a !important;
        color: #fbbf24 !important;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 18px;
    }

    .appointment-time {
        display: inline-block;
        padding: 6px 9px;
        background: #eef2ff !important;
        color: #4338ca !important;
        border: 1px solid #e0e7ff;
        border-radius: 8px;
        font-size: 11px;
        font-weight: 700;
    }

    .pending-status {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        padding: 7px 12px;
        background: #fef3c7 !important;
        color: #92400e !important;
        border: 1px solid #fde68a !important;
        border-radius: 50px;
        font-size: 11px;
        font-weight: 700;
    }

    .approve-btn {
        background: #ecfdf5 !important;
        color: #047857 !important;
        border: 1px solid #a7f3d0 !important;
        border-radius: 8px !important;
        font-size: 11px !important;
        font-weight: 700 !important;
        padding: 7px 12px !important;
        transition: 0.2s ease;
    }

    .approve-btn:hover {
        background: #059669 !important;
        color: #ffffff !important;
        border-color: #059669 !important;
    }

    .reject-btn {
        background: #fef2f2 !important;
        color: #b91c1c !important;
        border: 1px solid #fecaca !important;
        border-radius: 8px !important;
        font-size: 11px !important;
        font-weight: 700 !important;
        padding: 7px 12px !important;
        transition: 0.2s ease;
    }

    .reject-btn:hover {
        background: #dc2626 !important;
        color: #ffffff !important;
        border-color: #dc2626 !important;
    }

    .pending-count {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 10px 15px;
        background: #0f172a !important;
        color: #ffffff !important;
        border-radius: 10px;
        font-size: 12px;
        font-weight: 700;
    }

    .pending-count i {
        color: #fbbf24 !important;
    }

    .empty-icon {
        width: 62px;
        height: 62px;
        border-radius: 14px;
        background: #f1f5f9;
        display: inline-flex;
        align-items: center;
        justify-content: center;
    }

    .empty-icon i {
        font-size: 28px;
        color: #94a3b8;
    }

    @media (max-width: 991px) {
        .requests-page {
            padding: 15px 0;
        }

        .requests-table {
            min-width: 850px;
        }
    }
</style>

{{-- =========================================
MAIN CONTENT
========================================= --}}

<div class="col-lg-9 col-xl-10">


<div class="requests-page">


    {{-- =========================================
         PAGE HEADER
    ========================================== --}}
    <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">

        <div>

            <h2 class="fw-bold text-dark mb-1">
                Appointment Requests
            </h2>

            <p class="text-muted small mb-0">
                Review and manage your pending customer appointments.
            </p>

        </div>


        {{-- PENDING COUNT --}}
        <div class="pending-count">

            <i class="bi bi-hourglass-split"></i>

            {{ $requests->count() }} Pending

        </div>

    </div>



    {{-- =========================================
         SUCCESS MESSAGE
    ========================================== --}}
    @if(session('success'))

        <div class="alert alert-success border-0 shadow-sm rounded-3 small fw-semibold mb-4">

            <i class="bi bi-check-circle-fill me-2"></i>

            {{ session('success') }}

        </div>

    @endif



    {{-- =========================================
         ERROR MESSAGE
    ========================================== --}}
    @if(session('error'))

        <div class="alert alert-danger border-0 shadow-sm rounded-3 small fw-semibold mb-4">

            <i class="bi bi-exclamation-circle-fill me-2"></i>

            {{ session('error') }}

        </div>

    @endif



    {{-- =========================================
         TABLE CARD
    ========================================== --}}
    <div class="requests-table-card">

        <div class="table-responsive">

            <table class="table requests-table align-middle mb-0">

                {{-- =================================
                     TABLE HEADER
                ================================== --}}
                <thead>

                    <tr>

                        <th>
                            ID
                        </th>

                        <th>
                            Customer
                        </th>

                        <th>
                            Appointment
                        </th>

                        <th>
                            Status
                        </th>

                        <th class="text-center">
                            Actions
                        </th>

                    </tr>

                </thead>



                {{-- =================================
                     TABLE BODY
                ================================== --}}
                <tbody>

                    @forelse($requests as $request)

                        <tr>


                            {{-- =========================
                                 ID
                            ========================== --}}
                            <td>

                                <span class="request-id">
                                    #{{ $request->id }}
                                </span>

                            </td>



                            {{-- =========================
                                 CUSTOMER
                            ========================== --}}
                            <td>

                                <div class="d-flex align-items-center gap-3">

                                    {{-- Customer Icon --}}
                                    <div class="customer-avatar">

                                        <i class="bi bi-person-fill"></i>

                                    </div>


                                    {{-- Customer Details --}}
                                    <div>

                                        <div class="fw-bold text-dark">

                                            {{ $request->customer->name ?? 'Customer' }}

                                        </div>


                                        @if($request->customer)

                                            <small class="text-muted">

                                                <i class="bi bi-envelope me-1"></i>

                                                {{ $request->customer->email }}

                                            </small>

                                        @else

                                            <small class="text-muted">
                                                Customer information unavailable
                                            </small>

                                        @endif

                                    </div>

                                </div>

                            </td>



                            {{-- =========================
                                 APPOINTMENT
                            ========================== --}}
                            <td>

                                <div class="mb-2">

                                    <i class="bi bi-calendar3 text-primary me-1"></i>

                                    <span class="fw-semibold small text-dark">

                                        {{ \Carbon\Carbon::parse($request->appointment_date)->format('d M, Y') }}

                                    </span>

                                </div>


                                <span class="appointment-time">

                                    <i class="bi bi-clock me-1"></i>

                                    {{ \Carbon\Carbon::parse($request->appointment_time)->format('h:i A') }}

                                </span>

                            </td>



                            {{-- =========================
                                 STATUS
                            ========================== --}}
                            <td>

                                <span class="pending-status">

                                    <i class="bi bi-hourglass-split"></i>

                                    Pending

                                </span>

                            </td>



                            {{-- =========================
                                 ACTIONS
                            ========================== --}}
                            <td>

                                <div class="d-flex justify-content-center align-items-center gap-2 flex-wrap">


                                    {{-- APPROVE --}}
                                    <form
                                        action="{{ route('lawyer.requests.approve', $request->id) }}"
                                        method="POST"
                                        class="m-0"
                                        onsubmit="return confirm('Are you sure you want to approve this appointment?');"
                                    >

                                        @csrf
                                        @method('PATCH')

                                        <button
                                            type="submit"
                                            class="btn approve-btn"
                                        >

                                            <i class="bi bi-check-circle me-1"></i>

                                            Approve

                                        </button>

                                    </form>



                                    {{-- REJECT --}}
                                    <form
                                        action="{{ route('lawyer.requests.reject', $request->id) }}"
                                        method="POST"
                                        class="m-0"
                                        onsubmit="return confirm('Are you sure you want to reject this appointment?');"
                                    >

                                        @csrf
                                        @method('PATCH')

                                        <button
                                            type="submit"
                                            class="btn reject-btn"
                                        >

                                            <i class="bi bi-x-circle me-1"></i>

                                            Reject

                                        </button>

                                    </form>

                                </div>

                            </td>


                        </tr>

                    @empty


                        {{-- =================================
                             EMPTY STATE
                        ================================== --}}
                        <tr>

                            <td colspan="5" class="text-center py-5">

                                <div class="empty-icon mb-3">

                                    <i class="bi bi-calendar-check"></i>

                                </div>


                                <h6 class="fw-bold text-dark mb-1">
                                    No Pending Requests
                                </h6>


                                <p class="text-muted small mb-0">
                                    You don't have any pending appointment requests right now.
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
