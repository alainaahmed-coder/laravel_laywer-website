<!DOCTYPE html>

<html lang="en">

<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<title>LegalEase — Find &amp; Book Verified Lawyers Online</title>

<meta name="description"
   content="LegalEase connects you with verified lawyers online.">

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
      rel="stylesheet">

<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"
      rel="stylesheet">

<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap"
      rel="stylesheet">

<link href="{{ asset('css/style.css') }}" rel="stylesheet">

</head>

<body>

<!-- ================= NAVBAR ================= -->

<nav class="navbar navbar-expand-lg navbar-legal sticky-top py-2">


<div class="container">

    <a class="navbar-brand d-flex align-items-center gap-2 ajax-link"
       href="{{ route('Home') }}">

        <span class="brand-badge">
            <i class="bi bi-bank2"></i>
        </span>

        <span class="brand-text">
            Legal<span>Ease</span>
        </span>

    </a>


    <button
        class="navbar-toggler border-0"
        type="button"
        data-bs-toggle="collapse"
        data-bs-target="#mainNav">

        <i class="bi bi-list fs-2 text-navy"></i>

    </button>


    <div class="collapse navbar-collapse" id="mainNav">

        <ul class="navbar-nav mx-lg-auto align-items-lg-center gap-lg-1">

            <li class="nav-item">

                <a
                    class="nav-link ajax-link"
                    href="{{ route('Home') }}"
                >
                    Home
                </a>

            </li>


            <li class="nav-item">

                <a
                    class="nav-link ajax-link"
                    href="{{ route('lawyerfind') }}"
                >
                    Find Lawyers
                </a>

            </li>


            <!-- Practice Areas -->

            <li class="nav-item dropdown">

                <a
                    class="nav-link dropdown-toggle"
                    href="#"
                    role="button"
                    data-bs-toggle="dropdown"
                >
                    Practice Areas
                </a>


                <ul class="dropdown-menu border-0 shadow rounded-3 p-2">

                    <li>

                        <a
                            class="dropdown-item rounded-2 ajax-link"
                            href="{{ route('lawyerfind', ['spec' => 'Criminal Law']) }}"
                        >
                            <i class="bi bi-shield-exclamation me-2 text-gold"></i>
                            Criminal
                        </a>

                    </li>


                    <li>

                        <a
                            class="dropdown-item rounded-2 ajax-link"
                            href="{{ route('lawyerfind', ['spec' => 'Civil Law']) }}"
                        >
                            <i class="bi bi-file-earmark-text me-2 text-gold"></i>
                            Civil
                        </a>

                    </li>


                    <li>

                        <a
                            class="dropdown-item rounded-2 ajax-link"
                            href="{{ route('lawyerfind', ['spec' => 'Divorce & Family']) }}"
                        >
                            <i class="bi bi-people me-2 text-gold"></i>
                            Divorce &amp; Family
                        </a>

                    </li>


                    <li>

                        <a
                            class="dropdown-item rounded-2 ajax-link"
                            href="{{ route('lawyerfind', ['spec' => 'Affidavit']) }}"
                        >
                            <i class="bi bi-pen me-2 text-gold"></i>
                            Affidavit
                        </a>

                    </li>


                    <li>

                        <a
                            class="dropdown-item rounded-2 ajax-link"
                            href="{{ route('lawyerfind', ['spec' => 'Corporate']) }}"
                        >
                            <i class="bi bi-buildings me-2 text-gold"></i>
                            Corporate
                        </a>

                    </li>

                </ul>

            </li>


            <li class="nav-item">

                <a
                    class="nav-link ajax-link"
                    href="{{ route('about') }}"
                >
                    About Us
                </a>

            </li>


            <li class="nav-item">

                <a
                    class="nav-link ajax-link"
                    href="{{ route('contact') }}"
                >
                    Contact Us
                </a>

            </li>

        </ul>


        <div class="d-flex flex-column flex-lg-row gap-2 mt-3 mt-lg-0">

            <a
                href="{{ route('register') }}"
                class="btn btn-outline-navy btn-sm px-3 py-2"
            >
                Login
            </a>


            <a
                href="{{ route('register') }}"
                class="btn btn-navy btn-sm px-3 py-2"
            >
                Register
            </a>

        </div>

    </div>

</div>


</nav>

<!-- ================= PAGE CONTENT ================= -->

<div id="ajaxContent">


@yield('user')

</div>

<!-- ================= FOOTER ================= -->

<footer class="footer">

