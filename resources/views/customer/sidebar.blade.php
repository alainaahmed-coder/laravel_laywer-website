
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Client Dashboard — Appointments & History | LegalEase</title>

    <meta name="description"
        content="Track active appointments, review booking history, manage profile settings and see recent consultations in your LegalEase client dashboard.">

    <meta property="og:title"
        content="Client Dashboard — Appointments & History | LegalEase">

    <meta property="og:description"
        content="Everything about your legal consultations in one responsive dashboard.">

    <meta property="og:type" content="website">

    <meta name="twitter:card" content="summary_large_image">


    {{-- Bootstrap --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet">

    {{-- Bootstrap Icons --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"
        rel="stylesheet">

    {{-- Google Font --}}
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap"
        rel="stylesheet">

    {{-- Custom CSS --}}
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">

</head>


<body>


    {{-- ============================================================
         NAVBAR
    ============================================================= --}}

    <nav class="navbar navbar-expand-lg navbar-legal sticky-top py-2">

        <div class="container-fluid px-lg-4">

            {{-- Brand --}}
            <a class="navbar-brand d-flex align-items-center gap-2"
                href="{{ url('/') }}">

                <span class="brand-badge">
                    <i class="bi bi-bank2"></i>
                </span>

                <span class="brand-text">
                    Legal<span>Ease</span>
                </span>

            </a>


            {{-- Mobile Toggle --}}
            <button
                class="navbar-toggler border-0"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#dashNav"
                aria-label="Toggle navigation">

                <i class="bi bi-list fs-2 text-navy"></i>

            </button>


            {{-- Navbar Menu --}}
            <div class="collapse navbar-collapse" id="dashNav">

                <ul class="navbar-nav ms-auto align-items-lg-center gap-lg-2">

                    <li class="nav-item dropdown">

                        <a
                            class="nav-link dropdown-toggle d-flex align-items-center gap-2"
                            href="#"
                            data-bs-toggle="dropdown">

                            {{-- Profile Image --}}
                            @if(Auth::user()->profile_picture)

                                <img
                                    src="{{ asset('uploads/profile/' . Auth::user()->profile_picture) }}"
                                    alt="Customer Profile"
                                    width="40"
                                    height="40"
                                    class="rounded-circle object-fit-cover">

                            @else

                                <div class="navbar-avatar">

                                    {{ strtoupper(
                                        substr(Auth::user()->name ?? 'U', 0, 1)
                                    ) }}

                                </div>

                            @endif


                            {{ Auth::user()->name ?? 'User' }}

                        </a>


                        {{-- Dropdown --}}
                        <ul class="dropdown-menu dropdown-menu-end border-0 shadow rounded-3 p-2">

                            <li>

                                <a
                                    class="dropdown-item rounded-2"
                                    href="{{ route('profile.edit') }}">

                                    <i class="bi bi-person me-2"></i>

                                    Profile Settings

                                </a>

                            </li>


                            <li>
                                <hr class="dropdown-divider">
                            </li>


                            <li>

                                <form
                                    method="POST"
                                    action="{{ route('logout') }}">

                                    @csrf

                                    <button
                                        type="submit"
                                        class="dropdown-item rounded-2">

                                        <i class="bi bi-box-arrow-right me-2"></i>

                                        Log Out

                                    </button>

                                </form>

                            </li>

                        </ul>

                    </li>

                </ul>

            </div>

        </div>

    </nav>



    {{-- ============================================================
         DASHBOARD WRAPPER
    ============================================================= --}}

    <div class="dashboard-wrapper container-fluid px-lg-4 py-4">

        <div class="row g-4 align-items-start">


            {{-- ====================================================
                 SIDEBAR
            ===================================================== --}}

            <aside class="col-lg-3 col-xl-2">

                <div class="dash-sidebar">


                    {{-- Sidebar Heading --}}
                    <p class="sidebar-heading text-uppercase small px-2 mb-3">

                        Client Menu

                    </p>


                    {{-- Sidebar Links --}}
                    <div class="d-grid gap-1">


                        {{-- Dashboard --}}
                        <a
                            class="side-link
                            {{ request()->routeIs('customer.overview') ? 'active' : '' }}"
                            href="{{ route('customer.overview') }}">

                            <i class="bi bi-grid-1x2"></i>

                            <span>Dashboard</span>

                        </a>


                        {{-- Find Lawyer --}}
                        <a
                            class="side-link
                            {{ request()->routeIs('customer.find.lawyer') ? 'active' : '' }}"
                            href="{{ route('customer.find.lawyer') }}">

                            <i class="bi bi-search"></i>

                            <span>Find Lawyer</span>

                        </a>


                        {{-- My Appointments --}}
                        <a
                            class="side-link
                            {{ request()->routeIs('customer.myappointments') ? 'active' : '' }}"
                            href="{{ route('customer.myappointments') }}">

                            <i class="bi bi-calendar2-event"></i>

                            <span>My Appointments</span>

                        </a>


                        {{-- History --}}
                        <a
                            class="side-link
                            {{ request()->routeIs('customer.history') ? 'active' : '' }}"
                            href="{{ route('customer.history') }}">

                            <i class="bi bi-clock-history"></i>

                            <span>History</span>

                        </a>


                        {{-- My Profile --}}
                        <a
                            class="side-link
                            {{ request()->routeIs('customer.my.profile') ? 'active' : '' }}"
                            href="{{ route('customer.my.profile') }}">

                            <i class="bi bi-person"></i>

                            <span>My Profile</span>

                        </a>


                        {{-- Profile Settings --}}
                        <a
                            class="side-link
                            {{ request()->routeIs('customer.profile.settings') ? 'active' : '' }}"
                            href="{{ route('customer.profile.settings') }}">

                            <i class="bi bi-gear"></i>

                            <span>Profile Settings</span>

                        </a>

                    </div>


                    {{-- Sidebar Divider --}}
                    <hr class="sidebar-divider">


                    {{-- Sidebar Bottom --}}
                    <div class="sidebar-bottom">

                        <div class="d-flex align-items-center gap-2">

                            <div class="sidebar-help-icon">

                                <i class="bi bi-shield-check"></i>

                            </div>

                            <div>

                                <small class="d-block text-white fw-semibold">
                                    LegalEase
                                </small>

                                <small class="text-white-50">
                                    Secure Legal Service
                                </small>

                            </div>

                        </div>

                    </div>

                </div>

            </aside>



            {{-- ====================================================
                 MAIN CONTENT
            ===================================================== --}}

            <main class="col-lg-9 col-xl-10 dashboard-content">

                @yield('customer')

            </main>


        </div>

    </div>



    {{-- Bootstrap JS --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js">
    </script>


</body>

</html>
