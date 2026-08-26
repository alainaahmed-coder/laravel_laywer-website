@extends('user.navbar')

@section('user')
<section class="bg-navy py-4">
  <div class="container">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb mb-2 small">
        <li class="breadcrumb-item"><a href="{{ url('/') }}" class="text-gold">Home</a></li>
        <li class="breadcrumb-item active text-white-50" aria-current="page">Find Lawyers</li>
      </ol>
    </nav>
    <h1 class="h3 text-white mb-0">Browse verified lawyers</h1>
  </div>
</section>

<main class="section pt-4">
  <div class="container">
    <div class="row g-4">

      <!-- Filter sidebar (col-lg-3) -->
      <aside class="col-lg-3">
        <button class="btn btn-outline-navy w-100 d-lg-none mb-3" type="button" data-bs-toggle="collapse" data-bs-target="#filterPanel">
          <i class="bi bi-sliders me-1"></i> Filters
        </button>
        <div class="collapse d-lg-block" id="filterPanel">
          <div class="card-legal p-4 shadow-sm rounded-4 bg-white">
            <form action="{{ route('lawyerfind') }}" method="GET">
              <div class="d-flex justify-content-between align-items-center mb-3">
                <h2 class="h6 mb-0 fw-bold">Filters</h2>
                <a href="{{ route('lawyerfind') }}" class="btn btn-link btn-sm text-decoration-none text-gold p-0">Reset</a>
              </div>

              <!-- Search Name/Keyword -->
              <div class="mb-3">
                <label class="form-label small fw-semibold" for="fSearch">Search Keyword</label>
                <input type="text" name="q" class="form-control" id="fSearch" placeholder="Lawyer name..." value="{{ request('q') }}">
              </div>

              <!-- City Filter -->
              <div class="mb-3">
                <label class="form-label small fw-semibold" for="fCity">City</label>
                <select class="form-select" id="fCity" name="city">
                  <option value="">All Cities</option>
                  @foreach($cities as $c)
                    <option value="{{ $c }}" {{ request('city') == $c ? 'selected' : '' }}>{{ $c }}</option>
                  @endforeach
                </select>
              </div>

              <!-- Specialization Filter -->
              <div class="mb-3">
                <label class="form-label small fw-semibold" for="fSpec">Service type</label>
                <select class="form-select" id="fSpec" name="spec">
                  <option value="">All Specializations</option>
                  @foreach($specializations as $s)
                    <option value="{{ $s }}" {{ request('spec') == $s ? 'selected' : '' }}>{{ $s }}</option>
                  @endforeach
                </select>
              </div>

              <button type="submit" class="btn btn-navy w-100 py-2 mt-2 fw-semibold">Apply Filters</button>
            </form>
          </div>
        </div>
      </aside>

      <!-- Lawyers Listing Grid (col-lg-9) -->
      <div class="col-lg-9">
        <div class="d-flex justify-content-between align-items-center mb-4">
          <div>
            <h2 class="h4 mb-1 fw-bold">Verified Advocates</h2>
            <p class="text-muted small mb-0">Showing {{ count($lawyers) }} advocate(s) matching your criteria</p>
          </div>
        </div>

        <!-- CARDS GRID -->
        <div class="row g-4">
          @forelse($lawyers as $lawyer)
            <div class="col-md-6 col-xl-4">
              <div class="card border-0 shadow-sm rounded-4 p-3 h-100 bg-white d-flex flex-column justify-content-between">
                <div>
                  <!-- Image & Basic Info -->
                  <div class="d-flex align-items-center gap-3 mb-3">
                    <img src="{{ !empty($lawyer->image) ? asset('images/Lawyer/' . $lawyer->image) : asset('images/default-avatar.jpg') }}"
                         alt="{{ $lawyer->name }}"
                         class="rounded-circle object-fit-cover border"
                         width="60" height="60">
                    <div>
                      <h6 class="fw-bold mb-1 text-dark d-flex align-items-center gap-1">
                        {{ $lawyer->name }}
                        @if(isset($lawyer->is_verified) && $lawyer->is_verified == 1)
                          <i class="bi bi-patch-check-fill text-warning" title="Verified Advocate"></i>
                        @endif
                      </h6>
                      <div class="small text-warning">
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-fill"></i>
                        <span class="text-secondary ms-1 fw-semibold">5.0</span>
                      </div>
                    </div>
                  </div>

                  <!-- Specialization & City Badges -->
                  <div class="d-flex flex-wrap gap-2 mb-3">
                    <span class="badge bg-light text-dark fw-normal px-3 py-2 rounded-pill border">
                      {{ $lawyer->specialization ?? 'Lawyer' }}
                    </span>
                    @if(!empty($lawyer->city))
                      <span class="badge bg-warning bg-opacity-10 text-dark fw-normal px-3 py-2 rounded-pill">
                        <i class="bi bi-geo-alt text-warning me-1"></i>{{ $lawyer->city }}
                      </span>
                    @endif
                  </div>

                  <!-- Experience & Fee Details -->
                  <div class="row g-2 align-items-center mb-3 small text-muted">
                    <div class="col-6 d-flex align-items-center gap-1">
                      <i class="bi bi-briefcase fs-6"></i>
                      <span>{{ $lawyer->experience ?? 0 }} yrs exp</span>
                    </div>
                    <div class="col-6 text-end text-navy fw-bold fs-6">
                      <i class="bi bi-cash-stack me-1"></i>PKR {{ number_format($lawyer->fee ?? 0) }}
                    </div>
                  </div>
                </div>

                <!-- Action Button -->
                <a href="#" class="btn btn-dark w-100 py-2 rounded-3 fw-semibold mt-2">
                  View Profile &amp; Book
                </a>
              </div>
            </div>
          @empty
            <div class="col-12 text-center py-5 bg-white rounded-4 shadow-sm">
              <i class="bi bi-search fs-1 text-gold mb-2 d-block"></i>
              <h3 class="h5">No lawyers match your filters</h3>
              <p class="text-muted mb-3">Try clearing search keywords or selecting all cities.</p>
              <a href="{{ route('lawyerfind') }}" class="btn btn-navy">Clear all filters</a>
            </div>
          @endforelse
        </div>
      </div>

    </div>
  </div>
</main>

<!-- ============ CTA ============ -->
<section class="pb-5 pt-3">
  <div class="container">
    <div class="card-legal p-4 p-lg-5 bg-navy border-0 text-white rounded-4">
      <div class="row align-items-center g-4">
        <div class="col-lg-8">
          <h2 class="h3 text-white mb-2">Are you a practising advocate?</h2>
          <p class="mb-0 opacity-75">List your practice, manage your availability calendar and receive verified client appointments directly in your panel.</p>
        </div>
        <div class="col-lg-4 text-lg-end">
          <a href="{{ route('register') }}" class="btn btn-gold px-4 py-2">Join as Lawyer</a>
        </div>
      </div>
    </div>
  </div>
</section>

@endsection
