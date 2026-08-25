@extends('admin.sidebar')


@section('admin')



<style>
    /* CSS Only Modals */
    .modal-overlay {
        position: fixed;
        inset: 0;
        background: rgba(15, 23, 42, 0.6);
        display: none;
        align-items: center;
        justify-content: center;
        z-index: 9999;
    }
    .modal-overlay:target {
        display: flex;
    }
</style>

<div class="p-6 bg-gray-50 min-h-screen">
    <!-- Header -->
    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Cities Management</h1>
            <p class="text-sm text-gray-500">Manage available operational cities</p>
        </div>
        <a href="#addCityModal" class="px-4 py-2 bg-amber-500 text-white rounded-lg hover:bg-amber-600 font-medium transition duration-200">
            + Add New City
        </a>
    </div>

    <!-- Table -->
    <div class="bg-white rounded-xl shadow-sm overflow-hidden border border-gray-100">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-slate-900 text-white text-xs uppercase tracking-wider">
                    <th class="p-4 font-semibold">ID</th>
                    <th class="p-4 font-semibold">City Name</th>
                    <th class="p-4 font-semibold">Created At</th>
                    <th class="p-4 font-semibold text-center">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100 text-sm font-medium text-gray-700">
                @forelse($cities as $city)
                    <tr class="hover:bg-gray-50 transition duration-150">
                        <td class="p-4 text-gray-900 font-bold">#{{ $city->id }}</td>
                        <td class="p-4 font-semibold">{{ $city->name }}</td>
                        <td class="p-4 text-gray-500">{{ isset($city->created_at) ? $city->created_at->format('d M, Y') : 'N/A' }}</td>
                        <td class="p-4 text-center">
                            <div class="flex justify-center items-center space-x-2">
                                <!-- Edit Link -->
                                <a href="#editCityModal-{{ $city->id }}" class="p-2 text-indigo-600 hover:bg-indigo-50 rounded-lg transition" title="Edit">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                </a>

                                <!-- Delete Link -->
                                <a href="#deleteCityModal-{{ $city->id }}" class="p-2 text-red-600 hover:bg-red-50 rounded-lg transition" title="Delete">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                </a>
                            </div>
                        </td>
                    </tr>

                    <!-- Pure CSS Edit Modal per City -->
                    <div id="editCityModal-{{ $city->id }}" class="modal-overlay">
                        <div class="bg-white rounded-xl shadow-xl w-full max-w-md p-6">
                            <h3 class="text-xl font-bold text-slate-900 mb-4">Edit City</h3>
                            <form action="{{ route('admin.cities') }}" method="POST">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="id" value="{{ $city->id }}">

                                <div class="mb-4">
                                    <label class="block text-sm font-semibold text-gray-700 mb-2">City Name</label>
                                    <input type="text" name="name" value="{{ $city->name }}" required class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:border-amber-500">
                                </div>

                                <div class="flex justify-end space-x-3">
                                    <a href="#" class="px-4 py-2 border border-gray-300 rounded-lg text-gray-600 hover:bg-gray-100 font-medium">Cancel</a>
                                    <button type="submit" class="px-4 py-2 bg-amber-500 text-white rounded-lg hover:bg-amber-600 font-medium">Update</button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Pure CSS Delete Modal per City -->
                    <div id="deleteCityModal-{{ $city->id }}" class="modal-overlay">
                        <div class="bg-white rounded-xl shadow-xl w-full max-w-sm p-6 text-center">
                            <svg class="w-12 h-12 text-red-500 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                            <h3 class="text-lg font-bold text-gray-800 mb-2">Are you sure?</h3>
                            <p class="text-sm text-gray-500 mb-6">Aap "{{ $city->name }}" ko delete karna chahte hain?</p>

                            <form action="{{ route('admin.cities') }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <input type="hidden" name="id" value="{{ $city->id }}">
                                <div class="flex justify-center space-x-3">
                                    <a href="#" class="px-4 py-2 border border-gray-300 rounded-lg text-gray-600 hover:bg-gray-100 font-medium">Cancel</a>
                                    <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 font-medium">Delete</button>
                                </div>
                            </form>
                        </div>
                    </div>

                @empty
                    <tr>
                        <td colspan="4" class="p-8 text-center text-gray-400">No cities found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<!-- Pure CSS Add City Modal -->
<div id="addCityModal" class="modal-overlay">
    <div class="bg-white rounded-xl shadow-xl w-full max-w-md p-6">
        <h3 class="text-xl font-bold text-slate-900 mb-4">Add New City</h3>
        <form action="{{ route('admin.cities') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label class="block text-sm font-semibold text-gray-700 mb-2">City Name</label>
                <input type="text" name="name" required placeholder="e.g. Karachi" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:border-amber-500">
            </div>

            <div class="flex justify-end space-x-3">
                <a href="#" class="px-4 py-2 border border-gray-300 rounded-lg text-gray-600 hover:bg-gray-100 font-medium">Cancel</a>
                <button type="submit" class="px-4 py-2 bg-amber-500 text-white rounded-lg hover:bg-amber-600 font-medium">Save</button>
            </div>
        </form>
    </div>
</div>

@endsection
