@extends('admin.sidebar') {{-- Ya aapka jo bhi main admin layout hai --}}

@section('admin')
<div class="container-fluid p-4">
    <h3 class="fw-bold mb-4">Manage Landing Page Content</h3>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('admin.website_content.update') }}" method="POST">
        @csrf

        <!-- HERO SECTION -->
        <div class="card shadow-sm border-0 mb-4">
            <div class="card-header bg-navy text-white fw-bold">Hero Section</div>
            <div class="card-body">
                <div class="mb-3">
                    <label class="form-label fw-semibold">Hero Eyebrow Text</label>
                    <input type="text" name="hero_eyebrow" class="form-control"
                           value="{{ $contents['hero_eyebrow'] ?? '1,200+ verified advocates across Pakistan' }}">
                </div>
                <div class="mb-3">
                    <label class="form-label fw-semibold">Hero Main Title (Heading)</label>
                    <input type="text" name="hero_title" class="form-control"
                           value="{{ $contents['hero_title'] ?? 'Find & Book Top Legal Experts Instantly' }}">
                </div>
                <div class="mb-3">
                    <label class="form-label fw-semibold">Hero Description / Subtitle</label>
                    <textarea name="hero_subtitle" class="form-control" rows="3">{{ $contents['hero_subtitle'] ?? 'Compare verified lawyers by specialization, city, experience and consultation fee — then lock a confirmed appointment slot in under two minutes.' }}</textarea>
                </div>
            </div>
        </div>

        <!-- STATS SECTION -->
        <div class="card shadow-sm border-0 mb-4">
            <div class="card-header bg-navy text-white fw-bold">Statistics Bar</div>
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-md-3">
                        <label class="form-label">Lawyers Stat Count</label>
                        <input type="text" name="stat_lawyers" class="form-control" value="{{ $contents['stat_lawyers'] ?? '1,200+' }}">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Consultations Count</label>
                        <input type="text" name="stat_consultations" class="form-control" value="{{ $contents['stat_consultations'] ?? '38,400' }}">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Cities Count</label>
                        <input type="text" name="stat_cities" class="form-control" value="{{ $contents['stat_cities'] ?? '24 cities' }}">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Client Rating</label>
                        <input type="text" name="stat_rating" class="form-control" value="{{ $contents['stat_rating'] ?? '4.8/5' }}">
                    </div>
                </div>
            </div>
        </div>

        <!-- CTA SECTION -->
        <div class="card shadow-sm border-0 mb-4">
            <div class="card-header bg-navy text-white fw-bold">Call to Action (Lawyer Join Banner)</div>
            <div class="card-body">
                <div class="mb-3">
                    <label class="form-label fw-semibold">CTA Title</label>
                    <input type="text" name="cta_title" class="form-control" value="{{ $contents['cta_title'] ?? 'Are you a practising advocate?' }}">
                </div>
                <div class="mb-3">
                    <label class="form-label fw-semibold">CTA Subtitle</label>
                    <textarea name="cta_subtitle" class="form-control" rows="2">{{ $contents['cta_subtitle'] ?? 'List your practice, manage your availability calendar and receive verified client appointments directly in your panel.' }}</textarea>
                </div>
            </div>
        </div>

        <button type="submit" class="btn btn-warning btn-lg fw-bold px-4">Save Changes</button>
    </form>
</div>
@endsection
