@extends('lawyer.sidebar')

@section('laywer')

<div class="col-lg-9 col-xl-10">
<div class="w-100">

    {{-- ================= HEADER ================= --}}
    <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">

        <div>
            <h2 class="fw-bold text-dark mb-1">
                My Schedule
            </h2>

            <p class="text-muted small mb-0">
                Manage your weekly availability and consultation time.
            </p>
        </div>

        {{-- SCHEDULE COUNT --}}
        <div class="d-flex align-items-center gap-2 px-3 py-2 rounded-3"
             style="background:#0f172a; color:#fff;">

            <i class="bi bi-calendar-week text-warning"></i>

            <span class="fw-bold small">
                {{ $schedules->count() }} Schedules
            </span>

        </div>

    </div>


    {{-- ================= SUCCESS MESSAGE ================= --}}
    @if(session('success'))

        <div class="alert alert-success border-0 shadow-sm rounded-3 small fw-semibold">

            <i class="bi bi-check-circle-fill me-2"></i>

            {{ session('success') }}

        </div>

    @endif


    {{-- ================= ERROR MESSAGE ================= --}}
    @if($errors->any())

        <div class="alert alert-danger border-0 shadow-sm rounded-3 small">

            <div class="fw-bold mb-2">
                <i class="bi bi-exclamation-triangle-fill me-2"></i>
                Please fix the following errors:
            </div>

            <ul class="mb-0 ps-4">

                @foreach($errors->all() as $error)

                    <li>{{ $error }}</li>

                @endforeach

            </ul>

        </div>

    @endif


    {{-- ================= TABLE CARD ================= --}}
    <div class="card border-0 shadow-sm rounded-4 overflow-hidden">

        {{-- CARD HEADER --}}
        <div class="p-4 d-flex flex-wrap justify-content-between align-items-center gap-3"
             style="background:#fff;">

            <div>

                <h5 class="fw-bold text-dark mb-1">

                    <i class="bi bi-calendar-check me-2"
                       style="color:#f59e0b;">
                    </i>

                    My Schedules

                </h5>

                <p class="text-muted small mb-0">
                    Your weekly consultation availability.
                </p>

            </div>


            {{-- ADD SCHEDULE --}}
            <button type="button"
                    class="btn fw-bold rounded-3 px-4"
                    data-bs-toggle="modal"
                    data-bs-target="#addScheduleModal"
                    style="
                        background:#f59e0b;
                        color:#0f172a;
                    ">

                <i class="bi bi-plus-circle me-1"></i>

                Add Schedule

            </button>

        </div>


        {{-- ================= TABLE ================= --}}
        @if($schedules->count() > 0)

            <div class="table-responsive">

                <table class="table align-middle mb-0">

                    <thead>

                        <tr>

                            <th class="px-4 py-3 small fw-bold"
                                style="background:#0f172a !important; color:#cbd5e1 !important;">
                                Day
                            </th>

                            <th class="px-4 py-3 small fw-bold"
                                style="background:#0f172a !important; color:#cbd5e1 !important;">
                                Start Time
                            </th>

                            <th class="px-4 py-3 small fw-bold"
                                style="background:#0f172a !important; color:#cbd5e1 !important;">
                                End Time
                            </th>

                            <th class="px-4 py-3 small fw-bold"
                                style="background:#0f172a !important; color:#cbd5e1 !important;">
                                Duration
                            </th>

                            <th class="px-4 py-3 small fw-bold text-center"
                                style="background:#0f172a !important; color:#cbd5e1 !important;">
                                Actions
                            </th>

                        </tr>

                    </thead>


                    <tbody>

                        @foreach($schedules as $schedule)

                            <tr>

                                {{-- DAY --}}
                                <td class="px-4 py-3">

                                    <div class="d-flex align-items-center gap-2">

                                        <span class="d-inline-flex align-items-center justify-content-center rounded-2"
                                              style="
                                                width:34px;
                                                height:34px;
                                                background:#fff7ed;
                                                color:#ea580c;
                                              ">

                                            <i class="bi bi-calendar-day"></i>

                                        </span>

                                        <span class="fw-bold text-dark small">

                                            {{ $schedule->day }}

                                        </span>

                                    </div>

                                </td>


                                {{-- START TIME --}}
                                <td class="px-4 py-3">

                                    <span class="badge rounded-2 px-3 py-2"
                                          style="
                                            background:#eef2ff;
                                            color:#4338ca;
                                            border:1px solid #e0e7ff;
                                          ">

                                        <i class="bi bi-clock me-1"></i>

                                        {{ \Carbon\Carbon::parse($schedule->start_time)->format('h:i A') }}

                                    </span>

                                </td>


                                {{-- END TIME --}}
                                <td class="px-4 py-3">

                                    <span class="badge rounded-2 px-3 py-2"
                                          style="
                                            background:#fef2f2;
                                            color:#b91c1c;
                                            border:1px solid #fecaca;
                                          ">

                                        <i class="bi bi-clock me-1"></i>

                                        {{ \Carbon\Carbon::parse($schedule->end_time)->format('h:i A') }}

                                    </span>

                                </td>


                                {{-- DURATION --}}
                                <td class="px-4 py-3">

                                    <span class="fw-bold text-dark small">

                                        {{ $schedule->slot_duration }}

                                    </span>

                                    <span class="text-muted small">
                                        minutes
                                    </span>

                                </td>


                                {{-- ACTIONS --}}
                                <td class="px-4 py-3">

                                    <div class="d-flex justify-content-center gap-2">

                                        {{-- EDIT --}}
                                        <button type="button"
                                                class="btn btn-sm rounded-2 fw-bold px-3"
                                                data-bs-toggle="modal"
                                                data-bs-target="#editScheduleModal{{ $schedule->id }}"
                                                style="
                                                    background:#eef2ff;
                                                    color:#4338ca;
                                                    border:1px solid #e0e7ff;
                                                ">

                                            <i class="bi bi-pencil me-1"></i>

                                            Edit

                                        </button>


                                        {{-- DELETE --}}
                                        <form
                                            action="{{ route('lawyer.schedule.delete', $schedule->id) }}"
                                            method="POST"
                                            onsubmit="return confirm('Are you sure you want to delete this schedule?');"
                                        >

                                            @csrf
                                            @method('DELETE')

                                            <button type="submit"
                                                    class="btn btn-sm rounded-2 fw-bold px-3"
                                                    style="
                                                        background:#fef2f2;
                                                        color:#b91c1c;
                                                        border:1px solid #fecaca;
                                                    ">

                                                <i class="bi bi-trash me-1"></i>

                                                Delete

                                            </button>

                                        </form>

                                    </div>

                                </td>

                            </tr>

                        @endforeach

                    </tbody>

                </table>

            </div>

        @else

            {{-- ================= EMPTY STATE ================= --}}
            <div class="text-center py-5">

                <div class="d-inline-flex align-items-center justify-content-center rounded-4 mb-3"
                     style="
                        width:70px;
                        height:70px;
                        background:#f1f5f9;
                     ">

                    <i class="bi bi-calendar-x"
                       style="
                            font-size:32px;
                            color:#94a3b8;
                       ">
                    </i>

                </div>

                <h5 class="fw-bold text-dark mb-1">
                    No Schedule Added
                </h5>

                <p class="text-muted small mb-3">
                    You haven't added any weekly schedule yet.
                </p>

                <button type="button"
                        class="btn fw-bold rounded-3 px-4"
                        data-bs-toggle="modal"
                        data-bs-target="#addScheduleModal"
                        style="
                            background:#f59e0b;
                            color:#0f172a;
                        ">

                    <i class="bi bi-plus-circle me-1"></i>

                    Add Your First Schedule

                </button>

            </div>

        @endif

    </div>

