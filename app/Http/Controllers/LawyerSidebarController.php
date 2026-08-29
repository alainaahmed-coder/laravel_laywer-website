<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use Illuminate\Http\Request;
use App\Models\Lawyer;
use App\Models\City;
use App\Models\Service;
use App\Models\LawyerSchedule;

class LawyerSidebarController extends Controller
{
    // ================= OVERVIEW =================

    public function overview()
    {
        return view('lawyer.overview');
    }


    // ================= PROFILE =================

    public function profile()
    {
        $lawyer = Lawyer::where('user_id', auth()->id())->first();

        $cities = City::orderBy('name')->get();

        $services = Service::orderBy('name')->get();

        return view('lawyer.myprofile', compact(
            'lawyer',
            'cities',
            'services'
        ));
    }


    // ================= UPDATE PROFILE =================

    public function updateProfile(Request $request)
    {
        $request->validate([
            'city_id' => 'required|exists:cities,id',
            'service_id' => 'required|exists:services,id',
            'experience' => 'required|string|max:100',
            'fee' => 'required|numeric|min:0',
            'bio' => 'nullable|string',
            'office_address' => 'nullable|string',
            'qualifications' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = [
            'user_id' => auth()->id(),
            'city_id' => $request->city_id,
            'service_id' => $request->service_id,
            'experience' => $request->experience,
            'fee' => $request->fee,
            'bio' => $request->bio,
            'office_address' => $request->office_address,

            'qualifications' => $request->qualifications
                ? array_map('trim', explode(',', $request->qualifications))
                : null,
        ];

        // Image upload
        if ($request->hasFile('image')) {

            $imageName = time() . '.' . $request->image->extension();

            $request->image->move(
                public_path('uploads/lawyers'),
                $imageName
            );

            $data['image'] = $imageName;
        }

        Lawyer::updateOrCreate(
            [
                'user_id' => auth()->id(),
            ],
            $data
        );

        return redirect()
            ->route('lawyer.profiles')
            ->with('success', 'Profile updated successfully!');
    }


    // ================= APPOINTMENT REQUESTS =================

    public function services()
    {
        $lawyer = Lawyer::where('user_id', auth()->id())->firstOrFail();

        $requests = Appointment::with('customer')
            ->where('lawyer_id', $lawyer->id)
            ->where('status', 'pending')
            ->latest()
            ->get();

        return view('lawyer.myservices', compact('requests'));
    }


    // ================= APPROVE REQUEST =================

    public function approveRequest($id)
    {
        $lawyer = Lawyer::where('user_id', auth()->id())->firstOrFail();

        $appointment = Appointment::where('id', $id)
            ->where('lawyer_id', $lawyer->id)
            ->where('status', 'pending')
            ->firstOrFail();

        $appointment->update([
            'status' => 'approved'
        ]);

        return back()->with(
            'success',
            'Appointment approved successfully.'
        );
    }


    // ================= REJECT REQUEST =================

    public function rejectRequest($id)
    {
        $lawyer = Lawyer::where('user_id', auth()->id())->firstOrFail();

        $appointment = Appointment::where('id', $id)
            ->where('lawyer_id', $lawyer->id)
            ->where('status', 'pending')
            ->firstOrFail();

        $appointment->update([
            'status' => 'rejected'
        ]);

        return back()->with(
            'success',
            'Appointment rejected successfully.'
        );
    }


    // ================= SCHEDULE =================

    public function schedule()
    {
        $lawyer = Lawyer::where('user_id', auth()->id())
            ->firstOrFail();

        $schedules = LawyerSchedule::where(
                'lawyer_id',
                $lawyer->id
            )
            ->orderByRaw("
                FIELD(
                    day,
                    'Monday',
                    'Tuesday',
                    'Wednesday',
                    'Thursday',
                    'Friday',
                    'Saturday',
                    'Sunday'
                )
            ")
            ->orderBy('start_time')
            ->get();

        return view(
            'lawyer.mysechedule',
            compact('lawyer', 'schedules')
        );
    }


    // ================= STORE SCHEDULE =================

    public function storeSchedule(Request $request)
    {
        $request->validate([
            'day' => 'required|in:Monday,Tuesday,Wednesday,Thursday,Friday,Saturday,Sunday',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
            'slot_duration' => 'required|integer|min:5|max:180',
        ]);

        $lawyer = Lawyer::where('user_id', auth()->id())
            ->firstOrFail();

        LawyerSchedule::create([
            'lawyer_id' => $lawyer->id,
            'day' => $request->day,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
            'slot_duration' => $request->slot_duration,
        ]);

        return redirect()
            ->route('lawyer.schedule')
            ->with('success', 'Schedule added successfully!');
    }


    // ================= UPDATE SCHEDULE =================

    public function updateSchedule(Request $request, $id)
    {
        $request->validate([
            'day' => 'required|in:Monday,Tuesday,Wednesday,Thursday,Friday,Saturday,Sunday',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
            'slot_duration' => 'required|integer|min:5|max:180',
        ]);

        $lawyer = Lawyer::where('user_id', auth()->id())
            ->firstOrFail();

        $schedule = LawyerSchedule::where('id', $id)
            ->where('lawyer_id', $lawyer->id)
            ->firstOrFail();

        $schedule->update([
            'day' => $request->day,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
            'slot_duration' => $request->slot_duration,
        ]);

        return redirect()
            ->route('lawyer.schedule')
            ->with('success', 'Schedule updated successfully!');
    }


    // ================= DELETE SCHEDULE =================

    public function deleteSchedule($id)
    {
        $lawyer = Lawyer::where('user_id', auth()->id())
            ->firstOrFail();

        $schedule = LawyerSchedule::where('id', $id)
            ->where('lawyer_id', $lawyer->id)
            ->firstOrFail();

        $schedule->delete();

        return redirect()
            ->route('lawyer.schedule')
            ->with('success', 'Schedule deleted successfully!');
    }


    // ================= MY CLIENTS =================

    public function clients()
    {
        return view('lawyer.myclient');
    }


    // ================= APPOINTMENT HISTORY =================

    public function appointmentHistory()
    {
        return view('lawyer.appointmenthistory');
    }


    // ================= SETTINGS =================

    public function settings()
    {
        return view('lawyer.setting');
    }
}