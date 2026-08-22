
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>LegalEase — Find &amp; Book Verified Lawyers Online</title>
<meta name="description" content="LegalEase connects you with verified criminal, family, civil, affidavit and corporate lawyers. Compare fees, read reviews and book a consultation slot instantly.">
<meta property="og:title" content="LegalEase — Find &amp; Book Verified Lawyers Online">
<meta property="og:description" content="Search verified lawyers by city and specialization, compare consultation fees and book an appointment in minutes.">
<meta property="og:type" content="website">
<meta name="twitter:card" content="summary_large_image">
<link rel="canonical" href="/site/index.html">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<link href="assets/css/style.css" rel="stylesheet">
</head>
<body>

<!-- ============ NAVBAR ============ -->
<nav class="navbar navbar-expand-lg navbar-legal sticky-top py-2">
  <div class="container">
    <a class="navbar-brand d-flex align-items-center gap-2" href="index.html">
      <span class="brand-badge"><i class="bi bi-bank2"></i></span>
      <span class="brand-text">Legal<span>Ease</span></span>
    </a>
    <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav" aria-controls="mainNav" aria-expanded="false" aria-label="Toggle navigation">
      <i class="bi bi-list fs-2 text-navy"></i>
    </button>
    <div class="collapse navbar-collapse" id="mainNav">
      <ul class="navbar-nav mx-lg-auto align-items-lg-center gap-lg-1">
        <li class="nav-item"><a class="nav-link" href="{{route('Home')}}">Home</a></li>
        <li class="nav-item"><a class="nav-link" href="{{route('lawyerfind')}}">Find Lawyers</a></li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Practice Areas</a>
          <ul class="dropdown-menu border-0 shadow rounded-3 p-2">
            <li><a class="dropdown-item rounded-2" href="lawyers.html?spec=Criminal%20Law"><i class="bi bi-shield-exclamation me-2 text-gold"></i>Criminal</a></li>
            <li><a class="dropdown-item rounded-2" href="lawyers.html?spec=Civil%20Law"><i class="bi bi-file-earmark-text me-2 text-gold"></i>Civil</a></li>
            <li><a class="dropdown-item rounded-2" href="lawyers.html?spec=Divorce%20%26%20Family"><i class="bi bi-people me-2 text-gold"></i>Divorce &amp; Family</a></li>
            <li><a class="dropdown-item rounded-2" href="lawyers.html?spec=Affidavit"><i class="bi bi-pen me-2 text-gold"></i>Affidavit</a></li>
            <li><a class="dropdown-item rounded-2" href="lawyers.html?spec=Corporate"><i class="bi bi-buildings me-2 text-gold"></i>Corporate</a></li>
          </ul>
        </li>
       
           <li class="nav-item"><a class="nav-link" href="dashboard-customer.html">About Us</a></li>
              <li class="nav-item"><a class="nav-link" href="dashboard-customer.html">Contact Us</a></li>
      </ul>
      <div class="d-flex flex-column flex-lg-row gap-2 mt-3 mt-lg-0">
        <a href="{{route('login')}}" class="btn btn-outline-navy btn-sm px-3 py-2">Login</a>
        <a href="{{route('register')}}" class="btn btn-navy btn-sm px-3 py-2">Register as Client</a>
        <a href="auth.html?tab=register&role=lawyer" class="btn btn-gold btn-sm px-3 py-2">Join as Lawyer</a>
      </div>
    </div>
  </div>
</nav>
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

@yield('user')

<!-- ============ FOOTER ============ -->
<footer class="footer">
  <div class="container">
    <div class="row g-4">
      <div class="col-lg-4">
        <a class="navbar-brand d-flex align-items-center gap-2 mb-2" href="index.html">
          <span class="brand-badge"><i class="bi bi-bank2"></i></span>
          <span class="brand-text text-white">Legal<span>Ease</span></span>
        </a>
        <p class="small mb-0">Pakistan's modern legal marketplace — verified advocates, transparent fees and secure consultations.</p>
      </div>
      <div class="col-6 col-lg-2">
        <h4 class="h6 text-white">Platform</h4>
        <ul class="list-unstyled small d-grid gap-2 mb-0">
          <li><a href="lawyers.html">Find Lawyers</a></li>
          <li><a href="auth.html">Login</a></li>
          <li><a href="dashboard-customer.html">Client Dashboard</a></li>
          <li><a href="dashboard-lawyer.html">Lawyer Panel</a></li>
        </ul>
      </div>
      <div class="col-6 col-lg-3">
        <h4 class="h6 text-white">Practice areas</h4>
        <ul class="list-unstyled small d-grid gap-2 mb-0">
          <li><a href="lawyers.html?spec=Criminal%20Law">Criminal Law</a></li>
          <li><a href="lawyers.html?spec=Divorce%20%26%20Family">Divorce &amp; Family</a></li>
          <li><a href="lawyers.html?spec=Affidavit">Affidavit</a></li>
          <li><a href="lawyers.html?spec=Corporate">Corporate</a></li>
        </ul>
      </div>
      <div class="col-lg-3">
        <h4 class="h6 text-white">Contact</h4>
        <ul class="list-unstyled small d-grid gap-2 mb-0">
          <li><i class="bi bi-envelope me-2 text-gold"></i>support@legalease.pk</li>
          <li><i class="bi bi-telephone me-2 text-gold"></i>+92 300 1234567</li>
          <li><i class="bi bi-geo-alt me-2 text-gold"></i>Blue Area, Islamabad</li>
        </ul>
      </div>
    </div>
    <hr class="border-secondary my-4">
    <p class="small mb-0 text-center">&copy; <span id="year"></span> LegalEase. All rights reserved.</p>
  </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="assets/js/data.js"></script>
<script src="assets/js/app.js"></script>
<script>
  document.addEventListener("DOMContentLoaded", function () {
    fillSelect(document.getElementById("heroCity"), CITIES, "All cities");
    fillSelect(document.getElementById("heroSpec"), SPECIALIZATIONS, "All specializations");
    const featured = LAWYERS.slice().sort((a, b) => b.rating - a.rating).slice(0, 6);
    document.getElementById("featuredGrid").innerHTML = featured.map(lawyerCard).join("");
  });
</script>
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
