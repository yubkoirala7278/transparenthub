<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Appoinment;
use App\Models\Professional;
use App\Models\ProfessionalCategory;
use App\Models\ProfessionalSchedule;
use App\Models\ProfessionalSubCategory;
use App\Models\User;
use Illuminate\Http\Request;

class ProfessionalController extends Controller
{
    public function index(Request $request)
    {
        try {
            $keyword = $request->input('keyword');
            $categoryId = $request->input('category');
            $subCategoryId = $request->input('sub_category');
            $location = $request->input('location');

            $query = User::role('professional')->where('status', 'active');

            if ($keyword) {
                $query->where('name', 'like', '%' . $keyword . '%');
            }
            if ($categoryId) {
                $query->whereHas('professional', function ($q) use ($categoryId) {
                    $q->where('category_id', $categoryId);
                });
            }
            if ($subCategoryId) {
                $query->whereHas('professional', function ($q) use ($subCategoryId) {
                    $q->where('sub_category_id', $subCategoryId);
                });
            }
            if ($location) {
                $query->whereHas('professional', function ($q) use ($location) {
                    $q->where('location', $location);
                });
            }

            $professionals = $query->latest()->get();
            $categories = ProfessionalCategory::where('status', 'active')->orderBy('name')->get();
            $subCategories = ProfessionalSubCategory::where('status', 'active')->orderBy('name')->get();
            $professionalLocations = Professional::whereNotNull('location')->distinct()->pluck('location');

            // If the request is AJAX, return the partial view only.
            if ($request->ajax()) {
                return view('frontend.pages.professional-list', compact('professionals'))->render();
            }

            return view('frontend.pages.professional', compact(
                'professionals',
                'categories',
                'subCategories',
                'professionalLocations'
            ));
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }

    public function professionalDetail($slug)
    {
        try {
            // Get the professional (user) by slug
            $professional = User::where('slug', $slug)
                ->where('status', 'active')
                ->first();
            if (!$professional) {
                return redirect()->route('frontend.home')->with('error', 'Professional not found!');
            }

            // Get available schedule slots for this professional (only future dates)
            $availableSchedules = ProfessionalSchedule::where('user_id', $professional->id)
                ->where('status', 'available')
                ->where('date', '>=', now()->toDateString())
                ->orderBy('date')
                ->orderBy('start_time')
                ->get();

            return view('frontend.pages.professional-detail', compact('professional', 'availableSchedules'));
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }


    /**
     * get sub category when category is choosen
     */
    public function getSubcategories($categoryId)
    {
        $subcategories = ProfessionalSubCategory::where('professional_categories_id', $categoryId)->get();
        return response()->json($subcategories);
    }


    public function bookAppointment(Request $request)
    {
        $validatedData = $request->validate([
            'professional_id'    => 'required|exists:users,id',
            'schedule_id'        => 'required|exists:professional_schedules,id',
            'visit_reason' => 'nullable|string|max:500',
            'first_name'=>'required|max:255',
            'last_name'=>'required|max:255',
            'phone_number'=>'required|max:255',
            'email_address'=>'required|max:255',
        ]);
        if(!auth()->user()){
            return back()->with('error','Please login to take appoinment!');
        }

        // Confirm that the selected schedule slot is still available
        $schedule = ProfessionalSchedule::where('id', $validatedData['schedule_id'])
            ->where('status', 'available')
            ->first();

        if (!$schedule) {
            return back()->with('error', 'Selected appointment slot is no longer available.');
        }

        // Mark the schedule as booked
        $schedule->update(['status' => 'booked']);

        // Optionally, create an Appointment record (ensure you have an Appointment model & migration)
        Appoinment::create([
            'professional_id'   => $validatedData['professional_id'],
            'user_id'           => auth()->id(), // Assuming the user is logged in
            'schedule_id'       => $schedule->id,
            'visit_reason'=>$request['visit_reason']??null,
            'first_name'=>$request['first_name'],
            'last_name'=>$request['last_name'],
            'phone_number'=>$request['phone_number'],
            'email_address'=>$request['email_address'],
        ]);

        return redirect()->back()->with('success', 'Your appointment has been booked successfully.');
    }
}
