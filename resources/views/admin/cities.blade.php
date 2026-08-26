@extends('admin.sidebar')

@section('admin')

<style>
    /* Custom CSS Modals Overlay */
    .modal-overlay {
        position: fixed;
        inset: 0;
        background: rgba(15, 23, 42, 0.7);
        backdrop-filter: blur(4px);
        display: none;
        align-items: center;
        justify-content: center;
        z-index: 9999;
    }
    .modal-overlay:target {
        display: flex;
    }
</style>

<!-- Main Wrapper with Left Sidebar Offset -->
<div class="p-2 sm:p-4 bg-slate-50 min-h-screen w-full">

    <!-- Header Section -->
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6">
        <div>
            <h1 class="text-2xl font-black text-slate-900 tracking-tight">Cities Management</h1>
            <p class="text-xs text-slate-500 font-medium">Manage and organize available operational cities</p>
        </div>
        <a href="#addCityModal" class="inline-flex items-center gap-2 px-5 py-2.5 bg-amber-500 hover:bg-amber-600 text-slate-950 font-bold text-xs uppercase tracking-wider rounded-xl shadow-md hover:shadow-lg transition duration-200">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"></path></svg>
            Add New City
        </a>
    </div>

    <!-- Stylish Modern Table Card Layout -->
    <div class="bg-white rounded-2xl shadow-sm border border-slate-200/80 overflow-hidden">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-slate-900 text-slate-300 text-xs font-bold uppercase tracking-wider border-b border-slate-800">
                    <th class="py-4 px-6">ID</th>
                    <th class="py-4 px-6">City Name</th>
                    <th class="py-4 px-6">Created At</th>
                    <th class="py-4 px-6 text-center">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100 text-sm font-semibold text-slate-700">
                @forelse($cities as $city)
                    <tr class="hover:bg-slate-50/80 transition duration-150">
                        <!-- ID Badge -->
                        <td class="py-4 px-6">
                            <span class="inline-block px-2.5 py-1 bg-slate-100 text-slate-700 font-mono text-xs font-bold rounded-lg border border-slate-200">
                                #{{ $city->id }}
                            </span>
                        </td>

                        <!-- City Name with Active Dot -->
                        <td class="py-4 px-6 text-slate-900 font-bold">
                            <div class="flex items-center gap-2.5">
                                <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                                {{ $city->name }}
                            </div>
                        </td>

                        <!-- Created Date -->
                        <td class="py-4 px-6 text-slate-500 text-xs font-medium">
                            {{ isset($city->created_at) ? \Carbon\Carbon::parse($city->created_at)->format('d M, Y') : 'N/A' }}
                        </td>

                        <!-- Styled Action Buttons -->
                        <td class="py-4 px-6 text-center">
                            <div class="flex items-center justify-center gap-2">
                                <!-- Styled Edit Button -->
                                <a href="#editCityModal-{{ $city->id }}" class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-indigo-50 hover:bg-indigo-600 text-indigo-700 hover:text-white rounded-lg font-bold text-xs transition duration-200 border border-indigo-100 hover:border-indigo-600 shadow-sm">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                    Edit
                                </a>

                                <!-- Styled Delete Button -->
                                <a href="#deleteCityModal-{{ $city->id }}" class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-rose-50 hover:bg-rose-600 text-rose-700 hover:text-white rounded-lg font-bold text-xs transition duration-200 border border-rose-100 hover:border-rose-600 shadow-sm">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                    Delete
                                </a>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="py-12 text-center text-slate-400 font-medium">
                            No operational cities found in the system.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<!-- Dynamic Modals Section -->
@foreach($cities as $city)
    <!-- Edit Modal -->
    <div id="editCityModal-{{ $city->id }}" class="modal-overlay">
        <div class="bg-white rounded-2xl shadow-2xl w-full max-w-md p-6 border border-slate-100">
            <h3 class="text-lg font-bold text-slate-900 mb-4 pb-2 border-b border-slate-100">Edit City Record</h3>
            <form action="{{ route('admin.cities') }}" method="POST">
                @csrf
                @method('PUT')
                <input type="hidden" name="id" value="{{ $city->id }}">

                <div class="mb-5">
                    <label class="block text-xs font-bold uppercase text-slate-600 mb-2">City Name</label>
                    <input type="text" name="name" value="{{ $city->name }}" required class="w-full px-4 py-2.5 border border-slate-300 rounded-xl focus:outline-none focus:border-amber-500 font-semibold text-slate-800 text-sm">
                </div>

                <div class="flex justify-end gap-2">
                    <a href="#" class="px-4 py-2 border border-slate-300 rounded-xl text-slate-600 hover:bg-slate-50 font-semibold text-xs">Cancel</a>
                    <button type="submit" class="px-5 py-2 bg-amber-500 hover:bg-amber-600 text-slate-950 font-bold text-xs rounded-xl shadow-md">Update</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Delete Modal -->
    <div id="deleteCityModal-{{ $city->id }}" class="modal-overlay">
        <div class="bg-white rounded-2xl shadow-2xl w-full max-w-sm p-6 text-center border border-slate-100">
            <div class="w-12 h-12 bg-rose-100 text-rose-600 rounded-full flex items-center justify-center mx-auto mb-3">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
            </div>
            <h3 class="text-base font-bold text-slate-900 mb-1">Are you sure?</h3>
            <p class="text-xs text-slate-500 mb-5">Remove city record <span class="font-bold text-slate-800">"{{ $city->name }}"</span>?</p>

            <form action="{{ route('admin.cities') }}" method="POST">
                @csrf
                @method('DELETE')
                <input type="hidden" name="id" value="{{ $city->id }}">
                <div class="flex justify-center gap-2">
                    <a href="#" class="w-1/2 py-2 border border-slate-300 rounded-xl text-slate-600 hover:bg-slate-50 font-semibold text-xs">Cancel</a>
                    <button type="submit" class="w-1/2 py-2 bg-rose-600 hover:bg-rose-700 text-white font-bold text-xs rounded-xl shadow-md">Delete</button>
                </div>
            </form>
        </div>
    </div>
@endforeach

<!-- Add Modal -->
<div id="addCityModal" class="modal-overlay">
    <div class="bg-white rounded-2xl shadow-2xl w-full max-w-md p-6 border border-slate-100">
        <h3 class="text-lg font-bold text-slate-900 mb-4 pb-2 border-b border-slate-100">Add New City</h3>
        <form action="{{ route('admin.cities') }}" method="POST">
            @csrf
            <div class="mb-5">
                <label class="block text-xs font-bold uppercase text-slate-600 mb-2">City Name</label>
                <input type="text" name="name" required placeholder="e.g. Islamabad" class="w-full px-4 py-2.5 border border-slate-300 rounded-xl focus:outline-none focus:border-amber-500 font-semibold text-slate-800 text-sm">
            </div>

            <div class="flex justify-end gap-2">
                <a href="#" class="px-4 py-2 border border-slate-300 rounded-xl text-slate-600 hover:bg-slate-50 font-semibold text-xs">Cancel</a>
                <button type="submit" class="px-5 py-2 bg-amber-500 hover:bg-amber-600 text-slate-950 font-bold text-xs rounded-xl shadow-md">Save</button>
            </div>
        </form>
    </div>
</div>

@endsection
<script src="https://cdn.tailwindcss.com"></script>
