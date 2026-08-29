<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Models\Lawyer;
use App\Models\LawyerSchedule;
use App\Models\Appointment;
use Carbon\Carbon;

class landingpageController extends Controller
{
    // 1. Welcome / Landing Page
    public function index()
    {
        $lawyers = Lawyer::with(['user', 'city', 'service'])
            ->select([
                'id',
                'user_id',
                'city_id',
                'service_id',
                'image',
                'experience',
                'fee',
                'bio',
                'rating',
                'total_reviews',
                'is_verified',
                'is_approved',
                'is_active',
            ])
            ->latest()
            ->take(6)
            ->get();

        return view('welcome', compact('lawyers'));
    }


    // 2. Find Lawyer Page
    public function findLawyer(Request $request)
    {
        $query = Lawyer::with(['user', 'city', 'service'])
            ->select([
                'id',
                'user_id',
                'city_id',
                'service_id',
                'image',
                'experience',
                'fee',
                'bio',
                'is_verified',
                'is_approved',
                'is_active',
            ]);

        // Search by lawyer name OR service
        if ($request->filled('q')) {

            $search = trim($request->q);

            $query->where(function ($q) use ($search) {

                // Search in users table
                $q->whereHas('user', function ($userQuery) use ($search) {
                    $userQuery->where('name', 'like', "%{$search}%");
                })

                    // Search in services table
                    ->orWhereHas('service', function ($serviceQuery) use ($search) {
                        $serviceQuery->where('name', 'like', "%{$search}%");
                    });
            });
        }

        // Filter by city
        if ($request->filled('city')) {

            $query->whereHas('city', function ($cityQuery) use ($request) {
                $cityQuery->where('name', $request->city);
            });
        }

        // Filter by service
        if ($request->filled('spec')) {

            $query->whereHas('service', function ($serviceQuery) use ($request) {
                $serviceQuery->where('name', $request->spec);
            });
        }

        // Get lawyers
        $lawyers = $query
            ->latest()
            ->get();

        // Cities dropdown
        $cities = \App\Models\City::orderBy('name')
            ->pluck('name');

        // Services dropdown
        $specializations = \App\Models\Service::orderBy('name')
            ->pluck('name');

        return view(
            'findLawyer',
            compact(
                'lawyers',
                'cities',
                'specializations'
            )
        );
    }


    // 3. Lawyer Profile
    public function lawyerProfile(Request $request, $id)
    {
        $lawyer = Lawyer::with([
            'user',
            'city',
            'service',
            'schedules'
        ])->findOrFail($id);


        // Selected date
        $selectedDate = $request->input(
            'appointment_date',
            Carbon::tomorrow()->format('Y-m-d')
        );


        $date = Carbon::parse($selectedDate);


        // Example: Sunday
        $dayName = $date->format('l');


        // Lawyer ka selected day ka schedule
        $schedule = $lawyer->schedules()
            ->where('day', $dayName)
            ->orderBy('start_time')
            ->first();


        $slots = [];


        if ($schedule) {

            $start = Carbon::parse(
                $selectedDate . ' ' . $schedule->start_time
            );

            $end = Carbon::parse(
                $selectedDate . ' ' . $schedule->end_time
            );


            // Already booked slots
            $bookedSlots = Appointment::where(
                'lawyer_id',
                $lawyer->id
            )
                ->whereDate(
                    'appointment_date',
                    $selectedDate
                )
                ->whereNotIn('status', [
                    'rejected',
                    'cancelled'
                ])
                ->pluck('appointment_time')
                ->map(function ($time) {

                    return Carbon::parse($time)
                        ->format('H:i');
                })
                ->toArray();


            while ($start->lt($end)) {

                $slotEnd = $start->copy()
                    ->addMinutes($schedule->slot_duration);


                if ($slotEnd->gt($end)) {
                    break;
                }


                $time = $start->format('H:i');


                $slots[] = [
                    'time' => $time,

                    'display_time' =>
                    $start->format('h:i A'),

                    'booked' =>
                    in_array($time, $bookedSlots),
                ];


                $start->addMinutes(
                    $schedule->slot_duration
                );
            }
        }


        return view(
            'lawyer_profile',
            compact(
                'lawyer',
                'selectedDate',
                'dayName',
                'schedule',
                'slots'
            )
        );
    }

    // 4. About Page
    public function about()
    {
        return view('about');
    }


    // 5. Contact Page
    public function contact()
    {
        return view('contact');
    }


    // 6. Contact Form
    public function contactSend(Request $request)
    {
        $request->validate([
            'name'    => 'required|string|max:255',
            'email'   => 'required|email|max:255',
            'phone'   => 'nullable|string|max:20',
            'subject' => 'required|string|max:255',
            'message' => 'required|string|min:10',
        ]);

        $data = $request->all();

        Mail::raw(
            "Name: {$data['name']}\n" .
                "Email: {$data['email']}\n" .
                "Phone: " . ($data['phone'] ?? 'N/A') . "\n\n" .
                "Message:\n{$data['message']}",

            function ($message) use ($data) {

                $message->to('support@legalease.pk')
                    ->subject("Contact Form: " . $data['subject']);
            }
        );

        return redirect()
            ->back()
            ->with(
                'success',
                'Your message has been sent successfully!'
            );
    }
}
