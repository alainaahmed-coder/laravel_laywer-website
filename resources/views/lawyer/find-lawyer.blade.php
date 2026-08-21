@extends('user.navbar')

@section('user')


<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Find Lawyers — Search Verified Advocates | LegalEase</title>
<meta name="description" content="Filter verified lawyers by city, service type, rating and consultation fee. Compare experience and book an appointment on LegalEase.">
<meta property="og:title" content="Find Lawyers — Search Verified Advocates | LegalEase">
<meta property="og:description" content="Filter by city, practice area, rating and fee to find the right advocate for your case.">
<meta property="og:type" content="website">
<meta name="twitter:card" content="summary_large_image">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<link href="assets/css/style.css" rel="stylesheet">
</head>
<body>



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



<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="assets/js/data.js"></script>
<script src="assets/js/app.js"></script>
<script>
document.addEventListener("DOMContentLoaded", function () {
  const params = new URLSearchParams(location.search);
  const el = (id) => document.getElementById(id);

  fillSelect(el("fCity"), CITIES, "All cities");
  fillSelect(el("fSpec"), SPECIALIZATIONS, "All service types");
  if (params.get("city")) el("fCity").value = params.get("city");
  if (params.get("spec")) el("fSpec").value = params.get("spec");
  if (params.get("q")) el("fSearch").value = params.get("q");

  let listMode = false;

  function listRow(l) {
    return `
    <div class="col-12">
      <article class="card-legal p-3 p-md-4">
        <div class="row g-3 align-items-center">
          <div class="col-auto"><img src="${l.img}" alt="Portrait of ${l.name}" class="avatar" loading="lazy"></div>
          <div class="col">
            <h3 class="h6 mb-1">${l.name} ${l.verified ? '<i class="bi bi-patch-check-fill text-gold"></i>' : ""}</h3>
            <div class="d-flex flex-wrap gap-2 my-2">
              <span class="badge-spec small">${l.spec}</span>
              <span class="badge-gold small"><i class="bi bi-geo-alt me-1"></i>${l.city}</span>
              <span class="badge-spec small">${l.exp} yrs</span>
            </div>
            <div class="rating">${stars(l.rating)} <span class="text-muted-legal small ms-1">${l.rating.toFixed(1)} (${l.reviews} reviews)</span></div>
          </div>
          <div class="col-12 col-md-auto text-md-end">
            <div class="fw-bold text-navy mb-2">${money(l.fee)}</div>
            <a href="lawyer-profile.html?id=${l.id}" class="btn btn-navy btn-sm">View Full Profile &amp; Book</a>
          </div>
        </div>
      </article>
    </div>`;
  }

  function render() {
    const city = el("fCity").value;
    const spec = el("fSpec").value;
    const minRating = parseFloat(el("fRating").value);
    const maxFee = parseInt(el("fFee").value, 10);
    const onlyVerified = el("fVerified").checked;
    const q = el("fSearch").value.trim().toLowerCase();

    el("fRatingVal").textContent = minRating === 0 ? "Any" : minRating + "+";
    el("fFeeVal").textContent = money(maxFee);

    let rows = LAWYERS.filter((l) =>
      (!city || l.city === city) &&
      (!spec || l.spec === spec) &&
      l.rating >= minRating &&
      l.fee <= maxFee &&
      (!onlyVerified || l.verified) &&
      (!q || l.name.toLowerCase().includes(q) || l.spec.toLowerCase().includes(q))
    );

    const sort = el("fSort").value;
    rows.sort((a, b) =>
      sort === "feeAsc" ? a.fee - b.fee :
      sort === "feeDesc" ? b.fee - a.fee :
      sort === "exp" ? b.exp - a.exp : b.rating - a.rating
    );

    el("resultCount").textContent = rows.length + " lawyer" + (rows.length === 1 ? "" : "s") + " found";
    el("resultsGrid").innerHTML = rows.map(listMode ? listRow : lawyerCard).join("");
    el("emptyState").classList.toggle("d-none", rows.length > 0);
  }

  ["fCity", "fSpec", "fRating", "fFee", "fVerified", "fSearch", "fSort"].forEach((id) => {
    el(id).addEventListener("input", render);
  });

  function reset() {
    el("fCity").value = ""; el("fSpec").value = ""; el("fRating").value = 0;
    el("fFee").value = 12000; el("fVerified").checked = false; el("fSearch").value = "";
    render();
  }
  el("resetFilters").addEventListener("click", reset);
  el("emptyReset").addEventListener("click", reset);

  el("gridView").addEventListener("click", function () {
    listMode = false; this.classList.add("active"); el("listView").classList.remove("active"); render();
  });
  el("listView").addEventListener("click", function () {
    listMode = true; this.classList.add("active"); el("gridView").classList.remove("active"); render();
  });

  render();
});
</script>
</body>
</html>


@endsection
