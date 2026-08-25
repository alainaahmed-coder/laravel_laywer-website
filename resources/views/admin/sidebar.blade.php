<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Admin Panel — Platform &amp; Lawyer Management | LegalEase</title>
<meta name="description" content="Approve lawyer profiles, manage customers, practice areas and homepage content, and audit system-wide appointment logs from the LegalEase admin panel.">
<meta property="og:title" content="Admin Panel — Platform &amp; Lawyer Management | LegalEase">
<meta property="og:description" content="Full operational control over the LegalEase marketplace.">
<meta property="og:type" content="website">
<meta name="twitter:card" content="summary_large_image">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<link href="{{asset('css/style.css')}}" rel="stylesheet">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-legal sticky-top py-2">
  <div class="container-fluid px-lg-4">
    <a class="navbar-brand d-flex align-items-center gap-2" href="index.html">
      <span class="brand-badge"><i class="bi bi-bank2"></i></span>
      <span class="brand-text">Legal<span>Ease</span></span>
    </a>
    <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#dashNav" aria-label="Toggle navigation">
      <i class="bi bi-list fs-2 text-navy"></i>
    </button>
    <div class="collapse navbar-collapse" id="dashNav">
      <ul class="navbar-nav ms-auto align-items-lg-center gap-lg-2">
        <li class="nav-item"><a class="nav-link" href="dashboard-customer.html">Client Dashboard</a></li>
        <li class="nav-item"><a class="nav-link" href="dashboard-lawyer.html">Lawyer Panel</a></li>
         <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
      </ul>
    </div>
  </div>
</nav>



<div class="container-fluid px-lg-4 py-4">
  <div class="row g-4">

 <aside class="col-lg-3 col-xl-2">
      <div class="dash-sidebar">
        <p class="text-uppercase small opacity-50 px-2 mb-2">Administration</p>
        <div class="d-grid gap-1">
      <a class="side-link" href="{{ route('admin.approvals') }}" data-nav="approvals"><i class="bi bi-patch-check"></i> Lawyer approvals</a>
<a class="side-link" href="{{ route('admin.customers') }}" data-nav="lawyers"><i class="bi bi-briefcase"></i> Customers</a>
<a class="side-link" href="{{ route('admin.cities') }}" data-nav="customers"><i class="bi bi-people"></i> Cities </a>
<a class="side-link" href="{{ route('admin.services') }}" data-nav="logs"><i class="bi bi-journal-text"></i> Services</a>
<a class="side-link" href="{{ route('admin.schedules') }}" data-nav="areas"><i class="bi bi-tags"></i> Schedules</a>
<a class="side-link" href="{{ route('admin.appointments') }}" data-nav="content"><i class="bi bi-layout-text-window"></i> Appointments</a>
<a class="side-link" href="{{ route('admin.website.content') }}" data-nav="website"><i class="bi bi-layout-text-window"></i> Website Content</a>
<a class="side-link" href="{{ route('admin.settings') }}" data-nav="setting"><i class="bi bi-layout-text-window"></i> Setting</a>
        </div>
      </div>
    </aside>
    @yield('admin')

     </div>
</div>





