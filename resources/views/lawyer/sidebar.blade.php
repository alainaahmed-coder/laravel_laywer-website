<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Lawyer Dashboard | LegalEase</title>
  <meta name="description" content="Track active appointments, review booking history, manage profile settings and see recent consultations in your LegalEase dashboard.">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
  <link href="{{asset('css/style.css')}}" rel="stylesheet">
</head>

<body>

  {{-- Top Navigation Bar --}}
  <nav class="navbar navbar-expand-lg navbar-legal sticky-top py-2">
    <div class="container-fluid px-lg-4">
      <a class="navbar-brand d-flex align-items-center gap-2" href="#">
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
              <img src="https://i.pravatar.cc/64?img=8" class="rounded-circle" width="30" height="30" alt="Avatar"> {{ auth()->user()->name ?? 'User' }}
            </a>
            <ul class="dropdown-menu dropdown-menu-end border-0 shadow rounded-3 p-2">
              <li><a class="dropdown-item rounded-2" href="{{ route('lawyer.profiles') }}">Profile settings</a></li>
              <li>
                <hr class="dropdown-divider">
              </li>
              <li>
                <form method="POST" action="{{ route('logout') }}">
                  @csrf
                  <button type="submit" class="dropdown-item text-danger rounded-2 bg-transparent border-0">
                    <i class="bi bi-box-arrow-right me-2"></i> Log Out
                  </button>
                </form>
              </li>
            </ul>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  {{-- Main Layout Container --}}
  <div class="container-fluid px-lg-4 py-4">
    <div class="row g-4">

      {{-- Left Sidebar --}}
      <aside class="col-lg-3 col-xl-2">
        <div class="dash-sidebar">
          <p class="text-uppercase small opacity-50 px-2 mb-2">Lawyer Menu</p>
          <div class="d-grid gap-1">
            <a class="side-link {{ request()->routeIs('lawyerdashboard') ? 'active' : '' }}"
              href="{{ route('lawyerdashboard') }}">
              <i class="bi bi-grid-1x2"></i> Dashboard
            </a>

            <a class="side-link {{ request()->routeIs('lawyer.profiles') ? 'active' : '' }}"
              href="{{ route('lawyer.profiles') }}">
              <i class="bi bi-calendar2-event"></i> My Profile
            </a>

            <a class="side-link {{ request()->routeIs('lawyer.services') ? 'active' : '' }}"
              href="{{ route('lawyer.services') }}">
              <i class="bi bi-clock-history"></i> Request
            </a>

            <a class="side-link {{ request()->routeIs('lawyer.schedule') ? 'active' : '' }}"
              href="{{ route('lawyer.schedule') }}">
              <i class="bi bi-chat-left-text"></i> My Schedule
            </a>

            <a class="side-link {{ request()->routeIs('lawyer.clients') ? 'active' : '' }}"
              href="{{ route('lawyer.clients') }}">
              <i class="bi bi-people"></i> My Clients
            </a>

            <a class="side-link {{ request()->routeIs('lawyer.appointment.history') ? 'active' : '' }}"
              href="{{ route('lawyer.appointment.history') }}">
              <i class="bi bi-clock-history"></i> Appointment History
            </a>

            <a class="side-link {{ request()->routeIs('lawyer.settings') ? 'active' : '' }}"
              href="{{ route('lawyer.settings') }}">
              <i class="bi bi-gear"></i> Setting
            </a>
          </div>
          <hr class="border-secondary">
          <a href="#" class="btn btn-gold btn-sm w-100">Book new consultation</a>
        </div>
      </aside>

      {{-- Right Content Area --}}
      <main class="col-lg-9 col-xl-10">
        @yield('laywer')
      </main>

    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdn.botpress.cloud/webchat/v3.7/inject.js"></script>
  <script src="https://files.bpcontent.cloud/2026/09/03/14/20260903142716-I5516HOB.js" defer></script>

</body>

</html>