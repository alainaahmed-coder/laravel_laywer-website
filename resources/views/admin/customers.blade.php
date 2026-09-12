@extends('admin.sidebar')

@section('admin')

<style>
    /* Custom Modal Overlay - Same as Cities UI */
    .modal-overlay {
        position: fixed;
        inset: 0;
        background: rgba(15, 23, 42, 0.70);
        backdrop-filter: blur(4px);
        display: none;
        align-items: center;
        justify-content: center;
        z-index: 9999;
        padding: 20px;
    }

    .modal-overlay:target {
        display: flex;
    }

    /* Prevent modal from becoming too tall */
    .custom-modal {
        max-height: 90vh;
        overflow-y: auto;
    }
</style>

<!-- Main Wrapper -->
<div class="p-2 sm:p-4 bg-slate-50 min-h-screen w-full">

    <!-- Header Section -->
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6">

        <div>
            <h1 class="text-2xl font-black text-slate-900 tracking-tight">
                Customers Management
            </h1>

            <p class="text-xs text-slate-500 font-medium">
                Manage and organize all registered customers
            </p>
        </div>

        <!-- Add Customer Button -->
        <a href="#addCustomerModal"
           class="inline-flex items-center gap-2 px-5 py-2.5 bg-amber-500 hover:bg-amber-600 text-slate-950 font-bold text-xs uppercase tracking-wider rounded-xl shadow-md hover:shadow-lg transition duration-200">

            <svg class="w-4 h-4"
                 fill="none"
                 stroke="currentColor"
                 viewBox="0 0 24 24">

                <path stroke-linecap="round"
                      stroke-linejoin="round"
                      stroke-width="2.5"
                      d="M12 4v16m8-8H4">
                </path>

            </svg>

            Add New Customer
        </a>

    </div>


    <!-- Customers Table Card -->
    <div class="bg-white rounded-2xl shadow-sm border border-slate-200/80 overflow-hidden">

        <div class="overflow-x-auto">

            <table class="w-full text-left border-collapse">

                <!-- Table Header -->
                <thead>

                    <tr class="bg-slate-900 text-slate-300 text-xs font-bold uppercase tracking-wider border-b border-slate-800">

                        <th class="py-4 px-6">
                            ID
                        </th>

                        <th class="py-4 px-6">
                            Customer Name
                        </th>

                        <th class="py-4 px-6">
                            Email
                        </th>

                        <th class="py-4 px-6">
                            Phone
                        </th>

                        <th class="py-4 px-6">
                            Created At
                        </th>

                        <th class="py-4 px-6 text-center">
                            Actions
                        </th>

                    </tr>

                </thead>


                <!-- Table Body -->
                <tbody class="divide-y divide-slate-100 text-sm font-semibold text-slate-700">

                    @forelse($customers as $customer)

                    <tr class="hover:bg-slate-50/80 transition duration-150">

                        <!-- ID -->
                        <td class="py-4 px-6">

                            <span class="inline-block px-2.5 py-1 bg-slate-100 text-slate-700 font-mono text-xs font-bold rounded-lg border border-slate-200">

                                #{{ $customer->id }}

                            </span>

                        </td>


                        <!-- Customer Name -->
                        <td class="py-4 px-6 text-slate-900 font-bold">

                            <div class="flex items-center gap-2.5">

                                <!-- Active Dot -->
                                <span class="w-2 h-2 rounded-full bg-emerald-500"></span>

                                {{ $customer->name }}

                            </div>

                        </td>


                        <!-- Email -->
                        <td class="py-4 px-6 text-slate-600 font-medium">

                            {{ $customer->email }}

                        </td>


                        <!-- Phone -->
                        <td class="py-4 px-6 text-slate-600 font-medium">

                            {{ $customer->phone ?? 'N/A' }}

                        </td>


                        <!-- Created At -->
                        <td class="py-4 px-6 text-slate-500 text-xs font-medium">

                            @if($customer->created_at)

                                {{ \Carbon\Carbon::parse($customer->created_at)->format('d M, Y') }}

                            @else

                                N/A

                            @endif

                        </td>


                        <!-- Actions -->
                        <td class="py-4 px-6 text-center">

                            <div class="flex items-center justify-center gap-2">

                                <!-- Edit Button -->
                                <a href="#editCustomerModal-{{ $customer->id }}"
                                   class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-indigo-50 hover:bg-indigo-600 text-indigo-700 hover:text-white rounded-lg font-bold text-xs transition duration-200 border border-indigo-100 hover:border-indigo-600 shadow-sm">

                                    <svg class="w-3.5 h-3.5"
                                         fill="none"
                                         stroke="currentColor"
                                         viewBox="0 0 24 24">

                                        <path stroke-linecap="round"
                                              stroke-linejoin="round"
                                              stroke-width="2"
                                              d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                        </path>

                                    </svg>

                                    Edit

                                </a>


                                <!-- Delete Button -->
                                <form action="{{ route('customers.destroy', $customer->id) }}"
                                      method="POST"
                                      class="inline"
                                      onsubmit="return confirm('Are you sure you want to delete this customer?');">

                                    @csrf

                                    @method('DELETE')

                                    <button type="submit"
                                            class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-red-50 hover:bg-red-600 text-red-700 hover:text-white rounded-lg font-bold text-xs transition duration-200 border border-red-100 hover:border-red-600 shadow-sm">

                                        <svg class="w-3.5 h-3.5"
                                             fill="none"
                                             stroke="currentColor"
                                             viewBox="0 0 24 24">

                                            <path stroke-linecap="round"
                                                  stroke-linejoin="round"
                                                  stroke-width="2"
                                                  d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6M9 7V4a1 1 0 011-1h4a1 1 0 011 1v3m-9 0h10">
                                            </path>

                                        </svg>

                                        Delete

                                    </button>

                                </form>

                            </div>

                        </td>

                    </tr>

                    @empty

                    <!-- Empty State -->
                    <tr>

                        <td colspan="6"
                            class="py-12 text-center text-slate-400 font-medium">

                            <div class="flex flex-col items-center justify-center">

                                <svg class="w-10 h-10 mb-3 text-slate-300"
                                     fill="none"
                                     stroke="currentColor"
                                     viewBox="0 0 24 24">

                                    <path stroke-linecap="round"
                                          stroke-linejoin="round"
                                          stroke-width="1.5"
                                          d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z">
                                    </path>

                                </svg>

                                No registered customers found.

                            </div>

                        </td>

                    </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>



