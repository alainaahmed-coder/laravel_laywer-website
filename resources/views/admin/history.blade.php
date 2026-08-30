@extends('admin.sidebar')

@section('admin')

<!-- Main Wrapper -->
<div class="p-2 sm:p-4 bg-slate-50 min-h-screen w-full">

    <!-- Header Section -->
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6">

        <div>
            <h1 class="text-2xl font-black text-slate-900 tracking-tight">
                Appointments Management
            </h1>

            <p class="text-xs text-slate-500 font-medium">
                View approved and rejected customer appointments
            </p>
        </div>

    </div>


    <!-- Appointments Table Card -->
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
                            Customer
                        </th>

                        <th class="py-4 px-6">
                            Lawyer
                        </th>

                        <th class="py-4 px-6">
                            Date
                        </th>

                        <th class="py-4 px-6">
                            Time
                        </th>

                        <th class="py-4 px-6">
                            Meeting Type
                        </th>

                        <th class="py-4 px-6">
                            Case Summary
                        </th>

                        <th class="py-4 px-6 text-center">
                            Status
                        </th>

                    </tr>

                </thead>


                <!-- Table Body -->
                <tbody class="divide-y divide-slate-100 text-sm font-semibold text-slate-700">

                    @forelse($appointments as $appointment)

                        <tr class="hover:bg-slate-50/80 transition duration-150">

                            <!-- ID -->
                            <td class="py-4 px-6">

                                <span class="inline-block px-2.5 py-1 bg-slate-100 text-slate-700 font-mono text-xs font-bold rounded-lg border border-slate-200">

                                    #{{ $appointment->id }}

                                </span>

                            </td>


                            <!-- Customer -->
                            <td class="py-4 px-6">

                                <div class="flex items-center gap-2.5">

                                    <span class="w-2 h-2 rounded-full bg-emerald-500"></span>

                                    <div>
                                        <div class="text-slate-900 font-bold">
                                            {{ $appointment->customer->name ?? 'N/A' }}
                                        </div>

                                        @if($appointment->customer && $appointment->customer->email)

                                            <div class="text-xs text-slate-400 font-medium mt-0.5">
                                                {{ $appointment->customer->email }}
                                            </div>

                                        @endif

                                    </div>

                                </div>

                            </td>


                            <!-- Lawyer -->
                            <td class="py-4 px-6 text-slate-900 font-bold">

                                <div class="flex items-center gap-2.5">

                                    <span class="w-2 h-2 rounded-full bg-indigo-500"></span>

                                    {{ $appointment->lawyer->user->name ?? 'N/A' }}

                                </div>

                            </td>


                            <!-- Date -->
                            <td class="py-4 px-6 text-slate-500 text-xs font-medium">

                                @if($appointment->appointment_date)

                                    {{ $appointment->appointment_date->format('d M, Y') }}

                                @else

                                    N/A

                                @endif

                            </td>


                            <!-- Time -->
                            <td class="py-4 px-6 text-slate-500 text-xs font-medium">

                                @if($appointment->appointment_time)

                                    {{ \Carbon\Carbon::parse($appointment->appointment_time)->format('h:i A') }}

                                @else

                                    N/A

                                @endif

                            </td>


                            <!-- Meeting Type -->
                            <td class="py-4 px-6">

                                <span class="inline-block px-2.5 py-1 bg-slate-100 text-slate-700 text-xs font-bold rounded-lg border border-slate-200">

                                    {{ ucfirst($appointment->meeting_type ?? 'N/A') }}

                                </span>

                            </td>


                            <!-- Case Summary -->
                            <td class="py-4 px-6 max-w-xs">

                                @if($appointment->case_summary)

                                    <span
                                        title="{{ $appointment->case_summary }}"
                                        class="text-slate-600 text-xs font-medium"
                                    >
                                        {{ Str::limit($appointment->case_summary, 45) }}
                                    </span>

                                @else

                                    <span class="text-slate-400 text-xs">
                                        N/A
                                    </span>

                                @endif

                            </td>


                            <!-- Status -->
                            <td class="py-4 px-6 text-center">

                                @if($appointment->status === 'approved')

                                    <span class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-emerald-50 text-emerald-700 rounded-lg font-bold text-xs border border-emerald-100">

                                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>

                                        Approved

                                    </span>

                                @elseif($appointment->status === 'rejected')

                                    <span class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-red-50 text-red-700 rounded-lg font-bold text-xs border border-red-100">

                                        <span class="w-1.5 h-1.5 rounded-full bg-red-500"></span>

                                        Rejected

                                    </span>

                                @else

                                    <span class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-slate-100 text-slate-600 rounded-lg font-bold text-xs border border-slate-200">

                                        {{ ucfirst($appointment->status ?? 'Unknown') }}

                                    </span>

                                @endif

                            </td>

                        </tr>


                    @empty

                        <!-- Empty State -->

                        <tr>

                            <td colspan="8" class="py-12 text-center text-slate-400 font-medium">

                                <div class="flex flex-col items-center justify-center">

                                    <svg
                                        class="w-10 h-10 mb-3 text-slate-300"
                                        fill="none"
                                        stroke="currentColor"
                                        viewBox="0 0 24 24"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="1.5"
                                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"
                                        />
                                    </svg>

                                    <p class="text-sm font-semibold text-slate-400">
                                        No approved or rejected appointments found.
                                    </p>

                                </div>

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>


<!-- Tailwind CSS -->
<script src="https://cdn.tailwindcss.com"></script>

@endsection
