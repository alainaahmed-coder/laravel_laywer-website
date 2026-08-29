<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Lawyer;
use App\Models\LawyerSchedule;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Available Slots
    |--------------------------------------------------------------------------
    */

    public function availableSlots(Request $request, $lawyerId)
    {
        $request->validate([
            'date' => 'required|date',
        ]);

        $lawyer = Lawyer::findOrFail($lawyerId);

        $date = Carbon::parse($request->date);

        // Get day name
        $day = $date->format('l');


        /*
        |--------------------------------------------------------------------------
        | Find Lawyer Schedule
        |--------------------------------------------------------------------------
        */

        $schedule = LawyerSchedule::where(
            'lawyer_id',
            $lawyer->id
        )
            ->whereRaw(
                'LOWER(TRIM(day)) = ?',
                [strtolower($day)]
            )
            ->orderBy('start_time')
            ->first();


        /*
        |--------------------------------------------------------------------------
        | No Schedule
        |--------------------------------------------------------------------------
        */

        if (!$schedule) {

            return response()->json([
                'available' => false,
                'message' => "Lawyer is not available on {$day}.",
                'day' => $day,
                'slots' => [],
            ]);
        }


        /*
        |--------------------------------------------------------------------------
        | Get Already Booked Slots
        |--------------------------------------------------------------------------
        */

        $bookedSlots = Appointment::where(
            'lawyer_id',
            $lawyer->id
        )
            ->whereDate(
                'appointment_date',
                $date->format('Y-m-d')
            )
            ->whereNotIn('status', [
                'rejected',
                'cancelled',
            ])
            ->pluck('appointment_time')
            ->map(function ($time) {

                return Carbon::parse($time)
                    ->format('H:i');

            })
            ->toArray();


        /*
        |--------------------------------------------------------------------------
        | Generate Slots
        |--------------------------------------------------------------------------
        */

        $slots = [];

        $start = Carbon::parse(
            $date->format('Y-m-d') .
            ' ' .
            $schedule->start_time
        );

        $end = Carbon::parse(
            $date->format('Y-m-d') .
            ' ' .
            $schedule->end_time
        );


        while ($start->lt($end)) {

            $slotStart = $start->copy();

            $slotEnd = $start->copy()
                ->addMinutes(
                    $schedule->slot_duration
                );


            // Don't create slot after schedule end
            if ($slotEnd->gt($end)) {
                break;
            }


            $time = $slotStart->format('H:i');


            $slots[] = [
                'time' => $time,

                'display_time' =>
                    $slotStart->format('h:i A'),

                'booked' =>
                    in_array($time, $bookedSlots),
            ];


            $start->addMinutes(
                $schedule->slot_duration
            );
        }


        /*
        |--------------------------------------------------------------------------
        | Return JSON
        |--------------------------------------------------------------------------
        */

        return response()->json([

            'available' => true,

            'day' => $day,

            'schedule' => [

                'start_time' =>
                    $schedule->start_time,

                'end_time' =>
                    $schedule->end_time,

                'slot_duration' =>
                    $schedule->slot_duration,
            ],

            'slots' => $slots,

        ]);
    }


    /*
    |--------------------------------------------------------------------------
    | Store Appointment
    |--------------------------------------------------------------------------
    */

    public function store(Request $request)
    {
        /*
        |--------------------------------------------------------------------------
        | CHECK LOGIN
        |--------------------------------------------------------------------------
        |
        | Route public hai, isliye guest yahan aa sakta hai.
        | Agar login nahi hai to REGISTER page par bhejenge.
        |
        */

        if (!auth()->check()) {

            return redirect()
                ->route('register')
                ->with(
                    'error',
                    'Please register or login before booking an appointment.'
                );
        }


        /*
        |--------------------------------------------------------------------------
        | ONLY CUSTOMER CAN BOOK
        |--------------------------------------------------------------------------
        */

        if (auth()->user()->role !== 'customer') {

            return back()->with(
                'error',
                'Only customers can book appointments.'
            );
        }


        /*
        |--------------------------------------------------------------------------
        | VALIDATION
        |--------------------------------------------------------------------------
        */

        $request->validate([

            'lawyer_id' =>
                'required|exists:lawyers,id',

            'appointment_date' => [
                'required',
                'date',
                'after_or_equal:today',
            ],

            'time_slot' =>
                'required|date_format:H:i',

            'meeting_type' =>
                'required|string|max:100',

            'case_summary' =>
                'nullable|string',

        ]);


        /*
        |--------------------------------------------------------------------------
        | Find Lawyer
        |--------------------------------------------------------------------------
        */

        $lawyer = Lawyer::findOrFail(
            $request->lawyer_id
        );


        /*
        |--------------------------------------------------------------------------
        | Date + Day
        |--------------------------------------------------------------------------
        */

        $date = Carbon::parse(
            $request->appointment_date
        );

        $day = $date->format('l');


        /*
        |--------------------------------------------------------------------------
        | Check Lawyer Schedule
        |--------------------------------------------------------------------------
        */

        $schedule = LawyerSchedule::where(
            'lawyer_id',
            $lawyer->id
        )
            ->whereRaw(
                'LOWER(TRIM(day)) = ?',
                [strtolower($day)]
            )
            ->orderBy('start_time')
            ->first();


        if (!$schedule) {

            return back()
                ->withErrors([
                    'appointment_date' =>
                        'Lawyer is not available on this date.'
                ])
                ->withInput();
        }


        /*
        |--------------------------------------------------------------------------
        | Check Selected Time
        |--------------------------------------------------------------------------
        */

        $start = Carbon::parse(
            $date->format('Y-m-d') .
            ' ' .
            $schedule->start_time
        );

        $end = Carbon::parse(
            $date->format('Y-m-d') .
            ' ' .
            $schedule->end_time
        );

        $selectedTime = Carbon::parse(
            $date->format('Y-m-d') .
            ' ' .
            $request->time_slot
        );


        if (
            $selectedTime->lt($start) ||
            $selectedTime->gte($end)
        ) {

            return back()
                ->withErrors([
                    'time_slot' =>
                        'Selected time is not available.'
                ])
                ->withInput();
        }


        /*
        |--------------------------------------------------------------------------
        | Check Duplicate Booking
        |--------------------------------------------------------------------------
        */

        $alreadyBooked = Appointment::where(
            'lawyer_id',
            $lawyer->id
        )
            ->whereDate(
                'appointment_date',
                $date->format('Y-m-d')
            )
            ->where(
                'appointment_time',
                $request->time_slot
            )
            ->whereNotIn('status', [
                'rejected',
                'cancelled',
            ])
            ->exists();


        if ($alreadyBooked) {

            return back()
                ->withErrors([
                    'time_slot' =>
                        'This time slot has already been booked.'
                ])
                ->withInput();
        }


        /*
        |--------------------------------------------------------------------------
        | Create Appointment
        |--------------------------------------------------------------------------
        */

        Appointment::create([

            'lawyer_id' =>
                $lawyer->id,

            'customer_id' =>
                auth()->id(),

            'appointment_date' =>
                $date->format('Y-m-d'),

            'appointment_time' =>
                $request->time_slot,

            'meeting_type' =>
                $request->meeting_type,

            'case_summary' =>
                $request->case_summary,

            'status' =>
                'pending',

        ]);


        /*
        |--------------------------------------------------------------------------
        | Booking Successful
        |--------------------------------------------------------------------------
        */

        return redirect()
            ->route('customerdashboard')
            ->with(
                'success',
                'Appointment booked successfully! Waiting for lawyer approval.'
            );
    }
}