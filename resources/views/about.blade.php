@extends('user.navbar')

@section('user')

<style>
    .about-hero {
        background: linear-gradient(135deg, #f8f9fc 0%, #eef1f8 50%, #f8f9fc 100%);
        padding: 100px 0 80px;
        position: relative;
        overflow: hidden;
    }
    .about-hero::before {
        content: '';
        position: absolute;
        top: -120px;
        right: -120px;
        width: 400px;
        height: 400px;
        background: radial-gradient(circle, rgba(212,175,55,0.08) 0%, transparent 70%);
        border-radius: 50%;
    }
    .about-hero::after {
        content: '';
        position: absolute;
        bottom: -80px;
        left: -80px;
        width: 300px;
        height: 300px;
        background: radial-gradient(circle, rgba(15,32,65,0.04) 0%, transparent 70%);
        border-radius: 50%;
    }
    .about-badge {
        display: inline-block;
        background: rgba(212,175,55,0.12);
        color: #b8860b;
        font-size: 0.8rem;
        font-weight: 600;
        letter-spacing: 1.5px;
        text-transform: uppercase;
        padding: 6px 18px;
        border-radius: 30px;
        border: 1px solid rgba(212,175,55,0.2);
        margin-bottom: 20px;
    }
    .about-hero h1 {
        font-size: 3rem;
        font-weight: 700;
        color: #0f2041;
        line-height: 1.2;
        margin-bottom: 20px;
    }
    .about-hero p {
        font-size: 1.1rem;
        color: #5a6478;
        line-height: 1.75;
        max-width: 520px;
    }
    .hero-visual {
        position: relative;
        height: 420px;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .hero-visual-main {
        width: 260px;
        height: 320px;
        background: linear-gradient(160deg, #0f2041 0%, #1a3366 100%);
        border-radius: 20px;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        box-shadow: 0 25px 60px rgba(15,32,65,0.25);
        position: relative;
        z-index: 2;
    }
    .hero-visual-main i {
        font-size: 4rem;
        color: #d4af37;
        margin-bottom: 20px;
    }
    .hero-visual-main span {
        color: #fff;
        font-size: 1.1rem;
        font-weight: 600;
        letter-spacing: 1px;
    }
    .hero-visual-float {
        position: absolute;
        background: #fff;
        border-radius: 14px;
        box-shadow: 0 10px 40px rgba(15,32,65,0.1);
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 14px 20px;
        z-index: 3;
    }
    .hero-visual-float i {
        font-size: 1.4rem;
        color: #d4af37;
    }
    .hero-visual-float span {
        font-size: 0.85rem;
        font-weight: 600;
        color: #0f2041;
    }
    .hero-visual-float.float-1 {
        top: 20px;
        right: 0;
        animation: floatSoft 4s ease-in-out infinite;
    }
    .hero-visual-float.float-2 {
        bottom: 40px;
        left: 0;
        animation: floatSoft 4s ease-in-out infinite 1s;
    }
    .hero-visual-float.float-3 {
        top: 50%;
        right: -20px;
        transform: translateY(-50%);
        animation: floatSoft 4s ease-in-out infinite 2s;
    }
    .hero-visual-circle {
        position: absolute;
        border-radius: 50%;
        border: 2px dashed rgba(212,175,55,0.2);
        z-index: 1;
    }
    .hero-visual-circle.c1 {
        width: 350px;
        height: 350px;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
    }
    .hero-visual-circle.c2 {
        width: 420px;
        height: 420px;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        border-color: rgba(15,32,65,0.06);
    }
    @keyframes floatSoft {
        0%, 100% { transform: translateY(0); }
        50% { transform: translateY(-10px); }
    }
    .hero-visual-float.float-3 {
        animation-name: floatSoftRight;
    }
    @keyframes floatSoftRight {
        0%, 100% { transform: translateY(-50%) translateX(0); }
        50% { transform: translateY(-50%) translateX(-8px); }
    }

    .mission-card {
        background: #fff;
        border-radius: 16px;
        padding: 36px 28px;
        box-shadow: 0 4px 24px rgba(15,32,65,0.06);
        border: 1px solid rgba(15,32,65,0.06);
        transition: all 0.35s ease;
        height: 100%;
        text-align: center;
    }
    .mission-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 12px 40px rgba(15,32,65,0.12);
        border-color: rgba(212,175,55,0.2);
    }
    .mission-icon {
        width: 68px;
        height: 68px;
        border-radius: 16px;
        background: linear-gradient(135deg, rgba(15,32,65,0.06) 0%, rgba(212,175,55,0.08) 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 20px;
    }
    .mission-icon i {
        font-size: 1.6rem;
        color: #0f2041;
    }
    .mission-card:hover .mission-icon i {
        color: #d4af37;
    }
    .mission-card h5 {
        font-weight: 700;
        color: #0f2041;
        margin-bottom: 12px;
        font-size: 1.1rem;
    }
    .mission-card p {
        color: #5a6478;
        font-size: 0.92rem;
        line-height: 1.7;
        margin: 0;
    }

    .who-we-are-visual {
        background: linear-gradient(160deg, #0f2041 0%, #1a3366 100%);
        border-radius: 20px;
        padding: 50px 40px;
        position: relative;
        overflow: hidden;
        height: 100%;
        min-height: 440px;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
    }
    .who-we-are-visual::before {
        content: '';
        position: absolute;
        top: -60px;
        right: -60px;
        width: 200px;
        height: 200px;
        background: radial-gradient(circle, rgba(212,175,55,0.15) 0%, transparent 70%);
        border-radius: 50%;
    }
    .who-we-are-visual::after {
        content: '';
        position: absolute;
        bottom: -40px;
        left: -40px;
        width: 150px;
        height: 150px;
        background: radial-gradient(circle, rgba(255,255,255,0.04) 0%, transparent 70%);
        border-radius: 50%;
    }
    .who-visual-icon-row {
        display: flex;
        gap: 24px;
        margin-bottom: 30px;
        position: relative;
        z-index: 2;
    }
    .who-visual-item {
        width: 72px;
        height: 72px;
        background: rgba(255,255,255,0.08);
        border: 1px solid rgba(255,255,255,0.1);
        border-radius: 16px;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.3s ease;
    }
    .who-visual-item:hover {
        background: rgba(212,175,55,0.15);
        border-color: rgba(212,175,55,0.3);
    }
    .who-visual-item i {
        font-size: 1.5rem;
        color: #d4af37;
    }
    .who-visual-center-icon {
        width: 90px;
        height: 90px;
        background: rgba(212,175,55,0.12);
        border: 2px solid rgba(212,175,55,0.25);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 24px;
        position: relative;
        z-index: 2;
    }
    .who-visual-center-icon i {
        font-size: 2.2rem;
        color: #d4af37;
    }
    .who-visual-text {
        color: rgba(255,255,255,0.7);
        font-size: 0.9rem;
        text-align: center;
        max-width: 260px;
        position: relative;
        z-index: 2;
        line-height: 1.6;
    }

    .who-we-are-content h2 {
        font-size: 2.2rem;
        font-weight: 700;
        color: #0f2041;
        margin-bottom: 20px;
    }
    .who-we-are-content p {
        color: #5a6478;
        font-size: 1rem;
        line-height: 1.8;
        margin-bottom: 24px;
    }
    .who-feature-list {
        list-style: none;
        padding: 0;
        margin: 0;
    }
    .who-feature-list li {
        display: flex;
        align-items: flex-start;
        gap: 14px;
        padding: 10px 0;
        color: #3a4455;
        font-size: 0.95rem;
        line-height: 1.6;
    }
    .who-feature-list li i {
        color: #d4af37;
        font-size: 1.1rem;
        margin-top: 3px;
        flex-shrink: 0;
    }

    .steps-section {
        background: #f8f9fc;
    }
    .step-item {
        text-align: center;
        position: relative;
        padding: 0 15px;
    }
    .step-number {
        width: 64px;
        height: 64px;
        border-radius: 50%;
        background: linear-gradient(135deg, #0f2041 0%, #1a3366 100%);
        color: #d4af37;
        font-size: 1.2rem;
        font-weight: 700;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 20px;
        position: relative;
        z-index: 2;
        box-shadow: 0 6px 20px rgba(15,32,65,0.2);
    }
    .step-connector {
        position: absolute;
        top: 32px;
        left: calc(50% + 40px);
        width: calc(100% - 80px);
        height: 2px;
        background: linear-gradient(90deg, rgba(212,175,55,0.3), rgba(15,32,65,0.1));
        z-index: 1;
    }
    .step-item:last-child .step-connector {
        display: none;
    }
    .step-item h6 {
        font-weight: 700;
        color: #0f2041;
        margin-bottom: 8px;
        font-size: 1.05rem;
    }
    .step-item p {
        color: #5a6478;
        font-size: 0.88rem;
        line-height: 1.65;
        max-width: 220px;
        margin: 0 auto;
    }

    .stats-section {
        background: linear-gradient(135deg, #0f2041 0%, #162d5a 100%);
        position: relative;
        overflow: hidden;
    }
    .stats-section::before {
        content: '';
        position: absolute;
        top: -100px;
        right: -100px;
        width: 350px;
        height: 350px;
        background: radial-gradient(circle, rgba(212,175,55,0.08) 0%, transparent 70%);
        border-radius: 50%;
    }
    .stat-item {
        text-align: center;
        padding: 30px 15px;
        position: relative;
        z-index: 2;
    }
    .stat-number {
        font-size: 2.8rem;
        font-weight: 800;
        color: #d4af37;
        line-height: 1.1;
        margin-bottom: 8px;
    }
    .stat-label {
        color: rgba(255,255,255,0.7);
        font-size: 0.9rem;
        font-weight: 500;
        letter-spacing: 0.3px;
    }

    .value-card {
        background: #fff;
        border-radius: 18px;
        padding: 44px 32px;
        box-shadow: 0 4px 24px rgba(15,32,65,0.06);
        border: 1px solid rgba(15,32,65,0.06);
        transition: all 0.35s ease;
        height: 100%;
        text-align: center;
    }
    .value-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 14px 44px rgba(15,32,65,0.1);
        border-color: rgba(212,175,55,0.15);
    }
    .value-icon {
        width: 80px;
        height: 80px;
        border-radius: 50%;
        background: linear-gradient(135deg, rgba(15,32,65,0.05) 0%, rgba(212,175,55,0.1) 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 24px;
        transition: all 0.35s ease;
    }
    .value-card:hover .value-icon {
        background: linear-gradient(135deg, #0f2041 0%, #1a3366 100%);
    }
    .value-icon i {
        font-size: 1.8rem;
        color: #0f2041;
        transition: color 0.35s ease;
    }
    .value-card:hover .value-icon i {
        color: #d4af37;
    }
    .value-card h5 {
        font-weight: 700;
        color: #0f2041;
        margin-bottom: 14px;
        font-size: 1.2rem;
    }
    .value-card p {
        color: #5a6478;
        font-size: 0.93rem;
        line-height: 1.75;
        margin: 0;
    }

    .cta-card-legal {
        background: linear-gradient(135deg, #0f2041 0%, #1a3366 100%);
        border-radius: 24px;
        padding: 60px 50px;
        position: relative;
        overflow: hidden;
        text-align: center;
    }
    .cta-card-legal::before {
        content: '';
        position: absolute;
        top: -80px;
        right: -80px;
        width: 250px;
        height: 250px;
        background: radial-gradient(circle, rgba(212,175,55,0.12) 0%, transparent 70%);
        border-radius: 50%;
    }
    .cta-card-legal::after {
        content: '';
        position: absolute;
        bottom: -60px;
        left: -60px;
        width: 200px;
        height: 200px;
        background: radial-gradient(circle, rgba(255,255,255,0.03) 0%, transparent 70%);
        border-radius: 50%;
    }
    .cta-card-legal h2 {
        font-size: 2.2rem;
        font-weight: 700;
        color: #fff;
        margin-bottom: 16px;
        position: relative;
        z-index: 2;
    }
    .cta-card-legal p {
        color: rgba(255,255,255,0.7);
        font-size: 1.05rem;
        max-width: 500px;
        margin: 0 auto 30px;
        line-height: 1.7;
        position: relative;
        z-index: 2;
    }
    .cta-card-legal .cta-buttons {
        position: relative;
        z-index: 2;
    }

    .fade-up {
        opacity: 0;
        transform: translateY(30px);
        transition: opacity 0.7s ease, transform 0.7s ease;
    }
    .fade-up.visible {
        opacity: 1;
        transform: translateY(0);
    }

    @media (max-width: 991px) {
        .about-hero h1 {
            font-size: 2.2rem;
        }
        .hero-visual {
            height: 320px;
            margin-top: 40px;
        }
        .hero-visual-main {
            width: 200px;
            height: 260px;
        }
        .hero-visual-main i {
            font-size: 3rem;
        }
        .who-we-are-visual {
            min-height: 320px;
            padding: 40px 30px;
        }
        .who-we-are-content h2 {
            font-size: 1.8rem;
        }
        .stat-number {
            font-size: 2.2rem;
        }
        .cta-card-legal {
            padding: 40px 30px;
        }
        .cta-card-legal h2 {
            font-size: 1.8rem;
        }
    }
    @media (max-width: 767px) {
        .about-hero {
            padding: 60px 0 50px;
        }
        .about-hero h1 {
            font-size: 1.85rem;
        }
        .about-hero p {
            font-size: 0.98rem;
        }
        .hero-visual {
            height: 280px;
            margin-top: 30px;
        }
        .hero-visual-main {
            width: 170px;
            height: 220px;
        }
        .hero-visual-float {
            padding: 10px 14px;
            gap: 8px;
        }
        .hero-visual-float i {
            font-size: 1.1rem;
        }
        .hero-visual-float span {
            font-size: 0.75rem;
        }
        .hero-visual-float.float-3 {
            display: none;
        }
        .hero-visual-circle.c2 {
            display: none;
        }
        .step-connector {
            display: none !important;
        }
        .stat-number {
            font-size: 2rem;
        }
        .value-card {
            padding: 32px 22px;
        }
        .cta-card-legal h2 {
            font-size: 1.6rem;
        }
        .who-visual-icon-row {
            gap: 16px;
        }
        .who-visual-item {
            width: 58px;
            height: 58px;
        }
    }
</style>

<!-- 1. ABOUT HERO SECTION -->
<section class="about-hero">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 fade-up">
                <div class="about-badge">About LegalEase</div>
                <h1>Making Legal Help Simple, Transparent and Accessible</h1>
                <p>LegalEase connects clients with verified lawyers, making it easier to find the right legal professional, book consultations and get trusted legal guidance.</p>
                <div class="d-flex flex-wrap gap-3 mt-4">
                    <a href="{{ route('lawyerfind') }}" class="btn btn-gold px-4 py-2">Find a Lawyer</a>
                    <a href="" class="btn btn-outline-navy px-4 py-2">Book a Consultation</a>
                </div>
            </div>
            <div class="col-lg-6 d-none d-lg-block fade-up" style="transition-delay: 0.2s;">
                <div class="hero-visual">
                    <div class="hero-visual-circle c2"></div>
                    <div class="hero-visual-circle c1"></div>
                    <div class="hero-visual-main">
                        <i class="bi bi-shield-check"></i>
                        <span>LegalEase</span>
                    </div>
                    <div class="hero-visual-float float-1">
                        <i class="bi bi-person-check-fill"></i>
                        <span>Verified Lawyers</span>
                    </div>
                    <div class="hero-visual-float float-2">
                        <i class="bi bi-calendar-check-fill"></i>
                        <span>Easy Booking</span>
                    </div>
                    <div class="hero-visual-float float-3">
                        <i class="bi bi-lock-fill"></i>
                        <span>Secure</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- 2. OUR MISSION -->
<section class="section py-5">
    <div class="container">
        <div class="text-center mb-5 fade-up">
            <h2 class="section-title">Our Mission</h2>
            <p class="text-muted-legal mx-auto" style="max-width: 640px;">At LegalEase, our mission is to make quality legal assistance easier to find and easier to access. We believe everyone should be able to connect with the right legal professional without unnecessary complexity.</p>
        </div>
        <div class="row g-4">
            <div class="col-md-4 fade-up">
                <div class="mission-card">
                    <div class="mission-icon">
                        <i class="bi bi-door-open-fill"></i>
                    </div>
                    <h5>Accessible Legal Support</h5>
                    <p>Breaking down barriers so anyone can find and reach qualified legal help regardless of location or background.</p>
                </div>
            </div>
            <div class="col-md-4 fade-up" style="transition-delay: 0.15s;">
                <div class="mission-card">
                    <div class="mission-icon">
                        <i class="bi bi-patch-check-fill"></i>
                    </div>
                    <h5>Trusted Professionals</h5>
                    <p>Every lawyer on LegalEase is reviewed and verified so clients can feel confident in their choice of legal counsel.</p>
                </div>
            </div>
            <div class="col-md-4 fade-up" style="transition-delay: 0.3s;">
                <div class="mission-card">
                    <div class="mission-icon">
                        <i class="bi bi-laptop"></i>
                    </div>
                    <h5>Simple Digital Experience</h5>
                    <p>A clean, intuitive platform that takes the hassle out of searching, comparing and booking legal consultations.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- 3. WHO WE ARE -->
<section class="section pb-5">
    <div class="container">
        <div class="row align-items-center g-5">
            <div class="col-lg-5 fade-up">
                <div class="who-we-are-visual">
                    <div class="who-visual-icon-row">
                        <div class="who-visual-item">
                            <i class="bi bi-search"></i>
                        </div>
                        <div class="who-visual-item">
                            <i class="bi bi-person-badge"></i>
                        </div>
                        <div class="who-visual-item">
                            <i class="bi bi-calendar2-check"></i>
                        </div>
                    </div>
                    <div class="who-visual-center-icon">
                        <i class="bi bi-balance-scale"></i>
                    </div>
                    <p class="who-visual-text">Connecting people with the legal support they need — efficiently and securely.</p>
                </div>
            </div>
            <div class="col-lg-7 fade-up" style="transition-delay: 0.15s;">
                <div class="who-we-are-content">
                    <h2>Who We Are</h2>
                    <p>LegalEase is a digital legal platform designed to connect clients with verified lawyers across different areas of law. We bring the process of finding legal representation into a streamlined, modern experience.</p>
                    <p>Whether you are facing a personal legal matter or need professional counsel for your business, LegalEase simplifies the journey from search to consultation.</p>
                    <ul class="who-feature-list">
                        <li><i class="bi bi-check-circle-fill"></i>Smart lawyer discovery based on specialization and location</li>
                        <li><i class="bi bi-check-circle-fill"></i>Detailed lawyer profiles with qualifications and experience</li>
                        <li><i class="bi bi-check-circle-fill"></i>Seamless appointment booking with real-time availability</li>
                        <li><i class="bi bi-check-circle-fill"></i>Secure consultations to protect your privacy</li>
                        <li><i class="bi bi-check-circle-fill"></i>A client-friendly experience from start to finish</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- 4. HOW LEGAL EASE WORKS -->
<section class="section steps-section py-5">
    <div class="container">
        <div class="text-center mb-5 fade-up">
            <h2 class="section-title">How LegalEase Works</h2>
        </div>
        <div class="row g-4 justify-content-center">
            <div class="col-lg-3 col-md-6 col-6 fade-up">
                <div class="step-item">
                    <div class="step-connector"></div>
                    <div class="step-number">01</div>
                    <h6>Find a Lawyer</h6>
                    <p>Search lawyers based on specialization and location.</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-6 fade-up" style="transition-delay: 0.12s;">
                <div class="step-item">
                    <div class="step-connector"></div>
                    <div class="step-number">02</div>
                    <h6>Review Their Profile</h6>
                    <p>Explore qualifications, experience, practice areas and availability.</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-6 fade-up" style="transition-delay: 0.24s;">
                <div class="step-item">
                    <div class="step-connector"></div>
                    <div class="step-number">03</div>
                    <h6>Book an Appointment</h6>
                    <p>Choose a convenient date and available consultation slot.</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-6 fade-up" style="transition-delay: 0.36s;">
                <div class="step-item">
                    <div class="step-number">04</div>
                    <h6>Get Legal Guidance</h6>
                    <p>Connect with your lawyer and discuss your legal matter securely.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- 5. WHY CHOOSE LEGALEASE -->
<section class="section py-5">
    <div class="container">
        <div class="text-center mb-5 fade-up">
            <h2 class="section-title">Why clients choose LegalEase</h2>
            <p class="text-muted-legal mx-auto" style="max-width: 560px;">A transparent, verified and convenient way to connect with legal professionals.</p>
        </div>
        <div class="row g-4">
            <div class="col-md-6 col-lg-3 fade-up">
                <div class="card-legal h-100 text-center p-4">
                    <div class="feature-icon mb-3">
                        <i class="bi bi-shield-check"></i>
                    </div>
                    <h6 class="fw-bold mb-2" style="color: #0f2041;">Verified Lawyers</h6>
                    <p class="text-muted-legal mb-0" style="font-size: 0.9rem; line-height: 1.65;">Discover professionals whose profiles and qualifications are reviewed before being listed.</p>
                </div>
            </div>
            <div class="col-md-6 col-lg-3 fade-up" style="transition-delay: 0.12s;">
                <div class="card-legal h-100 text-center p-4">
                    <div class="feature-icon mb-3">
                        <i class="bi bi-calendar2-plus-fill"></i>
                    </div>
                    <h6 class="fw-bold mb-2" style="color: #0f2041;">Easy Appointment Booking</h6>
                    <p class="text-muted-legal mb-0" style="font-size: 0.9rem; line-height: 1.65;">Find available consultation slots and book an appointment without unnecessary phone calls.</p>
                </div>
            </div>
            <div class="col-md-6 col-lg-3 fade-up" style="transition-delay: 0.24s;">
                <div class="card-legal h-100 text-center p-4">
                    <div class="feature-icon mb-3">
                        <i class="bi bi-diagram-3-fill"></i>
                    </div>
                    <h6 class="fw-bold mb-2" style="color: #0f2041;">Multiple Practice Areas</h6>
                    <p class="text-muted-legal mb-0" style="font-size: 0.9rem; line-height: 1.65;">Connect with lawyers experienced in different areas of law and legal matters.</p>
                </div>
            </div>
            <div class="col-md-6 col-lg-3 fade-up" style="transition-delay: 0.36s;">
                <div class="card-legal h-100 text-center p-4">
                    <div class="feature-icon mb-3">
                        <i class="bi bi-people-fill"></i>
                    </div>
                    <h6 class="fw-bold mb-2" style="color: #0f2041;">Client-Focused Experience</h6>
                    <p class="text-muted-legal mb-0" style="font-size: 0.9rem; line-height: 1.65;">Designed to make finding and connecting with legal professionals simple and convenient.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- 6. STATS SECTION -->
<section class="stats-section py-5">
    <div class="container">
        <div class="row">
            <div class="col-6 col-lg-3 fade-up">
                <div class="stat-item">
                    <div class="stat-number">1,200+</div>
                    <div class="stat-label">Verified Lawyers</div>
                </div>
            </div>
            <div class="col-6 col-lg-3 fade-up" style="transition-delay: 0.1s;">
                <div class="stat-item">
                    <div class="stat-number">38,400</div>
                    <div class="stat-label">Consultations Booked</div>
                </div>
            </div>
            <div class="col-6 col-lg-3 fade-up" style="transition-delay: 0.2s;">
                <div class="stat-item">
                    <div class="stat-number">24</div>
                    <div class="stat-label">Cities Covered</div>
                </div>
            </div>
            <div class="col-6 col-lg-3 fade-up" style="transition-delay: 0.3s;">
                <div class="stat-item">
                    <div class="stat-number">4.8/5</div>
                    <div class="stat-label">Average Client Rating</div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- 7. OUR VALUES -->
<section class="section py-5">
    <div class="container">
        <div class="text-center mb-5 fade-up">
            <h2 class="section-title">Our Values</h2>
        </div>
        <div class="row g-4 justify-content-center">
            <div class="col-lg-4 col-md-6 fade-up">
                <div class="value-card">
                    <div class="value-icon">
                        <i class="bi bi-hand-thumbs-up-fill"></i>
                    </div>
                    <h5>Trust</h5>
                    <p>We believe legal services should be built on professionalism, transparency and trust.</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 fade-up" style="transition-delay: 0.15s;">
                <div class="value-card">
                    <div class="value-icon">
                        <i class="bi bi-universal-access-circle"></i>
                    </div>
                    <h5>Accessibility</h5>
                    <p>We work to make legal support easier to discover and access.</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 fade-up" style="transition-delay: 0.3s;">
                <div class="value-card">
                    <div class="value-icon">
                        <i class="bi bi-award-fill"></i>
                    </div>
                    <h5>Integrity</h5>
                    <p>We value responsible communication, confidentiality and professional conduct.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- 8. CALL TO ACTION -->
<section class="section pb-5">
    <div class="container">
        <div class="cta-card-legal fade-up">
            <h2>Need Legal Help?</h2>
            <p>Find a verified lawyer and take the next step toward resolving your legal matter.</p>
            <div class="cta-buttons d-flex flex-wrap justify-content-center gap-3">
                <a href="{{ route('lawyerfind') }}" class="btn btn-gold px-4 py-2">Find a Lawyer <i class="bi bi-arrow-right ms-1"></i></a>
                <a href="" class="btn px-4 py-2" style="background: rgba(255,255,255,0.1); color: #fff; border: 1px solid rgba(255,255,255,0.2); border-radius: 8px; transition: all 0.3s ease;" onmouseover="this.style.background='rgba(255,255,255,0.18)'" onmouseout="this.style.background='rgba(255,255,255,0.1)'">Join as a Lawyer</a>
            </div>
        </div>
    </div>
</section>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const fadeEls = document.querySelectorAll('.fade-up');
        const observer = new IntersectionObserver(function (entries) {
            entries.forEach(function (entry) {
                if (entry.isIntersecting) {
                    entry.target.classList.add('visible');
                    observer.unobserve(entry.target);
                }
            });
        }, { threshold: 0.12, rootMargin: '0px 0px -40px 0px' });
        fadeEls.forEach(function (el) {
            observer.observe(el);
        });
    });
</script>

@endsection