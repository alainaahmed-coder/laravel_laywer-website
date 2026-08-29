@extends('lawyer.sidebar')

@section('laywer')

<div class="col-lg-9 col-xl-10">

```
<div class="container-fluid py-4">

    {{-- ================= HEADER ================= --}}
    <div class="d-flex flex-wrap justify-content-between align-items-center mb-4 gap-3">

        <div>
            <h3 class="fw-bold mb-1">Appointment Requests</h3>

            <p class="text-muted mb-0">
                Review and manage your pending customer appointments.
            </p>
        </div>

        <span class="badge bg-warning text-dark px-3 py-2 rounded-pill">
            <i class="bi bi-hourglass-split me-1"></i>
            {{ $requests->count() }} Pending
        </span>

    </div>


    {{-- ================= SUCCESS MESSAGE ================= --}}
    @if(session('success'))

        <div class="alert alert-success alert-dismissible fade show rounded-3" role="alert">

            <i class="bi bi-check-circle-fill me-2"></i>
            {{ session('success') }}

            <button type="button"
                    class="btn-close"
                    data-bs-dismiss="alert">
            </button>

        </div>

    @endif


    {{-- ================= ERROR MESSAGE ================= --}}
    @if(session('error'))

        <div class="alert alert-danger alert-dismissible fade show rounded-3" role="alert">

            <i class="bi bi-exclamation-circle-fill me-2"></i>
            {{ session('error') }}

            <button type="button"
                    class="btn-close"
                    data-bs-dismiss="alert">
            </button>

        </div>

    @endif


    {{-- ================= REQUESTS ================= --}}
    @forelse($requests as $request)

        <div class="card border-0 shadow-sm rounded-4 mb-3">

            <div class="card-body p-4">

                <div class="row align-items-center g-3">


                    {{-- ================= CUSTOMER ================= --}}
                    <div class="col-lg-4">

                        <div class="d-flex align-items-center">

                            {{-- Customer Icon --}}
                            <div class="rounded-circle bg-light d-flex align-items-center justify-content-center flex-shrink-0"
                                 style="width:60px; height:60px;">

                                <i class="bi bi-person-fill fs-4 text-secondary"></i>

                            </div>


                            {{-- Customer Info --}}
                            <div class="ms-3">

                                <small class="text-muted d-block mb-1">
                                    Customer
                                </small>

                                <h6 class="fw-bold mb-1 text-dark">

                                    {{ $request->customer->name ?? 'Customer' }}

                                </h6>

                                @if($request->customer)

                                    <small class="text-muted">

                                        <i class="bi bi-envelope me-1"></i>

                                        {{ $request->customer->email }}

                                    </small>

                                @endif

                            </div>

                        </div>

                    </div>


                    {{-- ================= APPOINTMENT ================= --}}
                    <div class="col-lg-3">

                        <small class="text-muted d-block mb-1">
                            Appointment
                        </small>

                        <div class="fw-semibold text-dark">

                            <i class="bi bi-calendar3 me-1"></i>

                            {{ \Carbon\Carbon::parse($request->appointment_date)->format('d M Y') }}

                        </div>

                        <small class="text-muted">

                            <i class="bi bi-clock me-1"></i>

                            {{ \Carbon\Carbon::parse($request->appointment_time)->format('h:i A') }}

                        </small>

                    </div>


                    {{-- ================= STATUS ================= --}}
                    <div class="col-lg-2">

                        <small class="text-muted d-block mb-2">
                            Status
                        </small>

                        <span class="badge bg-warning text-dark px-3 py-2 rounded-pill">

                            <i class="bi bi-hourglass-split me-1"></i>

                            Pending

                        </span>

                    </div>


                    {{-- ================= ACTIONS ================= --}}
                    <div class="col-lg-3">

                        <small class="text-muted d-block mb-2">
                            Action
                        </small>

                        <div class="d-flex flex-wrap gap-2">


                            {{-- APPROVE --}}
                            <form action="{{ route('lawyer.requests.approve', $request->id) }}"
                                  method="POST">

                                @csrf
                                @method('PATCH')

                                <button type="submit"
                                        class="btn btn-success btn-sm px-3 rounded-3">

                                    <i class="bi bi-check-circle me-1"></i>

                                    Approve

                                </button>

                            </form>


                            {{-- REJECT --}}
                            <form action="{{ route('lawyer.requests.reject', $request->id) }}"
                                  method="POST">

                                @csrf
                                @method('PATCH')

                                <button type="submit"
                                        class="btn btn-danger btn-sm px-3 rounded-3">

                                    <i class="bi bi-x-circle me-1"></i>

                                    Reject

                                </button>

                            </form>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    @empty

        {{-- ================= EMPTY STATE ================= --}}
        <div class="card border-0 shadow-sm rounded-4">

            <div class="card-body text-center py-5">

                <div class="mb-3">

                    <i class="bi bi-calendar-check text-muted"
                       style="font-size:55px;">
                    </i>

                </div>

                <h5 class="fw-bold">
                    No Pending Requests
                </h5>

                <p class="text-muted mb-0">
                    You don't have any pending appointment requests right now.
                </p>

            </div>

        </div>

    @endforelse

</div>
```

</div>

@endsection