<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
{{-- <script src="assets/js/data.js"></script>
<script src="assets/js/app.js"></script>
<script src="assets/js/dashboard.js"></script>
<script>
document.addEventListener("DOMContentLoaded", function () {
  const el = (i) => document.getElementById(i);

  el("activityList").innerHTML = APPOINTMENTS.map((a) => `
    <div class="d-flex flex-wrap justify-content-between align-items-center gap-2 border-bottom pb-2">
      <div><div class="fw-semibold small text-navy">${a.client} → ${a.lawyer}</div><small class="text-muted-legal">${a.id} · ${a.date} · ${a.mode}</small></div>
      ${statusBadge(a.status)}
    </div>`).join("");

  const dist = [["Criminal Law", 34], ["Divorce & Family", 26], ["Civil Law", 19], ["Affidavit", 13], ["Corporate", 8]];
  el("areaBars").innerHTML = dist.map(([n, v]) => `
    <div>
      <div class="d-flex justify-content-between small"><span>${n}</span><span class="fw-semibold">${v}%</span></div>
      <div class="progress mt-1" style="height:8px"><div class="progress-bar bg-gold" style="width:${v}%"></div></div>
    </div>`).join("");

  const pendingProfiles = LAWYERS.filter((l) => !l.verified);
  el("approvalCards").innerHTML = pendingProfiles.map((l) => `
    <div class="col-md-6 col-xl-4">
      <div class="card-legal p-4 h-100" data-card="${l.id}">
        <div class="d-flex gap-3 align-items-center">
          <img src="${l.img}" class="avatar" alt="Portrait of ${l.name}">
          <div><h2 class="h6 mb-1">${l.name}</h2><span class="badge-spec small">${l.spec}</span></div>
        </div>
        <ul class="list-unstyled small text-muted-legal mt-3 mb-3">
          <li><i class="bi bi-geo-alt me-1 text-gold"></i>${l.city}</li>
          <li><i class="bi bi-card-text me-1 text-gold"></i>${l.quals[1] || l.quals[0]}</li>
          <li><i class="bi bi-briefcase me-1 text-gold"></i>${l.exp} years experience</li>
        </ul>
        <div class="d-flex gap-2">
          <button class="btn btn-gold btn-sm flex-grow-1" data-act="approve">Approve</button>
          <button class="btn btn-outline-navy btn-sm flex-grow-1" data-act="reject">Reject</button>
        </div>
      </div>
    </div>`).join("") || '<div class="col-12"><div class="empty-state"><i class="bi bi-patch-check fs-1 text-gold"></i><h2 class="h5 mt-3">No profiles awaiting review</h2><p class="mb-0">All lawyer submissions have been processed.</p></div></div>';

  el("approvalCards").addEventListener("click", function (e) {
    const btn = e.target.closest("[data-act]");
    if (!btn) return;
    const card = btn.closest("[data-card]");
    card.innerHTML = `<div class="text-center py-5"><i class="bi bi-${btn.dataset.act === "approve" ? "check-circle-fill text-success" : "x-circle-fill text-danger"} fs-1"></i><p class="small text-muted-legal mt-2 mb-0">Profile ${btn.dataset.act === "approve" ? "approved and published" : "rejected"}.</p></div>`;
  });

  function renderLawyers(q) {
    const rows = LAWYERS.filter((l) => !q || l.name.toLowerCase().includes(q));
    el("lawyerRows").innerHTML = rows.map((l) => `
      <tr>
        <td class="d-flex align-items-center gap-2"><img src="${l.img}" width="34" height="34" class="rounded-circle" alt=""> <span class="fw-semibold text-navy">${l.name}</span></td>
        <td>${l.spec}</td><td>${l.city}</td><td>${money(l.fee)}</td>
        <td><span class="rating">${stars(l.rating)}</span></td>
        <td>${l.verified ? statusBadge("Approved") : statusBadge("Pending")}</td>
        <td class="text-end">
          <div class="dropdown">
            <button class="btn btn-outline-navy btn-sm dropdown-toggle" data-bs-toggle="dropdown">Actions</button>
            <ul class="dropdown-menu dropdown-menu-end border-0 shadow rounded-3 p-2">
              <li><a class="dropdown-item rounded-2" href="lawyer-profile.html?id=${l.id}">View profile</a></li>
              <li><a class="dropdown-item rounded-2" href="#">Edit details</a></li>
              <li><a class="dropdown-item rounded-2 text-danger" href="#">Suspend account</a></li>
            </ul>
          </div>
        </td>
      </tr>`).join("");
  }
  renderLawyers("");
  el("lawyerSearch").addEventListener("input", (e) => renderLawyers(e.target.value.toLowerCase()));

  const customers = [
    ["Hamza Yousaf", "hamza@example.com", "Karachi", 9, "Approved"],
    ["Nadia Sultan", "nadia@example.com", "Lahore", 4, "Approved"],
    ["Imran Qureshi", "imran@example.com", "Islamabad", 2, "Approved"],
    ["Rabia Aslam", "rabia@example.com", "Faisalabad", 1, "Pending"],
    ["Owais Sheikh", "owais@example.com", "Multan", 6, "Cancelled"]
  ];
  el("customerRows").innerHTML = customers.map((c) => `
    <tr><td class="fw-semibold text-navy">${c[0]}</td><td>${c[1]}</td><td>${c[2]}</td><td>${c[3]}</td><td>${statusBadge(c[4])}</td>
    <td class="text-end"><button class="btn btn-outline-navy btn-sm">Manage</button></td></tr>`).join("");

  function renderLogs(status) {
    const rows = APPOINTMENTS.filter((a) => !status || a.status === status);
    el("logRows").innerHTML = rows.map((a) => `
      <tr><td class="fw-semibold text-navy">${a.id}</td><td>${a.client}</td><td>${a.lawyer}</td><td>${a.date}</td><td>${a.mode}</td><td>${money(a.fee)}</td><td>${statusBadge(a.status)}</td></tr>`).join("");
  }
  renderLogs("");
  el("logFilter").addEventListener("change", (e) => renderLogs(e.target.value));

  let areas = SPECIALIZATIONS.slice();
  function renderAreas() {
    el("areaCards").innerHTML = areas.map((a, i) => `
      <div class="col-md-6 col-xl-4">
        <div class="card-legal p-4 d-flex flex-row justify-content-between align-items-center">
          <div><h2 class="h6 mb-1">${a}</h2><small class="text-muted-legal">${LAWYERS.filter((l) => l.spec === a).length} lawyers listed</small></div>
          <button class="btn btn-outline-navy btn-sm" data-remove="${i}"><i class="bi bi-trash"></i></button>
        </div>
      </div>`).join("");
  }
  renderAreas();
  el("areaCards").addEventListener("click", function (e) {
    const btn = e.target.closest("[data-remove]");
    if (!btn) return;
    areas.splice(parseInt(btn.dataset.remove, 10), 1);
    renderAreas();
  });
  el("addArea").addEventListener("click", function () {
    const v = el("newArea").value.trim();
    if (v) { areas.push(v); el("newArea").value = ""; renderAreas(); }
  });
});
</script> --}}
</body>
</html>