<!-- ========================================================= -->
<!-- EDIT CUSTOMER MODALS -->
<!-- ========================================================= -->

@foreach($customers as $customer)

<div id="editCustomerModal-{{ $customer->id }}"
     class="modal-overlay">

    <div class="custom-modal bg-white rounded-2xl shadow-2xl w-full max-w-md p-6 border border-slate-100">

        <!-- Modal Header -->
        <div class="flex items-center justify-between mb-4 pb-3 border-b border-slate-100">

            <h3 class="text-lg font-bold text-slate-900">

                Edit Customer

            </h3>

            <a href="#"
               class="text-slate-400 hover:text-slate-700 text-xl font-bold">

                &times;

            </a>

        </div>


        <!-- Edit Form -->
        <form action="{{ route('customers.update', $customer->id) }}"
              method="POST">

            @csrf

            @method('PUT')


            <!-- Full Name -->
            <div class="mb-5">

                <label class="block text-xs font-bold uppercase text-slate-600 mb-2">

                    Full Name

                </label>

                <input type="text"
                       name="name"
                       value="{{ $customer->name }}"
                       required
                       class="w-full px-4 py-2.5 border border-slate-300 rounded-xl focus:outline-none focus:border-amber-500 focus:ring-1 focus:ring-amber-500 font-semibold text-slate-800 text-sm">

            </div>


            <!-- Email -->
            <div class="mb-5">

                <label class="block text-xs font-bold uppercase text-slate-600 mb-2">

                    Email Address

                </label>

                <input type="email"
                       name="email"
                       value="{{ $customer->email }}"
                       required
                       class="w-full px-4 py-2.5 border border-slate-300 rounded-xl focus:outline-none focus:border-amber-500 focus:ring-1 focus:ring-amber-500 font-semibold text-slate-800 text-sm">

            </div>


            <!-- Phone -->
            <div class="mb-5">

                <label class="block text-xs font-bold uppercase text-slate-600 mb-2">

                    Phone Number

                </label>

                <input type="text"
                       name="phone"
                       value="{{ $customer->phone }}"
                       placeholder="03001234567"
                       class="w-full px-4 py-2.5 border border-slate-300 rounded-xl focus:outline-none focus:border-amber-500 focus:ring-1 focus:ring-amber-500 font-semibold text-slate-800 text-sm">

            </div>


            <!-- New Password -->
            <div class="mb-5">

                <label class="block text-xs font-bold uppercase text-slate-600 mb-2">

                    New Password

                    <span class="normal-case text-slate-400 font-medium">

                        (Optional)

                    </span>

                </label>

                <input type="password"
                       name="password"
                       placeholder="Leave blank if unchanged"
                       class="w-full px-4 py-2.5 border border-slate-300 rounded-xl focus:outline-none focus:border-amber-500 focus:ring-1 focus:ring-amber-500 font-semibold text-slate-800 text-sm">

            </div>


            <!-- Confirm Password -->
            <div class="mb-6">

                <label class="block text-xs font-bold uppercase text-slate-600 mb-2">

                    Confirm New Password

                </label>

                <input type="password"
                       name="password_confirmation"
                       placeholder="Confirm new password"
                       class="w-full px-4 py-2.5 border border-slate-300 rounded-xl focus:outline-none focus:border-amber-500 focus:ring-1 focus:ring-amber-500 font-semibold text-slate-800 text-sm">

            </div>


            <!-- Buttons -->
            <div class="flex justify-end gap-2">

                <a href="#"
                   class="px-4 py-2 border border-slate-300 rounded-xl text-slate-600 hover:bg-slate-50 font-semibold text-xs transition">

                    Cancel

                </a>

                <button type="submit"
                        class="px-5 py-2 bg-amber-500 hover:bg-amber-600 text-slate-950 font-bold text-xs rounded-xl shadow-md transition">

                    Update Customer

                </button>

            </div>

        </form>

    </div>

