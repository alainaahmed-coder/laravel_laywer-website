
@extends('lawyer.sidebar')

@section('laywer')

<div class="col-lg-9 col-xl-10">

    <div class="card-legal p-4">

        <div class="mb-4">
            <h2 class="text-navy mb-1">My Profile</h2>
            <p class="text-muted mb-0">
                Manage your professional lawyer profile.
            </p>
        </div>

        {{-- Success Message --}}
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        {{-- Validation Errors --}}
        @if($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST"
              action="{{ route('lawyer.profile.update') }}"
              enctype="multipart/form-data">

            @csrf

            <div class="row g-3">

                {{-- ================= USER INFORMATION ================= --}}

                {{-- Name --}}
                <div class="col-md-6">
                    <label class="form-label">Name</label>

                    <input
                        type="text"
                        class="form-control"
                        value="{{ auth()->user()->name }}"
                        readonly>
                </div>

                {{-- Email --}}
                <div class="col-md-6">
                    <label class="form-label">Email</label>

                    <input
                        type="email"
                        class="form-control"
                        value="{{ auth()->user()->email }}"
                        readonly>
                </div>

                {{-- Phone --}}
                <div class="col-md-6">
                    <label class="form-label">Phone</label>

                    <input
                        type="text"
                        class="form-control"
                        value="{{ auth()->user()->phone }}"
                        readonly>
                </div>


                {{-- ================= LAWYER INFORMATION ================= --}}

                {{-- Service --}}
                <div class="col-md-6">
                    <label class="form-label">
                        Legal Service <span class="text-danger">*</span>
                    </label>

                    <select name="service_id"
                            class="form-select"
                            required>

                        <option value="">Select Service</option>

                        @foreach($services as $service)

                            <option
                                value="{{ $service->id }}"
                                {{ old('service_id', $lawyer->service_id ?? '') == $service->id ? 'selected' : '' }}>

                                {{ $service->name }}

                            </option>

                        @endforeach

                    </select>
                </div>


                {{-- City --}}
                <div class="col-md-6">
                    <label class="form-label">
                        City <span class="text-danger">*</span>
                    </label>

                    <select name="city_id"
                            class="form-select"
                            required>

                        <option value="">Select City</option>

                        @foreach($cities as $city)

                            <option
                                value="{{ $city->id }}"
                                {{ old('city_id', $lawyer->city_id ?? '') == $city->id ? 'selected' : '' }}>

                                {{ $city->name }}

                            </option>

                        @endforeach

                    </select>
                </div>


                {{-- Experience --}}
                <div class="col-md-6">
                    <label class="form-label">
                        Experience <span class="text-danger">*</span>
                    </label>

                    <input
                        type="text"
                        name="experience"
                        class="form-control"
                        value="{{ old('experience', $lawyer->experience ?? '') }}"
                        placeholder="e.g. 5 Years, 10+ Years"
                        required>
                </div>


                {{-- Consultation Fee --}}
                <div class="col-md-6">
                    <label class="form-label">
                        Consultation Fee <span class="text-danger">*</span>
                    </label>

                    <input
                        type="number"
                        name="fee"
                        class="form-control"
                        value="{{ old('fee', $lawyer->fee ?? '') }}"
                        placeholder="e.g. 5000"
                        min="0"
                        required>
                </div>


                {{-- Office Address --}}
                <div class="col-12">
                    <label class="form-label">
                        Office Address
                    </label>

                    <textarea
                        name="office_address"
                        class="form-control"
                        rows="3"
                        placeholder="Enter your complete office address">{{ old('office_address', $lawyer->office_address ?? '') }}</textarea>
                </div>


                {{-- Qualifications --}}
                <div class="col-12">
                    <label class="form-label">
                        Qualifications
                    </label>

                    <input
                        type="text"
                        name="qualifications"
                        class="form-control"
                        value="{{ old(
                            'qualifications',
                            isset($lawyer) && is_array($lawyer->qualifications)
                                ? implode(', ', $lawyer->qualifications)
                                : ''
                        ) }}"
                        placeholder="e.g. LL.B, LL.M, Bar at Law">

                    <small class="text-muted">
                        Separate multiple qualifications with commas.
                    </small>
                </div>


                {{-- Bio --}}
                <div class="col-12">
                    <label class="form-label">
                        Professional Bio
                    </label>

                    <textarea
                        name="bio"
                        class="form-control"
                        rows="5"
                        placeholder="Write something about yourself and your professional experience...">{{ old('bio', $lawyer->bio ?? '') }}</textarea>
                </div>


                {{-- Profile Image --}}
                <div class="col-md-6">

                    <label class="form-label">
                        Profile Image
                    </label>

                    <input
                        type="file"
                        name="image"
                        class="form-control"
                        accept="image/png,image/jpeg,image/jpg">

                    <small class="text-muted">
                        JPG, JPEG or PNG. Maximum 2MB.
                    </small>

                </div>


                {{-- Existing Image --}}
                @if(isset($lawyer) && $lawyer->image)

                    <div class="col-md-6">

                        <label class="form-label">
                            Current Profile Image
                        </label>

                        <div>
                            <img
                                src="{{ asset('uploads/lawyers/' . $lawyer->image) }}"
                                alt="Lawyer Profile"
                                width="100"
                                height="100"
                                class="rounded-circle object-fit-cover">
                        </div>

                    </div>

                @endif


                {{-- Save Button --}}
                <div class="col-12 mt-4">

                    <button
                        type="submit"
                        class="btn btn-gold px-4">

                        <i class="bi bi-check-circle me-1"></i>
                        Save Profile

                    </button>

                </div>

            </div>

        </form>

    </div>

</div>

@endsection
