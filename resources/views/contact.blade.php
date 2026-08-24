@extends('user.navbar')

@section('user')

<style>
    .contact-hero {
        background: linear-gradient(135deg, #f8f9fc 0%, #eef1f8 50%, #f8f9fc 100%);
        padding: 100px 0 80px;
        position: relative;
        overflow: hidden;
    }
    .contact-hero::before {
        content: '';
        position: absolute;
        top: -120px;
        right: -120px;
        width: 400px;
        height: 400px;
        background: radial-gradient(circle, rgba(212,175,55,0.08) 0%, transparent 70%);
        border-radius: 50%;
    }
    .contact-hero::after {
        content: '';
        position: absolute;
        bottom: -80px;
        left: -80px;
        width: 300px;
        height: 300px;
        background: radial-gradient(circle, rgba(15,32,65,0.04) 0%, transparent 70%);
        border-radius: 50%;
    }
    .contact-badge {
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
    .contact-hero h1 {
        font-size: 3rem;
        font-weight: 700;
        color: #0f2041;
        line-height: 1.2;
        margin-bottom: 20px;
    }
    .contact-hero p {
        font-size: 1.1rem;
        color: #5a6478;
        line-height: 1.75;
        max-width: 520px;
    }
    .hero-contact-visual {
        position: relative;
        height: 420px;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .hero-contact-main {
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
    .hero-contact-main i.main-icon {
        font-size: 4rem;
        color: #d4af37;
        margin-bottom: 20px;
    }
    .hero-contact-main span {
        color: #fff;
        font-size: 1.1rem;
        font-weight: 600;
        letter-spacing: 1px;
    }
    .hero-contact-float {
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
    .hero-contact-float i {
        font-size: 1.4rem;
        color: #d4af37;
    }
    .hero-contact-float span {
        font-size: 0.85rem;
        font-weight: 600;
        color: #0f2041;
    }
    .hero-contact-float.cf-1 {
        top: 20px;
        right: 0;
        animation: floatContact 4s ease-in-out infinite;
    }
    .hero-contact-float.cf-2 {
        bottom: 40px;
        left: 0;
        animation: floatContact 4s ease-in-out infinite 1s;
    }
    .hero-contact-float.cf-3 {
        top: 50%;
        right: -20px;
        transform: translateY(-50%);
        animation: floatContactR 4s ease-in-out infinite 2s;
    }
    .hero-contact-circle {
        position: absolute;
        border-radius: 50%;
        border: 2px dashed rgba(212,175,55,0.2);
        z-index: 1;
    }
    .hero-contact-circle.hcc1 {
        width: 350px;
        height: 350px;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
    }
    .hero-contact-circle.hcc2 {
        width: 420px;
        height: 420px;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        border-color: rgba(15,32,65,0.06);
    }
    @keyframes floatContact {
        0%, 100% { transform: translateY(0); }
        50% { transform: translateY(-10px); }
    }
    @keyframes floatContactR {
        0%, 100% { transform: translateY(-50%) translateX(0); }
        50% { transform: translateY(-50%) translateX(-8px); }
    }

    .contact-option-card {
        background: #fff;
        border-radius: 16px;
        padding: 36px 28px;
        box-shadow: 0 4px 24px rgba(15,32,65,0.06);
        border: 1px solid rgba(15,32,65,0.06);
        transition: all 0.35s ease;
        height: 100%;
        text-align: center;
    }
    .contact-option-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 12px 40px rgba(15,32,65,0.12);
        border-color: rgba(212,175,55,0.2);
    }
    .contact-option-icon {
        width: 68px;
        height: 68px;
        border-radius: 50%;
        background: linear-gradient(135deg, rgba(15,32,65,0.06) 0%, rgba(212,175,55,0.08) 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 20px;
        transition: all 0.35s ease;
    }
    .contact-option-card:hover .contact-option-icon {
        background: linear-gradient(135deg, #0f2041 0%, #1a3366 100%);
    }
    .contact-option-icon i {
        font-size: 1.5rem;
        color: #0f2041;
        transition: color 0.35s ease;
    }
    .contact-option-card:hover .contact-option-icon i {
        color: #d4af37;
    }
    .contact-option-card h5 {
        font-weight: 700;
        color: #0f2041;
        margin-bottom: 10px;
        font-size: 1.1rem;
    }
    .contact-option-card p {
        color: #5a6478;
        font-size: 0.92rem;
        line-height: 1.7;
        margin-bottom: 14px;
    }
    .contact-option-card a {
        color: #d4af37;
        font-weight: 600;
        font-size: 0.95rem;
        text-decoration: none;
        transition: color 0.2s ease;
    }
    .contact-option-card a:hover {
        color: #b8860b;
    }

    .form-section-bg {
        background: #f8f9fc;
    }
    .contact-form-card {
        background: #fff;
        border-radius: 20px;
        padding: 44px 40px;
        box-shadow: 0 4px 24px rgba(15,32,65,0.06);
        border: 1px solid rgba(15,32,65,0.06);
    }
    .contact-form-card .form-label {
        font-weight: 600;
        font-size: 0.88rem;
        color: #0f2041;
        margin-bottom: 6px;
    }
    .contact-form-card .form-control,
    .contact-form-card .form-select {
        border-radius: 10px;
        border: 1.5px solid rgba(15,32,65,0.12);
        padding: 12px 16px;
        font-size: 0.95rem;
        color: #2a3142;
        background: #fafbfd;
        transition: all 0.3s ease;
    }
    .contact-form-card .form-control:focus,
    .contact-form-card .form-select:focus {
        border-color: #d4af37;
        box-shadow: 0 0 0 3px rgba(212,175,55,0.12);
        background: #fff;
        outline: none;
    }
    .contact-form-card .form-control::placeholder {
        color: #a0a8b8;
    }
    .contact-form-card textarea.form-control {
        min-height: 130px;
        resize: vertical;
    }
    .btn-submit-contact {
        background: linear-gradient(135deg, #0f2041 0%, #1a3366 100%);
        color: #d4af37;
        font-weight: 700;
        font-size: 0.95rem;
        padding: 13px 36px;
        border-radius: 10px;
        border: none;
        letter-spacing: 0.3px;
        transition: all 0.3s ease;
    }
    .btn-submit-contact:hover {
        background: linear-gradient(135deg, #162d5a 0%, #234080 100%);
        color: #e0c060;
        box-shadow: 0 6px 24px rgba(15,32,65,0.2);
    }

    .form-info-visual {
        background: linear-gradient(160deg, #0f2041 0%, #1a3366 100%);
        border-radius: 20px;
        padding: 50px 40px;
        position: relative;
        overflow: hidden;
        height: 100%;
        min-height: 440px;
        display: flex;
        flex-direction: column;
        justify-content: center;
    }
    .form-info-visual::before {
        content: '';
        position: absolute;
        top: -60px;
        right: -60px;
        width: 200px;
        height: 200px;
        background: radial-gradient(circle, rgba(212,175,55,0.15) 0%, transparent 70%);
        border-radius: 50%;
    }
    .form-info-visual::after {
        content: '';
        position: absolute;
        bottom: -40px;
        left: -40px;
        width: 150px;
        height: 150px;
        background: radial-gradient(circle, rgba(255,255,255,0.04) 0%, transparent 70%);
        border-radius: 50%;
    }
    .form-info-visual h3 {
        color: #fff;
        font-size: 1.6rem;
        font-weight: 700;
        margin-bottom: 16px;
        position: relative;
        z-index: 2;
    }
    .form-info-visual p {
        color: rgba(255,255,255,0.65);
        font-size: 0.95rem;
        line-height: 1.7;
        margin-bottom: 30px;
        position: relative;
        z-index: 2;
    }
    .form-info-item {
        display: flex;
        align-items: center;
        gap: 16px;
        margin-bottom: 20px;
        position: relative;
        z-index: 2;
    }
    .form-info-item-icon {
        width: 48px;
        height: 48px;
        border-radius: 12px;
        background: rgba(212,175,55,0.12);
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }
    .form-info-item-icon i {
        color: #d4af37;
        font-size: 1.2rem;
    }
    .form-info-item-text {
        color: rgba(255,255,255,0.85);
        font-size: 0.92rem;
        line-height: 1.5;
    }
    .form-info-item-text strong {
        display: block;
        color: #fff;
        font-weight: 600;
        margin-bottom: 2px;
    }

    .why-contact-card {
        background: #fff;
        border-radius: 16px;
        padding: 36px 28px;
        box-shadow: 0 4px 24px rgba(15,32,65,0.06);
        border: 1px solid rgba(15,32,65,0.06);
        transition: all 0.35s ease;
        height: 100%;
        text-align: center;
    }
    .why-contact-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 12px 40px rgba(15,32,65,0.12);
        border-color: rgba(212,175,55,0.2);
    }
    .why-contact-icon {
        width: 64px;
        height: 64px;
        border-radius: 14px;
        background: linear-gradient(135deg, rgba(15,32,65,0.06) 0%, rgba(212,175,55,0.08) 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 18px;
    }
    .why-contact-icon i {
        font-size: 1.4rem;
        color: #0f2041;
        transition: color 0.3s ease;
    }
    .why-contact-card:hover .why-contact-icon i {
        color: #d4af37;
    }
    .why-contact-card h5 {
        font-weight: 700;
        color: #0f2041;
        margin-bottom: 10px;
        font-size: 1.05rem;
    }
    .why-contact-card p {
        color: #5a6478;
        font-size: 0.9rem;
        line-height: 1.7;
        margin: 0;
    }

    .faq-section .accordion-button {
        font-weight: 600;
        font-size: 0.98rem;
        color: #0f2041;
        background: #fff;
        border: none;
        padding: 20px 24px;
        border-radius: 12px !important;
        box-shadow: 0 2px 12px rgba(15,32,65,0.04);
        transition: all 0.3s ease;
    }
    .faq-section .accordion-button:not(.collapsed) {
        background: #f8f9fc;
        color: #0f2041;
        box-shadow: 0 2px 12px rgba(15,32,65,0.06);
    }
    .faq-section .accordion-button::after {
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16' fill='%23d4af37'%3e%3cpath fill-rule='evenodd' d='M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z'/%3e%3c/svg%3e");
        transition: transform 0.3s ease;
    }
    .faq-section .accordion-button:focus {
        box-shadow: 0 2px 12px rgba(212,175,55,0.1);
        border-color: transparent;
    }
    .faq-section .accordion-body {
        padding: 16px 24px 20px;
        color: #5a6478;
        font-size: 0.93rem;
        line-height: 1.75;
        background: #fff;
        border-radius: 0 0 12px 12px;
    }
    .faq-section .accordion-item {
        border: none;
        margin-bottom: 12px;
        border-radius: 12px !important;
        overflow: hidden;
        box-shadow: 0 2px 12px rgba(15,32,65,0.04);
    }

    .map-placeholder {
        background: linear-gradient(160deg, #eef1f8 0%, #dde3f0 100%);
        border-radius: 20px;
        padding: 60px 40px;
        text-align: center;
        position: relative;
        overflow: hidden;
        min-height: 320px;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        border: 1px solid rgba(15,32,65,0.08);
    }
    .map-placeholder::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-image:
            linear-gradient(rgba(15,32,65,0.03) 1px, transparent 1px),
            linear-gradient(90deg, rgba(15,32,65,0.03) 1px, transparent 1px);
        background-size: 40px 40px;
    }
    .map-pin-icon {
        width: 80px;
        height: 80px;
        border-radius: 50%;
        background: linear-gradient(135deg, #0f2041 0%, #1a3366 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 20px;
        position: relative;
        z-index: 2;
        box-shadow: 0 8px 30px rgba(15,32,65,0.2);
    }
    .map-pin-icon i {
        font-size: 2rem;
        color: #d4af37;
    }
    .map-pin-icon::after {
        content: '';
        position: absolute;
        bottom: -12px;
        left: 50%;
        transform: translateX(-50%);
        width: 30px;
        height: 8px;
        background: rgba(15,32,65,0.12);
        border-radius: 50%;
    }
    .map-placeholder h5 {
        font-weight: 700;
        color: #0f2041;
        margin-bottom: 6px;
        position: relative;
        z-index: 2;
    }
    .map-placeholder p {
        color: #5a6478;
        font-size: 0.95rem;
        margin: 0;
        position: relative;
        z-index: 2;
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
        .contact-hero h1 {
            font-size: 2.2rem;
        }
        .hero-contact-visual {
            height: 320px;
            margin-top: 40px;
        }
        .hero-contact-main {
            width: 200px;
            height: 260px;
        }
        .hero-contact-main i.main-icon {
            font-size: 3rem;
        }
        .contact-form-card {
            padding: 32px 28px;
        }
        .form-info-visual {
            min-height: 300px;
            padding: 40px 30px;
            margin-bottom: 24px;
        }
        .cta-card-legal {
            padding: 40px 30px;
        }
        .cta-card-legal h2 {
            font-size: 1.8rem;
        }
    }
    @media (max-width: 767px) {
        .contact-hero {
            padding: 60px 0 50px;
        }
        .contact-hero h1 {
            font-size: 1.85rem;
        }
        .contact-hero p {
            font-size: 0.98rem;
        }
        .hero-contact-visual {
            height: 280px;
            margin-top: 30px;
        }
        .hero-contact-main {
            width: 170px;
            height: 220px;
        }
        .hero-contact-float {
            padding: 10px 14px;
            gap: 8px;
        }
        .hero-contact-float i {
            font-size: 1.1rem;
        }
        .hero-contact-float span {
            font-size: 0.75rem;
        }
        .hero-contact-float.cf-3 {
            display: none;
        }
        .hero-contact-circle.hcc2 {
            display: none;
        }
        .contact-form-card {
            padding: 28px 20px;
        }
        .form-info-visual {
            padding: 32px 24px;
            min-height: auto;
        }
        .map-placeholder {
            padding: 40px 24px;
            min-height: 260px;
        }
        .cta-card-legal h2 {
            font-size: 1.6rem;
        }
    }
</style>

<!-- 1. CONTACT HERO SECTION -->
<section class="contact-hero">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 fade-up">
                <div class="contact-badge">Get in Touch</div>
                <h1>How Can We Help You?</h1>
                <p>Have a question about finding a lawyer, booking a consultation or using LegalEase? Our team is here to help.</p>
                <div class="d-flex flex-wrap gap-3 mt-4">
                    <a href="{{ route('lawyerfind') }}" class="btn btn-gold px-4 py-2">Find a Lawyer</a>
                    <a href="#contact-form-section" class="btn btn-outline-navy px-4 py-2">Contact Support</a>
                </div>
            </div>
            <div class="col-lg-6 d-none d-lg-block fade-up" style="transition-delay: 0.2s;">
                <div class="hero-contact-visual">
                    <div class="hero-contact-circle hcc2"></div>
                    <div class="hero-contact-circle hcc1"></div>
                    <div class="hero-contact-main">
                        <i class="bi bi-chat-dots-fill main-icon"></i>
                        <span>Contact Us</span>
                    </div>
                    <div class="hero-contact-float cf-1">
                        <i class="bi bi-envelope-fill"></i>
                        <span>Email Support</span>
                    </div>
                    <div class="hero-contact-float cf-2">
                        <i class="bi bi-telephone-fill"></i>
                        <span>Call Us</span>
                    </div>
                    <div class="hero-contact-float cf-3">
                        <i class="bi bi-clock-fill"></i>
                        <span>Quick Response</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- 2. CONTACT OPTIONS -->
<section class="section py-5">
    <div class="container">
        <div class="text-center mb-5 fade-up">
            <h2 class="section-title">Let's Talk</h2>
            <p class="text-muted-legal mx-auto" style="max-width: 520px;">Choose the easiest way to reach the LegalEase team.</p>
        </div>
        <div class="row g-4 justify-content-center">
            <div class="col-md-4 fade-up">
                <div class="contact-option-card">
                    <div class="contact-option-icon">
                        <i class="bi bi-envelope"></i>
                    </div>
                    <h5>Email Support</h5>
                    <p>Send us your questions and our support team will get back to you.</p>
                    <a href="mailto:support@legalease.pk">support@legalease.pk</a>
                </div>
            </div>
            <div class="col-md-4 fade-up" style="transition-delay: 0.15s;">
                <div class="contact-option-card">
                    <div class="contact-option-icon">
                        <i class="bi bi-telephone"></i>
                    </div>
                    <h5>Call Us</h5>
                    <p>Speak with our support team for assistance with your LegalEase experience.</p>
                    <a href="tel:+923001234567">+92 300 1234567</a>
                </div>
            </div>
            <div class="col-md-4 fade-up" style="transition-delay: 0.3s;">
                <div class="contact-option-card">
                    <div class="contact-option-icon">
                        <i class="bi bi-geo-alt"></i>
                    </div>
                    <h5>Our Office</h5>
                    <p>Visit our office during business hours.</p>
                    <span style="color: #d4af37; font-weight: 600; font-size: 0.95rem;">Blue Area, Islamabad</span>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- 3. CONTACT FORM -->
<section class="section form-section-bg py-5" id="contact-form-section">
    <div class="container">
        <div class="row g-4 align-items-stretch">
            <div class="col-lg-5 fade-up">
                <div class="form-info-visual">
                    <h3>Send Us a Message</h3>
                    <p>Whether you need help with your account, have a question about our services, or want to share feedback, we'd love to hear from you.</p>
                    <div class="form-info-item">
                        <div class="form-info-item-icon">
                            <i class="bi bi-envelope-fill"></i>
                        </div>
                        <div class="form-info-item-text">
                            <strong>Email</strong>
                            support@legalease.pk
                        </div>
                    </div>
                    <div class="form-info-item">
                        <div class="form-info-item-icon">
                            <i class="bi bi-telephone-fill"></i>
                        </div>
                        <div class="form-info-item-text">
                            <strong>Phone</strong>
                            +92 300 1234567
                        </div>
                    </div>
                    <div class="form-info-item">
                        <div class="form-info-item-icon">
                            <i class="bi bi-geo-alt-fill"></i>
                        </div>
                        <div class="form-info-item-text">
                            <strong>Office</strong>
                            Blue Area, Islamabad
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-7 fade-up" style="transition-delay: 0.15s;">
                <div class="contact-form-card h-100">

                    {{-- Success Alert --}}
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    {{-- Validation Error Alerts --}}
                    @if($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert">
                            <ul class="mb-0 ps-3">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <form action="{{ route('contact.send') }}" method="POST">
                        @csrf
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label">Full Name</label>
                                <input type="text" name="name" value="{{ old('name') }}" class="form-control @error('name') is-invalid @enderror" placeholder="Enter your full name" required>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Email Address</label>
                                <input type="email" name="email" value="{{ old('email') }}" class="form-control @error('email') is-invalid @enderror" placeholder="Enter your email" required>
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Phone Number</label>
                                <input type="tel" name="phone" value="{{ old('phone') }}" class="form-control @error('phone') is-invalid @enderror" placeholder="Enter your phone number">
                                @error('phone')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Subject</label>
                                <input type="text" name="subject" value="{{ old('subject') }}" class="form-control @error('subject') is-invalid @enderror" placeholder="What is this about?" required>
                                @error('subject')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-12">
                                <label class="form-label">Message</label>
                                <textarea name="message" class="form-control @error('message') is-invalid @enderror" placeholder="Write your message here..." required>{{ old('message') }}</textarea>
                                @error('message')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-12 mt-4">
                                <button type="submit" class="btn btn-submit-contact">Send Message</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- 4. WHY CONTACT US -->
<section class="section py-5">
    <div class="container">
        <div class="text-center mb-5 fade-up">
            <h2 class="section-title">We're Here to Help</h2>
        </div>
        <div class="row g-4 justify-content-center">
            <div class="col-lg-4 col-md-6 fade-up">
                <div class="why-contact-card">
                    <div class="why-contact-icon">
                        <i class="bi bi-lightning-charge-fill"></i>
                    </div>
                    <h5>Quick Support</h5>
                    <p>Get assistance with your account, appointments and platform experience.</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 fade-up" style="transition-delay: 0.15s;">
                <div class="why-contact-card">
                    <div class="why-contact-icon">
                        <i class="bi bi-person-lines-fill"></i>
                    </div>
                    <h5>Lawyer Assistance</h5>
                    <p>Need help finding the right legal professional? Our team can guide you.</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 fade-up" style="transition-delay: 0.3s;">
                <div class="why-contact-card">
                    <div class="why-contact-icon">
                        <i class="bi bi-chat-square-text-fill"></i>
                    </div>
                    <h5>Feedback Welcome</h5>
                    <p>Your feedback helps us improve LegalEase for clients and lawyers.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- 5. FAQ -->
<section class="section py-5" style="background: #f8f9fc;">
    <div class="container">
        <div class="text-center mb-5 fade-up">
            <h2 class="section-title">Frequently Asked Questions</h2>
        </div>
        <div class="row justify-content-center">
            <div class="col-lg-8 faq-section fade-up">
                <div class="accordion" id="faqAccordion">
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#faq1">
                                How can I find a lawyer on LegalEase?
                            </button>
                        </h2>
                        <div id="faq1" class="accordion-collapse collapse show" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                You can browse verified lawyers by practice area and location, review their profiles and choose a suitable professional.
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq2">
                                How do I book a consultation?
                            </button>
                        </h2>
                        <div id="faq2" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                Open a lawyer's profile, review their available appointment slots and select a convenient time.
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq3">
                                Can I contact LegalEase support?
                            </button>
                        </h2>
                        <div id="faq3" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                Yes. You can contact our support team through email, phone or the contact form on this page.
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq4">
                                Can lawyers join LegalEase?
                            </button>
                        </h2>
                        <div id="faq4" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                Yes. Practising lawyers can register on the platform and create their professional profile.
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq5">
                                How quickly will I receive a response?
                            </button>
                        </h2>
                        <div id="faq5" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                Our support team aims to respond to customer enquiries as quickly as possible during business hours.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- 6. MAP / OFFICE AREA -->
<section class="section py-5">
    <div class="container">
        <div class="text-center mb-5 fade-up">
            <h2 class="section-title">Visit Our Office</h2>
            <p class="text-muted-legal mx-auto" style="max-width: 480px;">Blue Area, Islamabad, Pakistan</p>
        </div>
        <div class="row justify-content-center">
            <div class="col-lg-8 fade-up">
                <div class="map-placeholder">
                    <div class="map-pin-icon">
                        <i class="bi bi-geo-alt-fill"></i>
                    </div>
                    <h5>LegalEase Office</h5>
                    <p>Blue Area, Islamabad</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- 7. FINAL CTA -->
<section class="section pb-5">
    <div class="container">
        <div class="cta-card-legal fade-up">
            <h2>Need Legal Help?</h2>
            <p>Find a verified lawyer and take the next step toward resolving your legal matter.</p>
            <div class="cta-buttons d-flex flex-wrap justify-content-center gap-3">
                <a href="{{ route('lawyerfind') }}" class="btn btn-gold px-4 py-2">Find a Lawyer</a>
                <a href="{{ route('about') }}" class="btn px-4 py-2" style="background: rgba(255,255,255,0.1); color: #fff; border: 1px solid rgba(255,255,255,0.2); border-radius: 8px; transition: all 0.3s ease;" onmouseover="this.style.background='rgba(255,255,255,0.18)'" onmouseout="this.style.background='rgba(255,255,255,0.1)'">Learn About LegalEase</a>
            </div>
        </div>
    </div>
</section>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        var fadeEls = document.querySelectorAll('.fade-up');
        var observer = new IntersectionObserver(function (entries) {
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