```
<div class="container">

    <div class="row g-4">

        <div class="col-lg-4">

            <a
                class="navbar-brand d-flex align-items-center gap-2 mb-2 ajax-link"
                href="{{ route('Home') }}"
            >

                <span class="brand-badge">
                    <i class="bi bi-bank2"></i>
                </span>

                <span class="brand-text text-white">
                    Legal<span>Ease</span>
                </span>

            </a>


            <p class="small mb-0">

                Pakistan's modern legal marketplace —
                verified advocates, transparent fees
                and secure consultations.

            </p>

        </div>


        <div class="col-6 col-lg-2">

            <h4 class="h6 text-white">
                Platform
            </h4>

            <ul class="list-unstyled small d-grid gap-2 mb-0">

                <li>
                    <a
                        class="ajax-link"
                        href="{{ route('lawyerfind') }}"
                    >
                        Find Lawyers
                    </a>
                </li>

                <li>
                    <a href="{{ route('register') }}">
                        Login
                    </a>
                </li>

                <li>
                    <a href="{{ route('customerdashboard') }}">
                        Client Dashboard
                    </a>
                </li>

                <li>
                    <a href="{{ route('lawyerdashboard') }}">
                        Lawyer Panel
                    </a>
                </li>

            </ul>

        </div>


        <div class="col-6 col-lg-3">

            <h4 class="h6 text-white">
                Practice areas
            </h4>

            <ul class="list-unstyled small d-grid gap-2 mb-0">

                <li>
                    <a
                        class="ajax-link"
                        href="{{ route('lawyerfind', ['spec' => 'Criminal Law']) }}"
                    >
                        Criminal Law
                    </a>
                </li>

                <li>
                    <a
                        class="ajax-link"
                        href="{{ route('lawyerfind', ['spec' => 'Divorce & Family']) }}"
                    >
                        Divorce &amp; Family
                    </a>
                </li>

                <li>
                    <a
                        class="ajax-link"
                        href="{{ route('lawyerfind', ['spec' => 'Affidavit']) }}"
                    >
                        Affidavit
                    </a>
                </li>

                <li>
                    <a
                        class="ajax-link"
                        href="{{ route('lawyerfind', ['spec' => 'Corporate']) }}"
                    >
                        Corporate
                    </a>
                </li>

            </ul>

        </div>


        <div class="col-lg-3">

            <h4 class="h6 text-white">
                Contact
            </h4>

            <ul class="list-unstyled small d-grid gap-2 mb-0">

                <li>
                    <i class="bi bi-envelope me-2 text-gold"></i>
                    support@legalease.pk
                </li>

                <li>
                    <i class="bi bi-telephone me-2 text-gold"></i>
                    +92 300 1234567
                </li>

                <li>
                    <i class="bi bi-geo-alt me-2 text-gold"></i>
                    Blue Area, Islamabad
                </li>

            </ul>

        </div>

    </div>


    <hr class="border-secondary my-4">


    <p class="small mb-0 text-center">

        &copy;
        <span id="year"></span>
        LegalEase. All rights reserved.

    </p>

</div>
```

</footer>

<!-- ================= SCRIPTS ================= -->

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script>

document.addEventListener('DOMContentLoaded', function () {

    const content = document.getElementById('ajaxContent');


    // ==========================================
    // AJAX PAGE NAVIGATION
    // ==========================================

    document.addEventListener('click', function (e) {

        const link = e.target.closest('.ajax-link');

        if (!link) {
            return;
        }


        // New tab etc.
        if (
            e.ctrlKey ||
            e.shiftKey ||
            e.metaKey ||
            e.altKey
        ) {
            return;
        }


        const url = link.href;


        if (!url) {
            return;
        }


        const targetUrl = new URL(url);

        const currentUrl =
            new URL(window.location.href);


        // External link
        if (
            targetUrl.origin !== currentUrl.origin
        ) {
            return;
        }


        e.preventDefault();


        // Loading
        content.style.opacity = '0.5';


        fetch(url, {

            method: 'GET',

            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'text/html'
            }

        })

        .then(response => {

            if (!response.ok) {
                throw new Error(
                    'Page could not be loaded.'
                );
            }

            return response.text();

        })

        .then(html => {

            const parser =
                new DOMParser();

            const doc =
                parser.parseFromString(
                    html,
                    'text/html'
                );


            const newContent =
                doc.getElementById(
                    'ajaxContent'
                );


            if (!newContent) {

                // Agar page AJAX layout wala nahi
                // to normal navigation

                window.location.href = url;

                return;

            }


            // Replace only page content
            content.innerHTML =
                newContent.innerHTML;


            // URL change without reload
            window.history.pushState(
                {},
                '',
                url
            );


            // Scroll top
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });


            content.style.opacity = '1';


            // Mobile navbar close
            const nav =
                document.getElementById(
                    'mainNav'
                );

            if (
                nav &&
                nav.classList.contains('show')
            ) {

                const bsCollapse =
                    bootstrap.Collapse
                    .getInstance(nav);

                if (bsCollapse) {
                    bsCollapse.hide();
                }

            }

        })

        .catch(error => {

            console.error(error);

            content.style.opacity = '1';

            // Error ki surat mein normal page
            window.location.href = url;

        });

    });


    // ==========================================
    // BROWSER BACK / FORWARD
    // ==========================================

    window.addEventListener(
        'popstate',
        function () {

            const url =
                window.location.href;


            content.style.opacity = '0.5';


            fetch(url, {

                headers: {
                    'X-Requested-With':
                        'XMLHttpRequest',

                    'Accept':
                        'text/html'
                }

            })

            .then(response =>
                response.text()
            )

            .then(html => {

                const parser =
                    new DOMParser();

                const doc =
                    parser.parseFromString(
                        html,
                        'text/html'
                    );


                const newContent =
                    doc.getElementById(
                        'ajaxContent'
                    );


                if (newContent) {

                    content.innerHTML =
                        newContent.innerHTML;

                }


                content.style.opacity =
                    '1';

            })

            .catch(() => {

                window.location.reload();

            });

        }
    );


    // ==========================================
    // YEAR
    // ==========================================

    const year =
        document.getElementById('year');

    if (year) {

        year.textContent =
            new Date().getFullYear();

    }

});

</script>

</body>
</html>