</div>


</div>

{{-- ================================================= --}}
{{-- ADD SCHEDULE MODAL --}}
{{-- ================================================= --}}

<div class="modal fade"
     id="addScheduleModal"
     tabindex="-1"
     aria-hidden="true">


<div class="modal-dialog modal-dialog-centered">

    <div class="modal-content border-0 shadow-lg rounded-4">

        {{-- HEADER --}}
        <div class="modal-header border-0">

            <div>

                <h5 class="modal-title fw-bold text-dark">

                    <i class="bi bi-calendar-plus me-2 text-warning"></i>

                    Add Schedule

                </h5>

                <small class="text-muted">
                    Set your available consultation time.
                </small>

            </div>

            <button type="button"
                    class="btn-close"
                    data-bs-dismiss="modal">
            </button>

        </div>


        <form method="POST"
              action="{{ route('lawyer.schedule.store') }}">

            @csrf

            <div class="modal-body">

                {{-- DAY --}}
                <div class="mb-3">

                    <label class="form-label fw-bold small">
                        Day
                    </label>

                    <select name="day"
                            class="form-select rounded-3"
                            required>

                        <option value="">
                            Select Day
                        </option>

                        @foreach([
                            'Monday',
                            'Tuesday',
                            'Wednesday',
                            'Thursday',
                            'Friday',
                            'Saturday',
                            'Sunday'
                        ] as $day)

                            <option value="{{ $day }}"
                                {{ old('day') == $day ? 'selected' : '' }}>

                                {{ $day }}

                            </option>

                        @endforeach

                    </select>

                </div>


                {{-- START TIME --}}
                <div class="mb-3">

                    <label class="form-label fw-bold small">
                        Start Time
                    </label>

                    <input type="time"
                           name="start_time"
                           class="form-control rounded-3"
                           value="{{ old('start_time') }}"
                           required>

                </div>


                {{-- END TIME --}}
                <div class="mb-3">

                    <label class="form-label fw-bold small">
                        End Time
                    </label>

                    <input type="time"
                           name="end_time"
                           class="form-control rounded-3"
                           value="{{ old('end_time') }}"
                           required>

                </div>


                {{-- SLOT DURATION --}}
                <div class="mb-3">

                    <label class="form-label fw-bold small">
                        Slot Duration
                    </label>

                    <select name="slot_duration"
                            class="form-select rounded-3"
                            required>

                        <option value="">
                            Select Duration
                        </option>

                        <option value="15"
                            {{ old('slot_duration') == 15 ? 'selected' : '' }}>
                            15 Minutes
                        </option>

                        <option value="30"
                            {{ old('slot_duration', 30) == 30 ? 'selected' : '' }}>
                            30 Minutes
                        </option>

                        <option value="45"
                            {{ old('slot_duration') == 45 ? 'selected' : '' }}>
                            45 Minutes
                        </option>

                        <option value="60"
                            {{ old('slot_duration') == 60 ? 'selected' : '' }}>
                            1 Hour
                        </option>

                        <option value="90"
                            {{ old('slot_duration') == 90 ? 'selected' : '' }}>
                            1.5 Hours
                        </option>

                        <option value="120"
                            {{ old('slot_duration') == 120 ? 'selected' : '' }}>
                            2 Hours
                        </option>

                    </select>

                </div>

            </div>


            {{-- FOOTER --}}
            <div class="modal-footer border-0">

                <button type="button"
                        class="btn btn-light rounded-3 fw-semibold"
                        data-bs-dismiss="modal">

                    Cancel

                </button>

                <button type="submit"
                        class="btn rounded-3 fw-bold px-4"
                        style="
                            background:#f59e0b;
                            color:#0f172a;
                        ">

                    <i class="bi bi-plus-circle me-1"></i>

                    Add Schedule

                </button>

            </div>

        </form>

    </div>

