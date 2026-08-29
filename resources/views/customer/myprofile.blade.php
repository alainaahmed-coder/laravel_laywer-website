@extends('customer.sidebar')

@section('customer')
<div class="w-100 p-3 p-md-4">
    <div class="container-fluid">

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show rounded-3 shadow-sm mb-4" role="alert">
                <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <!-- PROFILE CARD -->
        <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
            <div class="p-4 text-white text-center position-relative" style="background-color: #0F172A;">
                <div class="position-relative d-inline-block">
                    @if(!empty($user->profile_picture) && file_exists(public_path('uploads/profile/' . $user->profile_picture)))
                        <img src="{{ asset('uploads/profile/' . $user->profile_picture) }}"
                             alt="Profile Picture"
                             class="rounded-circle border border-3 border-white shadow-sm object-fit-cover"
                             width="110" height="110">
                    @else
                        <div class="rounded-circle border border-3 border-white shadow-sm d-flex align-items-center justify-content-center bg-secondary text-white fw-bold mx-auto"
                             style="width: 110px; height: 110px; font-size: 36px;">
                            {{ strtoupper(substr($user->name ?? 'C', 0, 1)) }}
                        </div>
                    @endif
                </div>
                <h4 class="mt-3 fw-bold mb-1 text-white">{{ $user->name }}</h4>
                <span class="badge bg-warning text-dark rounded-pill px-3 py-1 fw-semibold text-uppercase fs-7">
                    {{ $user->role ?? 'CUSTOMER' }}
                </span>
            </div>

            <div class="card-body p-4">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h5 class="fw-bold text-dark mb-0"><i class="bi bi-person-badge text-warning me-2"></i>Personal Details</h5>
                    <button type="button" class="btn text-white px-4 py-2 rounded-3 shadow-sm fw-semibold" style="background-color: #0F172A;" data-bs-toggle="modal" data-bs-target="#editProfileModal">
                        <i class="bi bi-pencil-square me-1"></i> Edit Profile
                    </button>
                </div>

                <div class="row g-3">
                    <div class="col-md-6">
                        <div class="p-3 bg-light rounded-3">
                            <small class="text-muted d-block fw-semibold text-uppercase fs-7">Full Name</small>
                            <span class="fw-bold text-dark fs-6">{{ $user->name }}</span>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="p-3 bg-light rounded-3">
                            <small class="text-muted d-block fw-semibold text-uppercase fs-7">Email Address</small>
                            <span class="fw-bold text-dark fs-6">{{ $user->email }}</span>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="p-3 bg-light rounded-3">
                            <small class="text-muted d-block fw-semibold text-uppercase fs-7">Phone Number</small>
                            <span class="fw-bold text-dark fs-6">{{ $user->phone ?? 'Not Provided' }}</span>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="p-3 bg-light rounded-3">
                            <small class="text-muted d-block fw-semibold text-uppercase fs-7">City</small>
                            <span class="fw-bold text-dark fs-6">{{ $user->city ?? 'Not Provided' }}</span>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="p-3 bg-light rounded-3">
                            <small class="text-muted d-block fw-semibold text-uppercase fs-7">CNIC (Optional)</small>
                            <span class="fw-bold text-dark fs-6">{{ $user->cnic ?? 'Not Provided' }}</span>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="p-3 bg-light rounded-3">
                            <small class="text-muted d-block fw-semibold text-uppercase fs-7">Address</small>
                            <span class="fw-bold text-dark fs-6">{{ $user->address ?? 'Not Provided' }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- EDIT PROFILE MODAL -->
<div class="modal fade" id="editProfileModal" tabindex="-1" aria-labelledby="editProfileModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0 rounded-4 shadow">
            <div class="modal-header text-white p-3" style="background-color: #0F172A;">
                <h5 class="modal-title fw-bold text-white mb-0" id="editProfileModalLabel">Edit Profile Details</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form action="{{ route('customer.my.profile.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body p-4">
                    <div class="row g-3">
                        <div class="col-12 mb-2">
                            <label class="form-label fw-semibold">Profile Picture</label>
                            <input type="file" name="profile_picture" class="form-control" accept="image/*">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Full Name</label>
                            <input type="text" name="name" class="form-control" value="{{ old('name', $user->name) }}" required>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Email Address</label>
                            <input type="email" name="email" class="form-control" value="{{ old('email', $user->email) }}" required>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Phone Number</label>
                            <input type="text" name="phone" class="form-control" value="{{ old('phone', $user->phone) }}">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold">City</label>
                            <input type="text" name="city" class="form-control" value="{{ old('city', $user->city) }}">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold">CNIC (Optional)</label>
                            <input type="text" name="cnic" class="form-control" value="{{ old('cnic', $user->cnic) }}" placeholder="e.g. 42101-XXXXXXX-X">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Address</label>
                            <input type="text" name="address" class="form-control" value="{{ old('address', $user->address) }}">
                        </div>
                    </div>
                </div>

                <div class="modal-footer bg-light p-3">
                    <button type="button" class="btn btn-secondary px-4 rounded-3" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-warning fw-bold px-4 rounded-3">Save Changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
