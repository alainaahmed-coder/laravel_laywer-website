@extends('admin.sidebar')


@section('admin')




<div class="container-fluid px-4 py-4">
  <!-- Flash Success Alert -->
  @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
      {{ session('success') }}
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
  @endif

  <!-- Header Section -->
  <div class="d-flex justify-content-between align-items-center mb-4">
    <div>
      <h1 class="h3 text-navy fw-bold mb-1">Customers Management</h1>
      <p class="text-muted small mb-0">Manage and organize all registered customers</p>
    </div>
    <button class="btn btn-warning text-dark fw-bold px-4 rounded-3" data-bs-toggle="modal" data-bs-target="#addCustomerModal">
      + ADD NEW CUSTOMER
    </button>
  </div>

  <!-- Customers Table Card -->
  <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
    <div class="table-responsive">
      <table class="table align-middle mb-0">
        <thead style="background-color: #0d1b2a; color: #ffffff;">
          <tr>
            <th class="py-3 px-4">ID</th>
            <th class="py-3">NAME</th>
            <th class="py-3">EMAIL</th>
            <th class="py-3">PHONE</th>
            <th class="py-3">CREATED AT</th>
            <th class="py-3 text-end px-4">ACTIONS</th>
          </tr>
        </thead>
        <tbody>
          @forelse($customers as $customer)
            <tr class="border-bottom">
              <td class="px-4 fw-semibold text-muted">#{{ $customer->id }}</td>
              <td class="fw-bold text-dark">{{ $customer->name }}</td>
              <td>{{ $customer->email }}</td>
              <td>{{ $customer->phone ?? 'N/A' }}</td>
              <td>{{ $customer->created_at ? $customer->created_at->format('Y-m-d') : 'N/A' }}</td>
              <td class="text-end px-4">
                <button class="btn btn-sm btn-outline-primary me-2 rounded-2"
                        data-bs-toggle="modal"
                        data-bs-target="#editCustomerModal{{ $customer->id }}">
                  <i class="bi bi-pencil-square me-1"></i> Edit
                </button>
                <form action="{{ route('customers.destroy', $customer->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this customer?');">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="btn btn-sm btn-outline-danger rounded-2">
                    <i class="bi bi-trash me-1"></i> Delete
                  </button>
                </form>
              </td>
            </tr>

            <!-- Edit Customer Modal -->
            <div class="modal fade" id="editCustomerModal{{ $customer->id }}" tabindex="-1" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content rounded-4 border-0">
                  <div class="modal-header border-0 pb-0">
                    <h5 class="modal-title fw-bold">Edit Customer</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <form action="{{ route('customers.update', $customer->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                      <div class="mb-3">
                        <label class="form-label small fw-semibold">Full Name</label>
                        <input type="text" name="name" class="form-control" value="{{ $customer->name }}" required>
                      </div>
                      <div class="mb-3">
                        <label class="form-label small fw-semibold">Email Address</label>
                        <input type="email" name="email" class="form-control" value="{{ $customer->email }}" required>
                      </div>
                      <div class="mb-3">
                        <label class="form-label small fw-semibold">Phone Number</label>
                        <input type="text" name="phone" class="form-control" value="{{ $customer->phone }}">
                      </div>
                      <div class="mb-3">
                        <label class="form-label small fw-semibold">New Password <span class="text-muted fw-normal">(Leave blank if unchanged)</span></label>
                        <input type="password" name="password" class="form-control">
                      </div>
                      <div class="mb-3">
                        <label class="form-label small fw-semibold">Confirm New Password</label>
                        <input type="password" name="password_confirmation" class="form-control">
                      </div>
                    </div>
                    <div class="modal-footer border-0 pt-0">
                      <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                      <button type="submit" class="btn btn-primary px-4">Update Customer</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          @empty
            <tr>
              <td colspan="6" class="text-center py-4 text-muted">No customers found.</td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>
</div>

<!-- Add Customer Modal -->
<div class="modal fade" id="addCustomerModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content rounded-4 border-0">
      <div class="modal-header border-0 pb-0">
        <h5 class="modal-title fw-bold">Add New Customer</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="{{ route('customers.store') }}" method="POST">
        @csrf
        <div class="modal-body">
          <div class="mb-3">
            <label class="form-label small fw-semibold">Full Name</label>
            <input type="text" name="name" class="form-control" placeholder="Enter full name" required>
          </div>
          <div class="mb-3">
            <label class="form-label small fw-semibold">Email Address</label>
            <input type="email" name="email" class="form-control" placeholder="Enter email" required>
          </div>
          <div class="mb-3">
            <label class="form-label small fw-semibold">Phone Number</label>
            <input type="text" name="phone" class="form-control" placeholder="03001234567">
          </div>
          <div class="mb-3">
            <label class="form-label small fw-semibold">Password</label>
            <input type="password" name="password" class="form-control" placeholder="••••••••" required>
          </div>
          <div class="mb-3">
            <label class="form-label small fw-semibold">Confirm Password</label>
            <input type="password" name="password_confirmation" class="form-control" placeholder="••••••••" required>
          </div>
        </div>
        <div class="modal-footer border-0 pt-0">
          <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-warning text-dark fw-bold px-4">Save Customer</button>
        </div>
      </form>
    </div>
  </div>
</div>



@endsection