</div>


</div>

{{-- ================================================= --}}
{{-- EDIT SCHEDULE MODALS --}}
{{-- ================================================= --}}

@foreach($schedules as $schedule)


<div class="modal fade"
     id="editScheduleModal{{ $schedule->id }}"
     tabindex="-1"
     aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered">

        <div class="modal-content border-0 shadow-lg rounded-4">

            {{-- HEADER --}}
            <div class="modal-header border-0">

                <div>

                    <h5 class="modal-title fw-bold text-dark">

                        <i class="bi bi-pencil-square me-2 text-warning"></i>

                        Edit Schedule

                    </h5>

                    <small class="text-muted">
                        Update your availability.
                    </small>

                </div>

                <button type="button"
                        class="btn-close"
                        data-bs-dismiss="modal">
                </button>

            </div>


            <form method="POST"
                  action="{{ route('lawyer.schedule.update', $schedule->id) }}">

                @csrf
                @method('PUT')

                <div class="modal-body">

                    {{-- DAY --}}
                    <div class="mb-3">

                        <label class="form-label fw-bold small">
                            Day
                        </label>

                        <select name="day"
                                class="form-select rounded-3"
                                required>

                            @foreach([
                                'Monday',
                                'Tuesday',
                                'Wednesday',
                                'Thursday',
                                'Friday',
                                'Saturday',
                                'Sunday'
                            ] as $day)

                                <option value="{{ $day }}"
                                    {{ $schedule->day == $day ? 'selected' : '' }}>

                                    {{ $day }}

                                </option>

                            @endforeach

                        </select>

                    </div>


                    {{-- START TIME --}}
                    <div class="mb-3">

                        <label class="form-label fw-bold small">
                            Start Time
                        </label>

                        <input type="time"
                               name="start_time"
                               class="form-control rounded-3"
                               value="{{ \Carbon\Carbon::parse($schedule->start_time)->format('H:i') }}"
                               required>

                    </div>


                    {{-- END TIME --}}
                    <div class="mb-3">

                        <label class="form-label fw-bold small">
                            End Time
                        </label>

                        <input type="time"
                               name="end_time"
                               class="form-control rounded-3"
                               value="{{ \Carbon\Carbon::parse($schedule->end_time)->format('H:i') }}"
                               required>

                    </div>


                    {{-- SLOT DURATION --}}
                    <div class="mb-3">

                        <label class="form-label fw-bold small">
                            Slot Duration
                        </label>

                        <select name="slot_duration"
                                class="form-select rounded-3"
                                required>

                            @foreach([
                                15,
                                30,
                                45,
                                60,
                                90,
                                120
                            ] as $duration)

                                <option value="{{ $duration }}"
                                    {{ $schedule->slot_duration == $duration ? 'selected' : '' }}>

                                    @if($duration == 60)

                                        1 Hour

                                    @elseif($duration == 90)

                                        1.5 Hours

                                    @elseif($duration == 120)

                                        2 Hours

                                    @else

                                        {{ $duration }} Minutes

                                    @endif

                                </option>

                            @endforeach

                        </select>

                    </div>

                </div>


                {{-- FOOTER --}}
                <div class="modal-footer border-0">

                    <button type="button"
                            class="btn btn-light rounded-3 fw-semibold"
                            data-bs-dismiss="modal">

                        Cancel

                    </button>

                    <button type="submit"
                            class="btn rounded-3 fw-bold px-4"
                            style="
                                background:#f59e0b;
                                color:#0f172a;
                            ">

                        <i class="bi bi-check-circle me-1"></i>

                        Update Schedule

                    </button>

                </div>

            </form>

        </div>

    </div>

</div>


@endforeach

@endsection
