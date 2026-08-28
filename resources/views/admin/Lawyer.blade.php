@extends('admin.sidebar')

@section('admin')

<div class="container-fluid py-4">

    {{-- Page Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 fw-bold text-navy mb-1">
                Lawyers Management
            </h1>

            <p class="text-muted small mb-0">
                Total {{ $lawyers->count() }} registered lawyer(s)
            </p>
        </div>
    </div>

    {{-- Success Message --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}

            <button type="button"
                    class="btn-close"
                    data-bs-dismiss="alert">
            </button>
        </div>
    @endif

    {{-- Error Message --}}
    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif


    {{-- Lawyers Cards --}}
    <div class="row g-4">

        @forelse($lawyers as $lawyer)

            <div class="col-12 col-md-6 col-xl-4">

                <div class="card border-0 shadow-sm rounded-4 p-3 h-100 bg-white">

                    {{-- ================= HEADER ================= --}}
                    <div class="d-flex align-items-center gap-3 mb-3">

                        {{-- Lawyer Image --}}
                        <img
                                src="{{ asset('uploads/lawyers/' . $lawyer->image) }}"
                                alt="Lawyer Profile"
                                width="100"
                                height="100"
                                class="rounded-circle object-fit-cover">

                        <div class="flex-grow-1">

                            {{-- Name From Users Table --}}
                            <h5 class="fw-bold mb-1 text-dark">
                                {{ $lawyer->user->name ?? 'Unknown Lawyer' }}
                            </h5>

                            {{-- Email From Users Table --}}
                            <small class="text-muted d-block text-truncate">
                                <i class="bi bi-envelope me-1"></i>
                                {{ $lawyer->user->email ?? 'N/A' }}
                            </small>

                            {{-- Phone From Users Table --}}
                            <small class="text-muted d-block text-truncate">
                                <i class="bi bi-telephone me-1"></i>
                                {{ $lawyer->user->phone ?? 'N/A' }}
                            </small>

                        </div>

                    </div>


                    {{-- ================= CITY & SERVICE ================= --}}
                    <div class="d-flex flex-wrap gap-2 mb-3">

                        {{-- Service --}}
                        @if($lawyer->service)

                            <span class="badge bg-light text-dark border px-3 py-2 rounded-pill">
                                <i class="bi bi-briefcase me-1"></i>
                                {{ $lawyer->service->name }}
                            </span>

                        @else

                            <span class="badge bg-light text-muted border px-3 py-2 rounded-pill">
                                Service Not Selected
                            </span>

                        @endif


                        {{-- City --}}
                        @if($lawyer->city)

                            <span class="badge bg-light text-dark border px-3 py-2 rounded-pill">
                                <i class="bi bi-geo-alt me-1"></i>
                                {{-- {{ $lawyer->city->name }} --}}
                            </span>

                        @else

                            <span class="badge bg-light text-muted border px-3 py-2 rounded-pill">
                                City Not Selected
                            </span>

                        @endif

                    </div>


                    {{-- ================= EXPERIENCE & FEE ================= --}}
                    <div class="row g-2 mb-3">

                        {{-- Experience --}}
                        <div class="col-6">

                            <div class="border rounded-3 p-2 h-100">

                                <small class="text-muted d-block mb-1">
                                    Experience
                                </small>

                                <strong class="text-navy">
                                    {{ $lawyer->experience ?? 'N/A' }}
                                </strong>

                            </div>

                        </div>


                        {{-- Fee --}}
                        <div class="col-6">

                            <div class="border rounded-3 p-2 h-100">

                                <small class="text-muted d-block mb-1">
                                    Consultation Fee
                                </small>

                                <strong class="text-navy">
                                    PKR {{ number_format($lawyer->fee ?? 0) }}
                                </strong>

                            </div>

                        </div>

                    </div>


                    {{-- ================= SHOW DETAILS ================= --}}
                    <button
                        class="btn btn-outline-navy w-100 py-2 fw-semibold"
                        type="button"
                        data-bs-toggle="collapse"
                        data-bs-target="#adminLawyerDetail{{ $lawyer->id }}"
                        aria-expanded="false">

                        <i class="bi bi-person-lines-fill me-1"></i>
                        Show Further Details

                    </button>


                    {{-- ================= FULL DETAILS ================= --}}
                    <div
                        class="collapse mt-3"
                        id="adminLawyerDetail{{ $lawyer->id }}">

                        <div class="p-3 bg-light rounded-3 border">

                            {{-- Bio --}}
                            <h6 class="fw-bold text-navy mb-2">
                                <i class="bi bi-person-lines-fill me-1"></i>
                                Bio / About Lawyer
                            </h6>

                            <p class="text-muted small mb-3">
                                {{ $lawyer->bio ?? 'No biography added.' }}
                            </p>


                            {{-- Qualifications --}}
                            <h6 class="fw-bold text-navy mb-2">
                                <i class="bi bi-mortarboard me-1"></i>
                                Qualifications
                            </h6>

                            @if(is_array($lawyer->qualifications) && count($lawyer->qualifications) > 0)

                                <ul class="ps-3 mb-3 text-muted small">

                                    @foreach($lawyer->qualifications as $qualification)

                                        <li>
                                            {{ $qualification }}
                                        </li>

                                    @endforeach

                                </ul>

                            @elseif(!empty($lawyer->qualifications))

                                <p class="text-muted small mb-3">
                                    {{ $lawyer->qualifications }}
                                </p>

                            @else

                                <p class="text-muted small mb-3">
                                    N/A
                                </p>

                            @endif


                            {{-- Office Address --}}
                            <h6 class="fw-bold text-navy mb-2">
                                <i class="bi bi-building me-1"></i>
                                Office Address
                            </h6>

                            <p class="text-muted small mb-3">
                                {{ $lawyer->office_address ?? 'N/A' }}
                            </p>


                            {{-- City --}}
                            <h6 class="fw-bold text-navy mb-2">
                                <i class="bi bi-geo-alt me-1"></i>
                                City
                            </h6>

                            <p class="text-muted small mb-3">
                                {{ $lawyer->city->name ?? 'N/A' }}
                            </p>


                            {{-- Service --}}
                            <h6 class="fw-bold text-navy mb-2">
                                <i class="bi bi-briefcase me-1"></i>
                                Service
                            </h6>

                            <p class="text-muted small mb-3">
                                {{ $lawyer->service->name ?? 'N/A' }}
                            </p>


                            {{-- Experience --}}
                            <h6 class="fw-bold text-navy mb-2">
                                <i class="bi bi-briefcase me-1"></i>
                                Experience
                            </h6>

                            <p class="text-muted small mb-3">
                                {{ $lawyer->experience ?? 'N/A' }}
                            </p>


                            {{-- Fee --}}
                            <h6 class="fw-bold text-navy mb-2">
                                <i class="bi bi-cash-stack me-1"></i>
                                Consultation Fee
                            </h6>

                            <p class="text-muted small mb-3">
                                PKR {{ number_format($lawyer->fee ?? 0) }}
                            </p>


                            {{-- Contact Information --}}
                            <h6 class="fw-bold text-navy mb-2">
                                <i class="bi bi-person-lines-fill me-1"></i>
                                Contact Information
                            </h6>

                            <p class="text-muted small mb-0">

                                <i class="bi bi-person me-1"></i>
                                {{ $lawyer->user->name ?? 'N/A' }}

                                <br>

                                <i class="bi bi-envelope me-1"></i>
                                {{ $lawyer->user->email ?? 'N/A' }}

                                <br>

                                <i class="bi bi-telephone me-1"></i>
                                {{ $lawyer->user->phone ?? 'N/A' }}

                            </p>

                        </div>

                    </div>


                    {{-- ================= DELETE BUTTON ================= --}}
                    <div class="d-flex gap-2 mt-3">

                        <form
                            action="{{ route('admin.lawyers.delete', $lawyer->id) }}"
                            method="POST"
                            class="w-100"
                            onsubmit="return confirm('Are you sure you want to delete this lawyer?');">

                            @csrf
                            @method('DELETE')

                            <button
                                type="submit"
                                class="btn btn-sm btn-outline-danger w-100 py-2">

                                <i class="bi bi-trash me-1"></i>
                                Delete Lawyer

                            </button>

                        </form>

                    </div>

                </div>

            </div>

        @empty

            <div class="col-12">

                <div class="text-center py-5 bg-white rounded-4 shadow-sm">

                    <i class="bi bi-person-x fs-1 text-muted d-block mb-2"></i>

                    <h3 class="h5">
                        No Lawyers Registered Yet
                    </h3>

                    <p class="text-muted mb-0">
                        Lawyers will appear here after completing their profiles.
                    </p>

                </div>

            </div>

        @endforelse

    </div>

</div>

@endsection
