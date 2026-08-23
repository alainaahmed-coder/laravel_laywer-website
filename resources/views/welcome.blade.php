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
        <form class="search-panel" action="lawyers.html" method="get">
          <div class="row g-2 align-items-center">
            <div class="col-12 col-lg-4">
              <label for="q" class="visually-hidden">Search lawyers</label>
              <input type="search" class="form-control" id="q" name="q" placeholder="Search lawyer name or keyword">
            </div>
            <div class="col-6 col-lg-3">
              <label for="heroCity" class="visually-hidden">City</label>
              <select class="form-select" id="heroCity" name="city"></select>
            </div>
            <div class="col-6 col-lg-3">
              <label for="heroSpec" class="visually-hidden">Specialization</label>
              <select class="form-select" id="heroSpec" name="spec"></select>
            </div>
            <div class="col-12 col-lg-2">
              <button class="btn btn-gold w-100 py-3" type="submit"><i class="bi bi-search me-1"></i> Search</button>
            </div>
          </div>
        </form>
        <div class="d-flex flex-wrap justify-content-center gap-2 mt-3">
          <a href="lawyers.html?spec=Criminal%20Law" class="btn btn-outline-gold btn-sm">Criminal Law</a>
          <a href="lawyers.html?spec=Divorce%20%26%20Family" class="btn btn-outline-gold btn-sm">Divorce &amp; Family</a>
          <a href="lawyers.html?spec=Affidavit" class="btn btn-outline-gold btn-sm">Affidavit</a>
          <a href="lawyers.html?spec=Civil%20Law" class="btn btn-outline-gold btn-sm">Civil Law</a>
          <a href="lawyers.html?spec=Corporate" class="btn btn-outline-gold btn-sm">Corporate</a>
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
      <a href="lawyers.html" class="btn btn-outline-navy">Browse all lawyers <i class="bi bi-arrow-right ms-1"></i></a>
    </div>
    <div class="row g-4" id="featuredGrid"></div>
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
          <a href="auth.html?tab=register&role=lawyer" class="btn btn-gold px-4 py-2">Join as Lawyer</a>
        </div>
      </div>
    </div>
  </div>
</section>


@endsection
