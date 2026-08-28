@extends('lawyer.sidebar')

@section('laywer')

<div class="col-lg-9 col-xl-10">

```
{{-- Page Header --}}
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="text-navy mb-1">
            <i class="bi bi-calendar-week me-2"></i>
            My Schedule
        </h2>

        <p class="text-muted mb-0">
            Manage your weekly availability and consultation time.
        </p>
    </div>
</div>


{{-- Success Message --}}
@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="bi bi-check-circle me-2"></i>
        {{ session('success') }}

        <button type="button"
                class="btn-close"
                data-bs-dismiss="alert">
        </button>
    </div>
@endif


{{-- Validation Errors --}}
@if($errors->any())
    <div class="alert alert-danger alert-dismissible fade show" role="alert">

        <strong>
            <i class="bi bi-exclamation-triangle me-2"></i>
            Please fix the following errors:
        </strong>

        <ul class="mb-0 mt-2">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>

        <button type="button"
                class="btn-close"
                data-bs-dismiss="alert">
        </button>

    </div>
@endif


{{-- ================= MY SCHEDULES ================= --}}
<div class="card-legal p-4">

    {{-- Table Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>
            <h4 class="text-navy mb-1">
                <i class="bi bi-calendar-week me-2"></i>
                My Schedules
            </h4>

            <p class="text-muted mb-0">
                Your weekly availability.
            </p>
        </div>

        {{-- Add Schedule Button --}}
        <button type="button"
                class="btn btn-gold px-4"
                data-bs-toggle="modal"
                data-bs-target="#addScheduleModal">

            <i class="bi bi-plus-circle me-1"></i>
            Add Schedule

        </button>

    </div>


    {{-- Schedule Count --}}
    <div class="mb-3">

        <span class="badge bg-light text-dark border px-3 py-2">
            <i class="bi bi-calendar-check me-1"></i>
            {{ $schedules->count() }} Schedule(s)
        </span>

    </div>


    {{-- ================= SCHEDULE TABLE ================= --}}
    @if($schedules->count() > 0)

        <div class="table-responsive">

            <table class="table table-hover align-middle">

                <thead class="table-light">

                    <tr>

                        <th>Day</th>

                        <th>Start Time</th>

                        <th>End Time</th>

                        <th>Slot Duration</th>

                        <th class="text-end">
                            Actions
                        </th>

                    </tr>

                </thead>


                <tbody>

                    @foreach($schedules as $schedule)

                        <tr>

                            {{-- Day --}}
                            <td>

                                <span class="badge bg-light text-navy border px-3 py-2">

                                    <i class="bi bi-calendar-day me-1"></i>

                                    {{ $schedule->day }}

                                </span>

                            </td>


                            {{-- Start Time --}}
                            <td>

                                <i class="bi bi-clock me-1 text-muted"></i>

                                {{ \Carbon\Carbon::parse($schedule->start_time)->format('h:i A') }}

                            </td>


                            {{-- End Time --}}
                            <td>

                                <i class="bi bi-clock me-1 text-muted"></i>

                                {{ \Carbon\Carbon::parse($schedule->end_time)->format('h:i A') }}

                            </td>


                            {{-- Duration --}}
                            <td>

                                <span class="fw-semibold">

                                    {{ $schedule->slot_duration }}

                                </span>

                                minutes

                            </td>


                            {{-- Actions --}}
                            <td class="text-end">

                                {{-- Edit --}}
                                <button type="button"
                                        class="btn btn-sm btn-outline-primary me-1"
                                        data-bs-toggle="modal"
                                        data-bs-target="#editScheduleModal{{ $schedule->id }}"
                                        title="Edit Schedule">

                                    <i class="bi bi-pencil"></i>

                                </button>


                                {{-- Delete --}}
                                <form action="{{ route('lawyer.schedule.delete', $schedule->id) }}"
                                      method="POST"
                                      class="d-inline"
                                      onsubmit="return confirm('Are you sure you want to delete this schedule?');">

                                    @csrf

                                    @method('DELETE')

                                    <button type="submit"
                                            class="btn btn-sm btn-outline-danger"
                                            title="Delete Schedule">

                                        <i class="bi bi-trash"></i>

                                    </button>

                                </form>

                            </td>

                        </tr>

                    @endforeach

                </tbody>

            </table>

        </div>

    @else

        {{-- No Schedule --}}
        <div class="text-center py-5">

            <i class="bi bi-calendar-x fs-1 text-muted"></i>

            <h5 class="mt-3 text-navy">
                No Schedule Added
            </h5>

            <p class="text-muted mb-3">
                You haven't added any weekly schedule yet.
            </p>

            <button type="button"
                    class="btn btn-gold"
                    data-bs-toggle="modal"
                    data-bs-target="#addScheduleModal">

                <i class="bi bi-plus-circle me-1"></i>

                Add Your First Schedule

            </button>

        </div>

    @endif

</div>


{{-- ================================================= --}}
{{-- ADD SCHEDULE MODAL --}}
{{-- ================================================= --}}

<div class="modal fade"
     id="addScheduleModal"
     tabindex="-1"
     aria-labelledby="addScheduleModalLabel"
     aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered">

        <div class="modal-content border-0 shadow rounded-4">


            {{-- Modal Header --}}
            <div class="modal-header">

                <div>

                    <h5 class="modal-title text-navy"
                        id="addScheduleModalLabel">

                        <i class="bi bi-calendar-plus me-2"></i>

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


            {{-- Add Form --}}
            <form method="POST"
                  action="{{ route('lawyer.schedule.store') }}">

                @csrf

                <div class="modal-body">

                    {{-- Day --}}
                    <div class="mb-3">

                        <label class="form-label fw-semibold">
                            Day
                        </label>

                        <select name="day"
                                class="form-select"
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


                    {{-- Start Time --}}
                    <div class="mb-3">

                        <label class="form-label fw-semibold">
                            Start Time
                        </label>

                        <input type="time"
                               name="start_time"
                               class="form-control"
                               value="{{ old('start_time') }}"
                               required>

                    </div>


                    {{-- End Time --}}
                    <div class="mb-3">

                        <label class="form-label fw-semibold">
                            End Time
                        </label>

                        <input type="time"
                               name="end_time"
                               class="form-control"
                               value="{{ old('end_time') }}"
                               required>

                    </div>


                    {{-- Slot Duration --}}
                    <div class="mb-3">

                        <label class="form-label fw-semibold">
                            Slot Duration
                        </label>

                        <select name="slot_duration"
                                class="form-select"
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


                {{-- Modal Footer --}}
                <div class="modal-footer">

                    <button type="button"
                            class="btn btn-secondary"
                            data-bs-dismiss="modal">

                        Cancel

                    </button>

                    <button type="submit"
                            class="btn btn-gold">

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
         aria-labelledby="editScheduleLabel{{ $schedule->id }}"
         aria-hidden="true">

        <div class="modal-dialog modal-dialog-centered">

            <div class="modal-content border-0 shadow rounded-4">


                {{-- Edit Header --}}
                <div class="modal-header">

                    <div>

                        <h5 class="modal-title text-navy"
                            id="editScheduleLabel{{ $schedule->id }}">

                            <i class="bi bi-pencil-square me-2"></i>

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


                {{-- Edit Form --}}
                <form method="POST"
                      action="{{ route('lawyer.schedule.update', $schedule->id) }}">

                    @csrf

                    @method('PUT')


                    <div class="modal-body">

                        {{-- Day --}}
                        <div class="mb-3">

                            <label class="form-label fw-semibold">
                                Day
                            </label>

                            <select name="day"
                                    class="form-select"
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


                        {{-- Start Time --}}
                        <div class="mb-3">

                            <label class="form-label fw-semibold">
                                Start Time
                            </label>

                            <input type="time"
                                   name="start_time"
                                   class="form-control"
                                   value="{{ \Carbon\Carbon::parse($schedule->start_time)->format('H:i') }}"
                                   required>

                        </div>


                        {{-- End Time --}}
                        <div class="mb-3">

                            <label class="form-label fw-semibold">
                                End Time
                            </label>

                            <input type="time"
                                   name="end_time"
                                   class="form-control"
                                   value="{{ \Carbon\Carbon::parse($schedule->end_time)->format('H:i') }}"
                                   required>

                        </div>


                        {{-- Slot Duration --}}
                        <div class="mb-3">

                            <label class="form-label fw-semibold">
                                Slot Duration
                            </label>

                            <select name="slot_duration"
                                    class="form-select"
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


                    {{-- Edit Footer --}}
                    <div class="modal-footer">

                        <button type="button"
                                class="btn btn-secondary"
                                data-bs-dismiss="modal">

                            Cancel

                        </button>

                        <button type="submit"
                                class="btn btn-gold">

                            <i class="bi bi-check-circle me-1"></i>

                            Update Schedule

                        </button>

                    </div>

                </form>

            </div>

        </div>

    </div>

@endforeach


</div>

@endsection
