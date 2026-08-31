@extends('customer.sidebar')

@section('customer')
<div class="container-fluid py-4">

    <!-- Page Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="fw-bold text-dark mb-1">Find & Book Lawyers</h3>
            <p class="text-muted small mb-0">Search verified lawyers and book appointments directly from your dashboard.</p>
        </div>
    </div>

    <div class="row g-4">

        <!-- Filter Sidebar (Left Panel) -->
        <aside class="col-lg-3">
            <button class="btn btn-outline-primary w-100 d-lg-none mb-3" type="button" data-bs-toggle="collapse" data-bs-target="#filterPanel">
                <i class="bi bi-sliders me-1"></i> Filters
            </button>
            <div class="collapse d-lg-block" id="filterPanel">
                <div class="card border-0 shadow-sm rounded-3 p-3 bg-white">
                    <form action="{{ route('customer.find.lawyer') }}" method="GET">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h6 class="mb-0 fw-bold text-dark">Filter Lawyers</h6>
                            <a href="{{ route('customer.find.lawyer') }}" class="text-decoration-none small text-primary p-0">Reset</a>
                        </div>

                        <!-- Search Keyword -->
                        <div class="mb-3">
                            <label class="form-label small fw-semibold">Search Keyword</label>
                            <input type="text" name="q" class="form-control form-control-sm" placeholder="Lawyer name..." value="{{ request('q') }}">
                        </div>

                        <!-- City Filter -->
                        <div class="mb-3">
                            <label class="form-label small fw-semibold">City</label>
                            <select class="form-select form-select-sm" name="city">
                                <option value="">All Cities</option>
                                @foreach($cities as $c)
                                    <option value="{{ $c->id }}" {{ request('city') == $c->id ? 'selected' : '' }}>
                                        {{ $c->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Specialization Filter -->
                        <div class="mb-3">
                            <label class="form-label small fw-semibold">Service Type</label>
                            <select class="form-select form-select-sm" name="spec">
                                <option value="">All Services</option>
                                @foreach($services as $s)
                                    <option value="{{ $s->id }}" {{ request('spec') == $s->id ? 'selected' : '' }}>
                                        {{ $s->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary btn-sm w-100 py-2 mt-2 fw-semibold">Apply Filters</button>
                    </form>
                </div>
            </div>
        </aside>

        <!-- Lawyers Listing Cards Grid (Right Panel) -->
        <div class="col-lg-9">

            <div class="mb-3">
                <span class="text-muted small">Showing <strong>{{ count($lawyers) }}</strong> advocate(s) available</span>
            </div>

            <!-- CARDS GRID -->
            <div class="row g-3">
                @forelse($lawyers as $lawyer)
                    <div class="col-md-6 col-xl-4">
                        <div class="card border-0 shadow-sm rounded-3 p-3 h-100 bg-white d-flex flex-column justify-content-between">
                            <div>
                                <!-- Image & Basic Info -->
                                <div class="d-flex align-items-center gap-3 mb-3">
                                    <img
                                        src="{{ asset('uploads/lawyers/' . ($lawyer->image ?? 'default.png')) }}"
                                        alt="Lawyer Profile"
                                        width="70"
                                        height="70"
                                        class="rounded-circle object-fit-cover border">

                                    <div>
                                        <h6 class="fw-bold mb-1 text-dark d-flex align-items-center gap-1">
                                            {{ $lawyer->user->name ?? 'Lawyer' }}
                                            @if($lawyer->is_verified == 1)
                                                <i class="bi bi-patch-check-fill text-primary" title="Verified Advocate"></i>
                                            @endif
                                        </h6>

                                        <!-- Rating -->
                                        <div class="small text-warning">
                                            @for($i = 1; $i <= 5; $i++)
                                                <i class="bi bi-star-fill"></i>
                                            @endfor
                                            <span class="text-secondary ms-1 fw-semibold">
                                                {{ number_format($lawyer->rating ?? 5, 1) }}
                                            </span>
                                        </div>
                                    </div>
                                </div>

                                <!-- Service & City Badges -->
                                <div class="d-flex flex-wrap gap-1 mb-3">
                                    <span class="badge bg-light text-dark fw-normal px-2 py-1 rounded border">
                                        {{ $lawyer->service->name ?? 'Legal Service' }}
                                    </span>

                                    @if($lawyer->city)
                                        <span class="badge bg-info bg-opacity-10 text-dark fw-normal px-2 py-1 rounded">
                                            <i class="bi bi-geo-alt text-info me-1"></i>
                                            {{ $lawyer->city->name }}
                                        </span>
                                    @endif
                                </div>

                                <!-- Experience & Fee -->
                                <div class="row g-2 align-items-center mb-3 small text-muted">
                                    <div class="col-6">
                                        <i class="bi bi-briefcase me-1"></i>
                                        <span>{{ $lawyer->experience ?? 0 }} yrs exp</span>
                                    </div>
                                    <div class="col-6 text-end text-dark fw-bold">
                                        PKR {{ number_format($lawyer->fee ?? 0) }}
                                    </div>
                                </div>
                            </div>

                            <!-- View Profile / Book Appointment Button -->
                            <a href="{{ route('lawyer.profile', $lawyer->id) }}" class="btn btn-outline-primary btn-sm w-100 fw-semibold">
                                View Profile & Book
                            </a>
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center py-5 bg-white rounded-3 shadow-sm">
                        <i class="bi bi-search fs-1 text-muted mb-2 d-block"></i>
                        <h6 class="fw-semibold text-dark">No lawyers match your filters</h6>
                        <p class="text-muted small mb-3">Try clearing search keywords or selecting all cities.</p>
                        <a href="{{ route('customer.find.lawyer') }}" class="btn btn-primary btn-sm">Clear all filters</a>
                    </div>
                @endforelse
            </div>

        </div>

    </div>
</div>
@endsection
