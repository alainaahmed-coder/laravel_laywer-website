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

  <!-- SVG Icon Fix -->
  <style>
    svg {
      width: 16px !important;
      height: 16px !important;
      display: inline-block !important;
      vertical-align: middle !important;
    }
    /* Latest Appointments */
.latest-appointments {
    background: #ffffff;
    border: 1px solid #e2e8f0;
    border-radius: 16px;
    overflow: hidden;
    box-shadow: 0 2px 8px rgba(15, 23, 42, 0.05);
}

.latest-appointments table {
    width: 100%;
    border-collapse: collapse;
}

.latest-appointments thead tr {
    background: #0f172a !important;
}

.latest-appointments thead th {
    color: #cbd5e1 !important;
    background: #0f172a !important;
    padding: 12px 16px;
    font-size: 11px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: .06em;
    white-space: nowrap;
}

.latest-appointments tbody tr {
    border-bottom: 1px solid #f1f5f9;
    transition: .2s ease;
}

.latest-appointments tbody tr:hover {
    background: #fffbeb !important;
}

.latest-appointments tbody td {
    padding: 12px 16px;
    font-size: 12px;
    color: #475569;
}

/* ID */
.appointment-id {
    display: inline-block;
    padding: 4px 8px;
    background: #f1f5f9;
    color: #334155;
    border: 1px solid #e2e8f0;
    border-radius: 7px;
    font-size: 10px;
    font-weight: 700;
}

/* Customer */
.customer-dot {
    width: 6px;
    height: 6px;
    background: #f59e0b;
    border-radius: 50%;
    display: inline-block;
    margin-right: 7px;
}

.customer-name,
.lawyer-name {
    color: #0f172a !important;
    font-weight: 700;
}

/* Lawyer */
.lawyer-dot {
    width: 6px;
    height: 6px;
    background: #0f172a;
    border-radius: 50%;
    display: inline-block;
    margin-right: 7px;
}

/* Meeting Type */
.meeting-type {
    display: inline-block;
    padding: 4px 8px;
    background: #fffbeb;
    color: #b45309;
    border: 1px solid #fde68a;
    border-radius: 7px;
    font-size: 10px;
    font-weight: 700;
}

/* Approved */
.status-approved {
    display: inline-flex;
    align-items: center;
    gap: 5px;
    padding: 5px 9px;
    background: #ecfdf5;
    color: #047857;
    border: 1px solid #a7f3d0;
    border-radius: 7px;
    font-size: 10px;
    font-weight: 700;
}

/* Rejected */
.status-rejected {
    display: inline-flex;
    align-items: center;
    gap: 5px;
    padding: 5px 9px;
    background: #fef2f2;
    color: #b91c1c;
    border: 1px solid #fecaca;
    border-radius: 7px;
    font-size: 10px;
    font-weight: 700;
}

/* Status Dot */
.status-dot {
    width: 6px;
    height: 6px;
    border-radius: 50%;
}

.status-approved .status-dot {
    background: #10b981;
}

.status-rejected .status-dot {
    background: #ef4444;
}

/* View All */
.latest-view-all {
    background: #0f172a !important;
    color: #f59e0b !important;
    border: 1px solid #0f172a !important;
    font-weight: 700;
}

.latest-view-all:hover {
    background: #f59e0b !important;
    color: #0f172a !important;
}
  </style>
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
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle d-flex align-items-center gap-2" href="#" data-bs-toggle="dropdown">
              <img src="https://i.pravatar.cc/64?img=8" class="rounded-circle" width="30" height="30" alt="Your avatar">{{ Auth::user()->name }}
            </a>
            <ul class="dropdown-menu dropdown-menu-end border-0 shadow rounded-3 p-2">
              <li><a class="dropdown-item rounded-2" href="{{route('profile.edit')}}" data-nav="">Profile settings</a></li>
              <li>
                <hr class="dropdown-divider">
              </li>
              <form method="POST" action="{{ route('logout') }}">
                @csrf

                <x-dropdown-link :href="route('logout')"
                  onclick="event.preventDefault();
                                                this.closest('form').submit();">
                  {{ __('Log Out') }}
                </x-dropdown-link>
              </form>
            </ul>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <div class="container-fluid px-lg-4 py-4">
    <div class="row g-4">

      <!-- Original Navy Blue Sidebar Layout -->
      <aside class="col-lg-3 col-xl-2">
        <div class="dash-sidebar">
          <p class="text-uppercase small opacity-50 px-2 mb-2">Administration</p>
          <div class="d-grid gap-1">

            <a class="side-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}"
              href="{{ route('admin.dashboard') }}">
              <i class="bi bi-grid-1x2"></i> Dashboard
            </a>
            <a class="side-link {{ request()->routeIs('customers.index') ? 'active' : '' }}"
              href="{{ route('customers.index') }}">
              <i class="bi bi-people"></i> Customers
            </a>

            <a class="side-link {{ request()->routeIs('admin.cities') ? 'active' : '' }}"
              href="{{ route('admin.cities') }}">
              <i class="bi bi-building"></i> Cities
            </a>

            <a class="side-link {{ request()->routeIs('admin.services') ? 'active' : '' }}"
              href="{{ route('admin.services') }}">
              <i class="bi bi-journal-text"></i> Services
            </a>

            <a class="side-link {{ request()->routeIs('admin.lawyers') ? 'active' : '' }}"
              href="{{ route('admin.lawyers') }}">
              <i class="bi bi-people"></i> Lawyers
            </a>

            <a class="side-link {{ request()->routeIs('admin.appointments') ? 'active' : '' }}"
              href="{{ route('admin.appointments') }}">
              <i class="bi bi-calendar-check"></i> Appointments
            </a>

            <a class="side-link {{ request()->routeIs('admin.History') ? 'active' : '' }}"
              href="{{ route('admin.History') }}">
              <i class="bi bi-clock-history"></i> History
            </a>

            <a class="side-link {{ request()->routeIs('admin.website.content') ? 'active' : '' }}"
              href="{{ route('admin.website_content') }}">
              <i class="bi bi-layout-text-window"></i> Website Content
            </a>

            <a class="side-link {{ request()->routeIs('admin.settings') ? 'active' : '' }}"
              href="{{ route('admin.settings') }}">
              <i class="bi bi-gear"></i> Setting
            </a>

          </div>

        </div>
      </aside>

      <!-- Main Section Alignment -->
      <main class="col-lg-9 col-xl-10">
        @yield('admin')
      </main>

    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>