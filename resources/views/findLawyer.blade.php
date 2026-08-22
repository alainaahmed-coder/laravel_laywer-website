@extends('user.navbar')
@section('user')
<section class="bg-navy py-4">
  <div class="container">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb mb-2 small">
        <li class="breadcrumb-item"><a href="index.html" class="text-gold">Home</a></li>
        <li class="breadcrumb-item active text-white-50" aria-current="page">Find Lawyers</li>
      </ol>
    </nav>
    <h1 class="h3 text-white mb-0">Browse verified lawyers</h1>
  </div>
</section>  

<main class="section pt-4">
  <div class="container">
    <div class="row g-4">

      <!-- Filter sidebar -->
      <aside class="col-lg-3">
        <button class="btn btn-outline-navy w-100 d-lg-none mb-3" type="button" data-bs-toggle="collapse" data-bs-target="#filterPanel">
          <i class="bi bi-sliders me-1"></i> Filters
        </button>
        <div class="collapse d-lg-block" id="filterPanel">
          <div class="card-legal p-4">
            <div class="d-flex justify-content-between align-items-center mb-3">
              <h2 class="h6 mb-0">Filters</h2>
              <button class="btn btn-link btn-sm text-decoration-none text-gold p-0" id="resetFilters">Reset</button>
            </div>

            <div class="mb-3">
              <label class="form-label small fw-semibold" for="fCity">City</label>
              <select class="form-select" id="fCity"></select>
            </div>

            <div class="mb-3">
              <label class="form-label small fw-semibold" for="fSpec">Service type</label>
              <select class="form-select" id="fSpec"></select>
            </div>

            <div class="mb-3">
              <label class="form-label small fw-semibold" for="fRating">Minimum rating: <span class="text-gold" id="fRatingVal">Any</span></label>
              <input type="range" class="form-range" id="fRating" min="0" max="5" step="0.5" value="0">
            </div>

            <div class="mb-3">
              <label class="form-label small fw-semibold" for="fFee">Max consultation fee: <span class="text-gold" id="fFeeVal">PKR 12,000</span></label>
              <input type="range" class="form-range" id="fFee" min="1000" max="12000" step="500" value="12000">
            </div>

            <div class="form-check">
              <input class="form-check-input" type="checkbox" id="fVerified">
              <label class="form-check-label small" for="fVerified">Verified lawyers only</label>
            </div>
          </div>
        </div>
      </aside>

      <!-- Results -->
      <div class="col-lg-9">
        <div class="card-legal p-3 mb-4">
          <div class="row g-2 align-items-center">
            <div class="col-12 col-md-6">
              <div class="input-group">
                <span class="input-group-text bg-white border-end-0"><i class="bi bi-search text-muted"></i></span>
                <input type="search" class="form-control border-start-0" id="fSearch" placeholder="Search by lawyer name">
              </div>
            </div>
            <div class="col-7 col-md-4">
              <select class="form-select" id="fSort">
                <option value="rating">Sort: Top rated</option>
                <option value="feeAsc">Sort: Fee (low to high)</option>
                <option value="feeDesc">Sort: Fee (high to low)</option>
                <option value="exp">Sort: Most experienced</option>
              </select>
            </div>
            <div class="col-5 col-md-2 text-end">
              <div class="btn-group w-100" role="group" aria-label="View mode">
                <button class="btn btn-outline-navy btn-sm active" id="gridView" title="Grid view"><i class="bi bi-grid"></i></button>
                <button class="btn btn-outline-navy btn-sm" id="listView" title="List view"><i class="bi bi-list-ul"></i></button>
              </div>
            </div>
          </div>
        </div>

        <p class="text-muted-legal small" id="resultCount"></p>
        <div class="row g-4" id="resultsGrid"></div>
        <div id="emptyState" class="empty-state d-none">
          <i class="bi bi-search fs-1 text-gold"></i>
          <h3 class="h5 mt-3">No lawyers match your filters</h3>
          <p class="mb-3">Try widening the fee range, lowering the rating filter or clearing the city selection.</p>
          <button class="btn btn-navy" id="emptyReset">Clear all filters</button>
        </div>
      </div>
    </div>
  </div>
</main>

@endsection