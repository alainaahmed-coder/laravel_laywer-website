@extends('user.navbar')

@section('user')
<style>
    .legalease-bg { background-color: #0c1821; color: #ffffff; }
    .gold-text { color: #d39e25; }
    .gold-bg { background-color: #d39e25; color: #000; font-weight: 600; border: none; }
    .gold-bg:hover { background-color: #b8881e; color: #000; }
    .card-custom { background-color: #142433; border: 1px solid #22374a; border-radius: 12px; }
    .form-control-custom { background-color: #0c1821; border: 1px solid #22374a; color: #fff; }
    .form-control-custom:focus { background-color: #0c1821; border-color: #d39e25; color: #fff; box-shadow: none; }
</style>

<div class="legalease-bg py-5">
    <div class="container py-4">
        <div class="text-center mb-5">
            <h1 class="display-5 fw-bold mb-2 text-light">Get in Touch with <span class="gold-text">LegalEase</span></h1>
            <p class="">Have questions about consultation bookings or joining as a legal partner? We are here to help.</p>
        </div>

        <div class="row g-4">
            <!-- Contact Details -->
            <div class="col-lg-4">
                <div class="card-custom p-4 h-100">
                    <h4 class="fw-bold mb-4 gold-text">Contact Information</h4>

                    <div class="mb-4">
                        <h6 class="fw-bold mb-1">Headquarters</h6>
                        <p class="gold-text small">LegalEase Tower, Main Shahrah-e-Faisal, Karachi, Pakistan</p>
                    </div>

                    <div class="mb-4">
                        <h6 class="fw-bold mb-1">Support Email</h6>
                        <p class="gold-text small">support@legalease.pk</p>
                    </div>

                    <div class="mb-4">
                        <h6 class="fw-bold mb-1">Helpline Phone</h6>
                        <p class=" gold-text small">+92 (21) 111-534-253</p>
                    </div>

                    <div>
                        <h6 class="fw-bold mb-1">Operating Hours</h6>
                        <p class="  gold-text small mb-0">Monday – Saturday: 9:00 AM – 6:00 PM PKT</p>
                    </div>
                </div>
            </div>

            <!-- Contact Form -->
            <div class="col-lg-8">
                <div class="card-custom p-4">
                    @if(session('success'))
                        <div class="alert alert-success bg-dark text-success border-success mb-4">
                            {{ session('success') }}
                        </div>
                    @endif

                    <form action="{{ route('contact.send') }}" method="POST">
                        @csrf
                        <div class="row g-3 ">
                            <div class="col-md-6 ">
                                <label class="form-label ">Your Full Name</label>
                                <input type="text" name="name" class="form-control form-control-custom " placeholder ="Advocate / Client Name" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label ">Email Address</label>
                                <input type="email" name="email" class="form-control form-control-custom" placeholder="name@example.com" required>
                            </div>
                            <div class="col-12">
                                <label class="form-label ">Subject</label>
                                <input type="text" name="subject" class="form-control form-control-custom" placeholder="How can we assist you?" required>
                            </div>
                            <div class="col-12">
                                <label class="form-label ">Message</label>
                                <textarea name="message" rows="5" class="form-control form-control-custom" placeholder="Type your query in detail..." required></textarea>
                            </div>
                            <div class="col-12">
                                <button type="submit" class="btn gold-bg px-4 py-2 w-100">Send Message</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
