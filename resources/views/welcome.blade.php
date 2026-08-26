@extends('user.navbar')

@section('user')

<!-- ============ HERO ============ -->
<header class="hero">
  <div class="container">
    <div class="row justify-content-center text-center">
      <div class="col-lg-9">
        <span class="eyebrow"><i class="bi bi-patch-check-fill"></i> 1,200+ verified advocates across Pakistan</span>
        <h1 class="mt-3">Find &amp; Book Top Legal Experts Instantly</h1>
        <p class="lead mt-3 mb-0">Compare verified lawyers by specialization, city, experience and consultation fee — then lock a confirmed appointment slot in under two minutes.</p>
      </div>
    </div>

    <div class="row justify-content-center mt-4">
      <div class="col-lg-10">
        <!-- Search form seedha /FindLawyer par lekar jayega -->
        <form class="search-panel" action="{{ route('lawyerfind') }}" method="get">
          <div class="row g-2 align-items-center">
            <div class="col-12 col-lg-8">
              <label for="q" class="visually-hidden">Search lawyers</label>
              <input type="search" class="form-control" id="q" name="q" placeholder="Search lawyer name or keyword">
            </div>
            <div class="col-12 col-lg-4">
              <button class="btn btn-gold w-100 py-3" type="submit"><i class="bi bi-search me-1"></i> Search Advocates</button>
            </div>
          </div>
        </form>
        <div class="d-flex flex-wrap justify-content-center gap-2 mt-3">
          <a href="{{ route('lawyerfind', ['spec' => 'Criminal Law']) }}" class="btn btn-outline-gold btn-sm">Criminal Law</a>
          <a href="{{ route('lawyerfind', ['spec' => 'Family Law']) }}" class="btn btn-outline-gold btn-sm">Divorce &amp; Family</a>
          <a href="{{ route('lawyerfind', ['spec' => 'Affidavit']) }}" class="btn btn-outline-gold btn-sm">Affidavit</a>
          <a href="{{ route('lawyerfind', ['spec' => 'Civil Law']) }}" class="btn btn-outline-gold btn-sm">Civil Law</a>
          <a href="{{ route('lawyerfind', ['spec' => 'Corporate']) }}" class="btn btn-outline-gold btn-sm">Corporate</a>
        </div>
      </div>
    </div>
  </div>
</header>

<!-- ============ WHY CHOOSE US ============ -->
<section class="section">
  <div class="container">
    <div class="text-center mb-5 fade-up">
      <h2 class="section-title">Why clients choose LegalEase</h2>
      <p class="text-muted-legal mb-0">A transparent, verified and secure way to get legal help.</p>
    </div>
    <div class="row g-4">
      <div class="col-md-4 fade-up">
        <div class="card-legal h-100 p-4">
          <div class="feature-icon"><i class="bi bi-patch-check"></i></div>
          <h3 class="h5 mt-3">Verified Lawyers</h3>
          <p class="text-muted-legal mb-0">Every profile is checked against Bar Council records, qualifications and practice history before it goes live.</p>
        </div>
      </div>
      <div class="col-md-4 fade-up">
        <div class="card-legal h-100 p-4">
          <div class="feature-icon"><i class="bi bi-calendar2-check"></i></div>
          <h3 class="h5 mt-3">Easy Appointment Booking</h3>
          <p class="text-muted-legal mb-0">See real availability, pick a morning or evening slot and receive instant confirmation — no phone tag required.</p>
        </div>
      </div>
      <div class="col-md-4 fade-up">
        <div class="card-legal h-100 p-4">
          <div class="feature-icon"><i class="bi bi-shield-lock"></i></div>
          <h3 class="h5 mt-3">Secure Consultation</h3>
          <p class="text-muted-legal mb-0">Encrypted case notes, private video rooms and confidential document sharing protected by attorney-client privilege.</p>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ============ STATS ============ -->
<section class="py-4 bg-navy">
  <div class="container">
    <div class="row text-center g-4 text-white">
      <div class="col-6 col-lg-3"><div class="h3 text-gold mb-0">1,200+</div><small class="opacity-75">Verified lawyers</small></div>
      <div class="col-6 col-lg-3"><div class="h3 text-gold mb-0">38,400</div><small class="opacity-75">Consultations booked</small></div>
      <div class="col-6 col-lg-3"><div class="h3 text-gold mb-0">24 cities</div><small class="opacity-75">Nationwide coverage</small></div>
      <div class="col-6 col-lg-3"><div class="h3 text-gold mb-0">4.8/5</div><small class="opacity-75">Average client rating</small></div>
    </div>
  </div>
</section>

<!-- ============ FEATURED LAWYERS ============ -->
<section class="section">
  <div class="container">
    <div class="d-flex flex-wrap justify-content-between align-items-end mb-4 gap-3 fade-up">
      <div>
        <h2 class="section-title mb-1">Featured lawyers</h2>
        <p class="text-muted-legal mb-0">Top-rated advocates accepting appointments this week.</p>
      </div>
      <a href="{{ route('lawyerfind') }}" class="btn btn-outline-navy">Browse all lawyers <i class="bi bi-arrow-right ms-1"></i></a>
    </div>

    <!-- CARDS GRID -->
    <div class="row g-4" id="featuredGrid">
      @forelse($lawyers as $lawyer)
        <div class="col-md-6 col-lg-4">
          <div class="card border-0 shadow-sm rounded-4 p-3 h-100 bg-white d-flex flex-column justify-content-between">
            <div>
              <!-- Image & Basic Info -->
              <div class="d-flex align-items-center gap-3 mb-3">
                <img src="{{ !empty($lawyer->image) ? asset('images/Lawyer/' . $lawyer->image) : asset('images/default-avatar.jpg') }}"
                     alt="{{ $lawyer->name }}"
                     class="rounded-circle object-fit-cover border"
                     width="65" height="65">
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
                  <span>{{ $lawyer->experience ?? 0 }} yrs experience</span>
                </div>
                <div class="col-6 text-end text-navy fw-bold fs-6">
                  <i class="bi bi-cash-stack me-1"></i>PKR {{ number_format($lawyer->fee ?? 0) }}
                </div>
              </div>
            </div>

            <!-- Action Button -->
            <a href="#" class="btn btn-dark w-100 py-2 rounded-3 fw-semibold mt-2">
              View Full Profile &amp; Book
            </a>
          </div>
        </div>
      @empty
        <div class="col-12 text-center py-5">
          <p class="text-muted fs-5 mb-0">No featured lawyers available right now.</p>
        </div>
      @endforelse
    </div>
  </div>
</section>

<!-- ============ CTA ============ -->
<section class="pb-5">
  <div class="container">
    <div class="card-legal p-4 p-lg-5 bg-navy border-0 text-white">
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
