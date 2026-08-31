@extends('lawyer.sidebar')

@section('laywer')

<div class="container-fluid py-4">

    {{-- Header Banner Card (Customer Profile Style) --}}
    <div class="card border-0 shadow-sm rounded-4 overflow-hidden mb-4">
        <div class="bg-navy py-5 text-center text-white position-relative" style="background-color: #0d1b2a;">
            <div class="mb-3">
                @if(isset($lawyer) && $lawyer->image)
                    <img src="{{ asset('uploads/lawyers/' . $lawyer->image) }}"
                         alt="Lawyer Profile"
                         width="110" height="110"
                         class="rounded-circle border border-4 border-white object-fit-cover shadow-sm">
                @else
                    <div class="rounded-circle bg-light text-navy d-inline-flex align-items-center justify-content-center border border-4 border-white shadow-sm"
                         style="width: 110px; height: 110px; font-size: 38px; font-weight: bold; color: #0d1b2a;">
                        {{ strtoupper(substr(auth()->user()->name ?? 'L', 0, 1)) }}
                    </div>
                @endif
            </div>
            <h3 class="fw-bold mb-1">{{ auth()->user()->name }}</h3>
            <span class="badge bg-warning text-dark text-uppercase px-3 py-2 fw-semibold rounded-pill fs-7">LAWYER</span>
        </div>
    </div>

    {{-- Main Form Card --}}
    <div class="card border-0 shadow-sm rounded-4 bg-white p-4">

        <div class="d-flex align-items-center justify-content-between mb-4 border-bottom pb-3">
            <h4 class="fw-bold mb-0 text-navy" style="color: #0d1b2a;">
                <i class="bi bi-person-lines-fill me-2 text-warning"></i> Professional Details
            </h4>
        </div>

        {{-- Success Message --}}
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show rounded-3" role="alert">
                <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        {{-- Validation Errors --}}
        @if($errors->any())
            <div class="alert alert-danger rounded-3">
                <ul class="mb-0 ps-3">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('lawyer.profile.update') }}" enctype="multipart/form-data">
            @csrf

            <div class="row g-4">

                {{-- ================= USER INFORMATION ================= --}}

                <div class="col-md-4">
                    <div class="p-3 rounded-3 bg-light border">
                        <label class="form-label text-muted fw-semibold small text-uppercase mb-1">Full Name</label>
                        <input type="text" class="form-control bg-transparent border-0 fw-bold px-0 shadow-none text-dark" value="{{ auth()->user()->name }}" readonly>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="p-3 rounded-3 bg-light border">
                        <label class="form-label text-muted fw-semibold small text-uppercase mb-1">Email Address</label>
                        <input type="email" class="form-control bg-transparent border-0 fw-bold px-0 shadow-none text-dark" value="{{ auth()->user()->email }}" readonly>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="p-3 rounded-3 bg-light border">
                        <label class="form-label text-muted fw-semibold small text-uppercase mb-1">Phone Number</label>
                        <input type="text" class="form-control bg-transparent border-0 fw-bold px-0 shadow-none text-dark" value="{{ auth()->user()->phone ?? 'N/A' }}" readonly>
                    </div>
                </div>

                {{-- ================= LAWYER INFORMATION ================= --}}

                <div class="col-md-6">
                    <label class="form-label fw-semibold">
                        Legal Service <span class="text-danger">*</span>
                    </label>
                    <select name="service_id" class="form-select form-select-lg fs-6 rounded-3 border-light-subtle shadow-sm" required>
                        <option value="">Select Service</option>
                        @foreach($services as $service)
                            <option value="{{ $service->id }}" {{ old('service_id', $lawyer->service_id ?? '') == $service->id ? 'selected' : '' }}>
                                {{ $service->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-6">
                    <label class="form-label fw-semibold">
                        City <span class="text-danger">*</span>
                    </label>
                    <select name="city_id" class="form-select form-select-lg fs-6 rounded-3 border-light-subtle shadow-sm" required>
                        <option value="">Select City</option>
                        @foreach($cities as $city)
                            <option value="{{ $city->id }}" {{ old('city_id', $lawyer->city_id ?? '') == $city->id ? 'selected' : '' }}>
                                {{ $city->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-6">
                    <label class="form-label fw-semibold">
                        Experience <span class="text-danger">*</span>
                    </label>
                    <input type="text" name="experience" class="form-control form-control-lg fs-6 rounded-3 border-light-subtle shadow-sm"
                           value="{{ old('experience', $lawyer->experience ?? '') }}" placeholder="e.g. 5 Years, 10+ Years" required>
                </div>

                <div class="col-md-6">
                    <label class="form-label fw-semibold">
                        Consultation Fee (PKR) <span class="text-danger">*</span>
                    </label>
                    <input type="number" name="fee" class="form-control form-control-lg fs-6 rounded-3 border-light-subtle shadow-sm"
                           value="{{ old('fee', $lawyer->fee ?? '') }}" placeholder="e.g. 5000" min="0" required>
                </div>

                <div class="col-12">
                    <label class="form-label fw-semibold">Qualifications</label>
                    <input type="text" name="qualifications" class="form-control form-control-lg fs-6 rounded-3 border-light-subtle shadow-sm"
                           value="{{ old('qualifications', isset($lawyer) && is_array($lawyer->qualifications) ? implode(', ', $lawyer->qualifications) : '') }}"
                           placeholder="e.g. LL.B, LL.M, Bar at Law">
                    <small class="text-muted mt-1 d-block">Separate multiple qualifications with commas.</small>
                </div>

                <div class="col-12">
                    <label class="form-label fw-semibold">Office Address</label>
                    <textarea name="office_address" class="form-control rounded-3 border-light-subtle shadow-sm" rows="3"
                              placeholder="Enter your complete office address">{{ old('office_address', $lawyer->office_address ?? '') }}</textarea>
                </div>

                <div class="col-12">
                    <label class="form-label fw-semibold">Professional Bio</label>
                    <textarea name="bio" class="form-control rounded-3 border-light-subtle shadow-sm" rows="4"
                              placeholder="Write something about yourself and your professional experience...">{{ old('bio', $lawyer->bio ?? '') }}</textarea>
                </div>

                <div class="col-md-12">
                    <label class="form-label fw-semibold">Update Profile Image</label>
                    <input type="file" name="image" class="form-control form-control-lg fs-6 rounded-3 border-light-subtle shadow-sm" accept="image/png,image/jpeg,image/jpg">
                    <small class="text-muted mt-1 d-block">Formats: JPG, JPEG or PNG (Max size: 2MB).</small>
                </div>

                {{-- Submit Button --}}
                <div class="col-12 mt-4 text-end">
                    <button type="submit" class="btn text-white px-5 py-2.5 rounded-3 shadow-sm fw-bold" style="background-color: #0d1b2a;">
                        <i class="bi bi-check-circle me-1"></i> Save Changes
                    </button>
                </div>

            </div>
        </form>

    </div>

</div>

@endsection
