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

    <!-- Original Navy Blue Sidebar Layout -->
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

    <!-- Main Section Alignment -->
    <main class="col-lg-9 col-xl-10">
      @yield('admin')
    </main>

  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