</div>

@endforeach



<!-- ========================================================= -->
<!-- ADD CUSTOMER MODAL -->
<!-- ========================================================= -->

<div id="addCustomerModal"
     class="modal-overlay">

    <div class="custom-modal bg-white rounded-2xl shadow-2xl w-full max-w-md p-6 border border-slate-100">

        <!-- Modal Header -->
        <div class="flex items-center justify-between mb-4 pb-3 border-b border-slate-100">

            <h3 class="text-lg font-bold text-slate-900">

                Add New Customer

            </h3>

            <a href="#"
               class="text-slate-400 hover:text-slate-700 text-xl font-bold">

                &times;

            </a>

        </div>


        <!-- Add Customer Form -->
        <form action="{{ route('customers.store') }}"
              method="POST">

            @csrf


            <!-- Full Name -->
            <div class="mb-5">

                <label class="block text-xs font-bold uppercase text-slate-600 mb-2">

                    Full Name

                </label>

                <input type="text"
                       name="name"
                       required
                       placeholder="Enter full name"
                       class="w-full px-4 py-2.5 border border-slate-300 rounded-xl focus:outline-none focus:border-amber-500 focus:ring-1 focus:ring-amber-500 font-semibold text-slate-800 text-sm">

            </div>


            <!-- Email -->
            <div class="mb-5">

                <label class="block text-xs font-bold uppercase text-slate-600 mb-2">

                    Email Address

                </label>

                <input type="email"
                       name="email"
                       required
                       placeholder="Enter email address"
                       class="w-full px-4 py-2.5 border border-slate-300 rounded-xl focus:outline-none focus:border-amber-500 focus:ring-1 focus:ring-amber-500 font-semibold text-slate-800 text-sm">

            </div>


            <!-- Phone -->
            <div class="mb-5">

                <label class="block text-xs font-bold uppercase text-slate-600 mb-2">

                    Phone Number

                </label>

                <input type="text"
                       name="phone"
                       placeholder="03001234567"
                       class="w-full px-4 py-2.5 border border-slate-300 rounded-xl focus:outline-none focus:border-amber-500 focus:ring-1 focus:ring-amber-500 font-semibold text-slate-800 text-sm">

            </div>


            <!-- Password -->
            <div class="mb-5">

                <label class="block text-xs font-bold uppercase text-slate-600 mb-2">

                    Password

                </label>

                <input type="password"
                       name="password"
                       required
                       placeholder="Enter password"
                       class="w-full px-4 py-2.5 border border-slate-300 rounded-xl focus:outline-none focus:border-amber-500 focus:ring-1 focus:ring-amber-500 font-semibold text-slate-800 text-sm">

            </div>


            <!-- Confirm Password -->
            <div class="mb-6">

                <label class="block text-xs font-bold uppercase text-slate-600 mb-2">

                    Confirm Password

                </label>

                <input type="password"
                       name="password_confirmation"
                       required
                       placeholder="Confirm password"
                       class="w-full px-4 py-2.5 border border-slate-300 rounded-xl focus:outline-none focus:border-amber-500 focus:ring-1 focus:ring-amber-500 font-semibold text-slate-800 text-sm">

            </div>


            <!-- Buttons -->
            <div class="flex justify-end gap-2">

                <a href="#"
                   class="px-4 py-2 border border-slate-300 rounded-xl text-slate-600 hover:bg-slate-50 font-semibold text-xs transition">

                    Cancel

                </a>

                <button type="submit"
                        class="px-5 py-2 bg-amber-500 hover:bg-amber-600 text-slate-950 font-bold text-xs rounded-xl shadow-md transition">

                    Save Customer

                </button>

            </div>

        </form>

    </div>

</div>


@endsection


<!-- Tailwind CSS -->
<script src="https://cdn.tailwindcss.com"></script>