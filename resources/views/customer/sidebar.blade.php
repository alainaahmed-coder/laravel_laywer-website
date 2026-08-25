<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Client Dashboard — Appointments &amp; History | LegalEase</title>
<meta name="description" content="Track active appointments, review booking history, manage profile settings and see recent consultations in your LegalEase client dashboard.">
<meta property="og:title" content="Client Dashboard — Appointments &amp; History | LegalEase">
<meta property="og:description" content="Everything about your legal consultations in one responsive dashboard.">
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
        <li class="nav-item"><a class="nav-link" href="lawyers.html">Find Lawyers</a></li>
        <li class="nav-item"><a class="nav-link" href="dashboard-lawyer.html">Lawyer Panel</a></li>
        <li class="nav-item"><a class="nav-link" href="dashboard-admin.html">Admin Panel</a></li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle d-flex align-items-center gap-2" href="#" data-bs-toggle="dropdown">
            <img src="https://i.pravatar.cc/64?img=8" class="rounded-circle" width="30" height="30" alt="Your avatar">{{ Auth::user()->name }}
          </a>
          <ul class="dropdown-menu dropdown-menu-end border-0 shadow rounded-3 p-2">
            <li><a class="dropdown-item rounded-2" href="{{route('profile.edit')}}" data-nav="">Profile settings</a></li>
            <li><hr class="dropdown-divider"></li>
             <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>  </ul>
        </li>
      </ul>
    </div>
  </div>
</nav>



<div class="container-fluid px-lg-4 py-4">
  <div class="row g-4">
<aside class="col-lg-3 col-xl-2">
      <div class="dash-sidebar">
        <p class="text-uppercase small opacity-50 px-2 mb-2">Client menu</p>
        <div class="d-grid gap-1">
       <a class="side-link active" href="{{ route('customer.overview') }}" data-nav="overview"><i class="bi bi-grid-1x2"></i> Overview</a>
<a class="side-link" href="{{ route('customer.find.lawyer') }}" data-nav="active"><i class="bi bi-calendar2-event"></i> Find Lawyer</a>
<a class="side-link" href="{{ route('customer.my.appointments') }}" data-nav="history"><i class="bi bi-clock-history"></i> My Appointments</a>
<a class="side-link" href="{{ route('customer.my.profile') }}" data-nav="consultations"><i class="bi bi-chat-left-text"></i> My Profile</a>
<a class="side-link" href="{{ route('customer.profile.settings') }}" data-nav="settings"><i class="bi bi-gear"></i> Profile settings</a>
        </div>
        <hr class="border-secondary">
        <a href="lawyers.html" class="btn btn-gold btn-sm w-100">Book new consultation</a>
      </div>
    </aside>
    @yield('customer')
  </div>
</div>




    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
{{-- <script src="assets/js/data.js"></script>
<script src="assets/js/app.js"></script>
<script src="assets/js/dashboard.js"></script>
<script>
document.addEventListener("DOMContentLoaded", function () {
  fillSelect(document.getElementById("sCity"), CITIES, "Select city");
  document.getElementById("sCity").value = "Karachi";

  const active = APPOINTMENTS.filter((a) => a.status === "Approved" || a.status === "Pending");
  document.getElementById("activeRows").innerHTML = active.map((a) => `
    <tr>
      <td class="fw-semibold text-navy">${a.id}</td>
      <td>${a.lawyer}</td>
      <td>${a.date}<br><small class="text-muted-legal">${a.time}</small></td>
      <td>${a.mode}</td>
      <td>${money(a.fee)}</td>
      <td>${statusBadge(a.status)}</td>
      <td class="text-end"><button class="btn btn-outline-navy btn-sm">Details</button></td>
    </tr>`).join("");

  document.getElementById("historyRows").innerHTML = APPOINTMENTS.map((a) => `
    <tr>
      <td class="fw-semibold text-navy">${a.id}</td>
      <td>${a.lawyer}</td>
      <td>${a.spec}</td>
      <td>${a.date}</td>
      <td>${money(a.fee)}</td>
      <td>${statusBadge(a.status)}</td>
    </tr>`).join("");

  const done = APPOINTMENTS.filter((a) => a.status === "Completed");
  document.getElementById("recentList").innerHTML = done.map((a) => `
    <div class="d-flex justify-content-between align-items-center border-bottom pb-2">
      <div><div class="fw-semibold small text-navy">${a.lawyer}</div><small class="text-muted-legal">${a.spec} · ${a.date}</small></div>
      ${statusBadge(a.status)}
    </div>`).join("") || '<p class="text-muted-legal small mb-0">No consultations yet.</p>';

  document.getElementById("consultCards").innerHTML = done.map((a) => `
    <div class="col-md-6">
      <div class="card-legal p-4 h-100">
        <div class="d-flex justify-content-between align-items-start">
          <h2 class="h6 mb-1">${a.lawyer}</h2>${statusBadge(a.status)}
        </div>
        <p class="small text-muted-legal mb-3">${a.spec} · ${a.date} · ${a.time}</p>
        <div class="d-flex gap-2">
          <button class="btn btn-outline-navy btn-sm">View notes</button>
          <button class="btn btn-gold btn-sm">Leave review</button>
        </div>
      </div>
    </div>`).join("");
});
</script> --}}
</body>
</html>

