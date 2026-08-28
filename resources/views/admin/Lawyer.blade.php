@extends('admin.sidebar')

@section('admin')
<div class="container-fluid py-4">
  <div class="d-flex justify-content-between align-items-center mb-4">
    <div>
      <h1 class="h3 fw-bold text-navy mb-1">Lawyers Management</h1>
      <p class="text-muted small mb-0">Total {{ count($lawyers) }} registered advocate(s)</p>
    </div>
  </div>

  <!-- LAWYERS CARDS GRID -->
  <div class="row g-4">
    @forelse($lawyers as $lawyer)
      <div class="col-12 col-md-6 col-xl-4">
        <div class="card border-0 shadow-sm rounded-4 p-3 h-100 bg-white d-flex flex-column justify-content-between">
          <div>
            <!-- Header: Image, Name & Rating -->
            <div class="d-flex align-items-center gap-3 mb-3">
              <img src="{{ !empty($lawyer->image) ? asset('images/Lawyer/' . $lawyer->image) : asset('images/default-avatar.jpg') }}"
                   alt="{{ $lawyer->name }}"
                   class="rounded-circle object-fit-cover border"
                   width="60" height="60">
              <div>
                <h6 class="fw-bold mb-1 text-dark d-flex align-items-center gap-1">
                  {{ $lawyer->name }}
                  @if($lawyer->is_verified)
                    <i class="bi bi-patch-check-fill text-warning" title="Verified Advocate"></i>
                  @endif
                </h6>
                <div class="small text-warning">
                  @php $rating = round($lawyer->rating ?? 5); @endphp
                  @for($i = 1; $i <= 5; $i++)
                    <i class="bi bi-star{{ $i <= $rating ? '-fill' : '' }}"></i>
                  @endfor
                  <span class="text-secondary ms-1 fw-semibold">{{ number_format($lawyer->rating ?? 5.0, 1) }}</span>
                </div>
              </div>
            </div>

            <!-- Specialization & City Badges -->
            <div class="d-flex flex-wrap gap-2 mb-3">
              <span class="badge bg-light text-dark fw-normal px-3 py-2 rounded-pill border">
                {{ $lawyer->specialization ?? 'General Practice' }}
              </span>
              @if(!empty($lawyer->city))
                <span class="badge bg-warning bg-opacity-10 text-dark fw-normal px-3 py-2 rounded-pill">
                  <i class="bi bi-geo-alt text-warning me-1"></i>{{ $lawyer->city }}
                </span>
              @endif
              <span class="badge {{ $lawyer->is_active ? 'bg-success' : 'bg-danger' }} rounded-pill px-3 py-2">
                {{ $lawyer->is_active ? 'Active' : 'Inactive' }}
              </span>
            </div>

            <!-- Experience & Fee Details -->
            <div class="row g-2 align-items-center mb-3 small text-muted">
              <div class="col-6 d-flex align-items-center gap-1">
                <i class="bi bi-briefcase fs-6"></i>
                <span>{{ $lawyer->experience ?? 0 }} yrs exp</span>
              </div>
              <div class="col-6 text-end text-navy fw-bold fs-6">
                <i class="bi bi-cash-stack me-1"></i>PKR {{ number_format($lawyer->fee ?? 0) }}
              </div>
            </div>
          </div>

          <!-- Bottom Action Buttons & Dynamic Details Panel -->
          <div>
            <!-- Button jo usi card mein further details toggle karega -->
            <button class="btn btn-outline-navy w-100 py-2 fw-semibold mb-2" type="button" data-bs-toggle="collapse" data-bs-target="#adminLawyerDetail{{ $lawyer->id }}" aria-expanded="false">
              <i class="bi bi-person-lines-fill me-1"></i> Show Further Details
            </button>

            <!-- Status Toggle and Delete Buttons -->
            <div class="d-flex gap-2">
              <form action="{{ route('admin.lawyers.toggle', $lawyer->id) }}" method="POST" class="w-50">
                @csrf
                <button type="submit" class="btn btn-sm {{ $lawyer->is_active ? 'btn-outline-warning' : 'btn-outline-success' }} w-100 py-2">
                  {{ $lawyer->is_active ? 'Deactivate' : 'Activate' }}
                </button>
              </form>

              <form action="{{ route('admin.lawyers.delete', $lawyer->id) }}" method="POST" class="w-50" onsubmit="return confirm('Are you sure you want to delete this lawyer?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-sm btn-outline-danger w-100 py-2">
                  <i class="bi bi-trash me-1"></i> Delete
                </button>
              </form>
            </div>

            <!-- EXPANDABLE FULL PROFILE SECTION -->
            <div class="collapse mt-3" id="adminLawyerDetail{{ $lawyer->id }}">
              <div class="p-3 bg-light rounded-3 border text-start small">
                <h6 class="fw-bold text-navy mb-2">Bio / Summary</h6>
                <p class="text-muted mb-3">{{ $lawyer->bio ?? 'No biography added.' }}</p>

                <h6 class="fw-bold text-navy mb-2">Qualifications</h6>
                <ul class="ps-3 mb-3 text-muted">
                  @if(is_array($lawyer->qualifications))
                    @foreach($lawyer->qualifications as $qual)
                      <li>{{ $qual }}</li>
                    @endforeach
                  @elseif(!empty($lawyer->qualifications))
                    <li>{{ $lawyer->qualifications }}</li>
                  @else
                    <li>N/A</li>
                  @endif
                </ul>

                <h6 class="fw-bold text-navy mb-1">Office Address</h6>
                <p class="text-muted mb-3"><i class="bi bi-building me-1"></i>{{ $lawyer->office_address ?? $lawyer->city }}</p>

                <h6 class="fw-bold text-navy mb-1">Contact Information</h6>
                <p class="text-muted mb-0">
                  <i class="bi bi-telephone me-1"></i> Phone: {{ $lawyer->phone ?? 'N/A' }}<br>
                  <i class="bi bi-envelope me-1"></i> Email: {{ $lawyer->email ?? 'N/A' }}
                </p>
              </div>
            </div>
          </div>

        </div>
      </div>
    @empty
      <div class="col-12 text-center py-5 bg-white rounded-4 shadow-sm">
        <i class="bi bi-person-x fs-1 text-muted mb-2 d-block"></i>
        <h3 class="h5">No lawyers registered yet</h3>
      </div>
    @endforelse
  </div>
</div>
@endsection
