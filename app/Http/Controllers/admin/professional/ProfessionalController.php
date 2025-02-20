<?php

namespace App\Http\Controllers\admin\professional;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProfessionalRequest;
use App\Models\Professional;
use App\Models\ProfessionalCategory;
use App\Models\ProfessionalSubCategory;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

class ProfessionalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $professionals = User::role('Professional')
                ->with(['professional.category', 'professional.subCategory'])  // Eager load relationships
                ->get();

            return DataTables::of($professionals)
                ->addIndexColumn()
                ->addColumn('phone_number', function ($professional) {
                    return optional($professional->professional)->phone_number ?? 'N/A';
                })
                ->addColumn('experience_years', function ($professional) {
                    return optional($professional->professional)->experience_years ?? 'N/A';
                })
                ->addColumn('location', function ($professional) {
                    return optional($professional->professional)->location ?? 'N/A';
                })
                ->addColumn('rating', function ($professional) {
                    return optional($professional->professional)->rating ?? 'N/A';
                })
                ->editColumn('profile_image', function ($professional) {
                    return '<img src="' . asset($professional->professional->profile_image) . '" alt="Professional Image" loading="lazy" height="30" class="professional-image" style="cursor:pointer;" data-url="' . asset($professional->professional->profile_image) . '">';
                })
                ->addColumn('category', function ($professional) {
                    return $professional->professional->category ? $professional->professional->category->name : 'N/A';
                })
                ->addColumn('sub_category', function ($professional) {
                    return $professional->professional->subCategory ? $professional->professional->subCategory->name : 'N/A';
                })
                ->editColumn('status', function ($professional) {
                    return $professional->status === 'active'
                        ? '<span class="badge badge-success">Active</span>'
                        : '<span class="badge badge-danger">Inactive</span>';
                })
                ->addColumn('action', function ($professional) {
                    return '
                        <a href="' . route('professional.edit', $professional->slug) . '" 
                            class="btn btn-warning btn-sm text-white" title="Edit">
                            <i class="fa-solid fa-pencil"></i>
                        </a>
                        <a href="' . route('professional.show', $professional->slug) . '" 
                            class="btn btn-info btn-sm text-white" title="View Professional">
                            <i class="fa-regular fa-eye"></i>
                        </a>
                        <button class="btn btn-dark btn-sm toggle-status-btn" 
                            data-slug="' . $professional->slug . '" data-status="' . $professional->status . '" 
                            title="Change Status">
                            <i class="fa-solid fa-toggle-on"></i>
                        </button>
                        <button class="btn btn-danger btn-sm delete-btn" data-slug="' . $professional->slug . '" title="Delete Professional">
                            <i class="fa-solid fa-trash"></i>
                        </button>
                    ';
                })
                ->rawColumns(['profile_image', 'status', 'action'])
                ->make(true);
        }

        return view('backend.professional.professional.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        try {
            $categories = ProfessionalCategory::where('status', 'active')->orderBy('name', 'asc')->get();
            $subcategories = ProfessionalSubCategory::where('status', 'active')->orderBy('name', 'asc')->get();
            return view('backend.professional.professional.create', compact('categories', 'subcategories'));
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(ProfessionalRequest $request)
    {
        DB::beginTransaction(); // Start the transaction

        try {
            $imagePath = null;

            // Handle image upload if exists
            if ($request->hasFile('profile_image')) {
                $image = $request->file('profile_image');
                $filename = uniqid() . '.webp'; // Convert image to webp format
                $path = 'public/profile_image/' . $filename; // Storage path

                // Resize while maintaining aspect ratio & compress
                $img = Image::make($image)
                    ->resize(800, null, function ($constraint) {
                        $constraint->aspectRatio(); // Maintain aspect ratio
                        $constraint->upsize(); // Prevent enlargement
                    })
                    ->encode('webp', 80); // Convert to WebP with 80% quality

                // Save to storage
                Storage::put($path, $img);

                // Adjust path for database storage
                $imagePath = str_replace('public/', 'storage/', $path);
            }

            // Create user
            $user = User::create([
                'name' => $request['name'],
                'email' => $request['email'],
                'password' => Hash::make($request['password']),
                'status' => $request['status'] ?? 'active', // Default active
            ]);

            // Create professional record
            Professional::create([
                'user_id' => $user->id,
                'category_id' => $request['category_id'],
                'sub_category_id' => $request['sub_category_id'],
                'phone_number' => $request['phone_number'],
                'bio' => $request['bio'] ?? null,
                'experience_years' => $request['experience_years'] ?? 0, // Default 0
                'location' => $request['location'],
                'rating' => $request['rating'] ?? 0.0, // Default 0.0
                'profile_image' => $imagePath
            ]);

            // assign role
            $user->assignRole('professional');

            DB::commit(); // Commit the transaction if all operations succeed

            return redirect()->route('professional.index')->with('success', 'Professional has been created successfully!');
        } catch (\Throwable $th) {
            DB::rollback(); // Rollback if any operation fails
            return back()->with('error', 'Something went wrong! ' . $th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $slug)
    {
        try {
            $professional = User::where('slug', $slug)->first();
            if (!$professional) {
                return back()->with('error', 'Professional not found!');
            }
            return view('backend.professional.professional.show', compact('professional'));
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($slug)
    {
        try {
            $professional = User::where('slug', $slug)->first();
            if (!$professional) {
                return back()->with('error', 'Professional not found!');
            }
            $categories = ProfessionalCategory::where('status', 'active')->orderBy('name', 'asc')->get();
            $subcategories = ProfessionalSubCategory::where('status', 'active')->orderBy('name', 'asc')->get();
            return view('backend.professional.professional.edit', compact('professional', 'categories', 'subcategories'));
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProfessionalRequest $request, $slug)
    {
        try {
            $professional = User::where('slug', $slug)->first();
            if (!$professional) {
                return back()->with('error', 'Professional not found!');
            }
            // Store profile image if updated
            if ($request->hasFile('profile_image')) {
                // Delete old profile image if it exists
                if ($professional->professional->profile_image && Storage::exists('public/' . str_replace('storage/', '', $professional->professional->profile_image))) {
                    Storage::delete('public/' . str_replace('storage/', '', $professional->professional->profile_image));
                }

                $image = $request->file('profile_image');
                $filename = uniqid() . '.webp'; // Convert to WebP
                $path = 'public/profile_image/' . $filename; // Storage path

                // Process and compress the image
                $img = Image::make($image)
                    ->resize(800, null, function ($constraint) {
                        $constraint->aspectRatio(); // Maintain aspect ratio
                        $constraint->upsize(); // Prevent upscaling
                    })
                    ->encode('webp', 80); // Convert to WebP with 80% quality

                // Save the processed image to storage
                Storage::put($path, $img);

                // Adjust path for database storage
                $imagePath = str_replace('public/', 'storage/', $path);
            } else {
                // If no new profile image, keep the old one
                $imagePath = $professional->professional->profile_image;
            }

            // Update the professional record
            $professional->update([
                'name' => $request['name'],
                'email' => $request['email'],
                'password' => Hash::make($request['password']),
                'status' => $request['status'] ?? 'active', // Default active
            ]);
            $professional->professional->update([
                'user_id' => $professional->id,
                'category_id' => $request['category_id'],
                'sub_category_id' => $request['sub_category_id'],
                'phone_number' => $request['phone_number'],
                'bio' => $request['bio'] ?? null,
                'experience_years' => $request['experience_years'] ?? 0, // Default 0
                'location' => $request['location'],
                'rating' => $request['rating'] ?? 0.0, // Default 0.0
                'profile_image' => $imagePath
            ]);
            return redirect()->route('professional.index')->with('success', 'Professional has been updated successfully!');
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($slug)
    {
        try {
            $professional = User::where('slug', $slug)->first();

            if (!$professional) {
                return response()->json(['status' => 'error', 'message' => 'Professional not found']);
            }

            // Check if category is associated with any products
            // if ($color->products()->exists()) {
            //     return response()->json([
            //         'status' => 'error',
            //         'message' => 'Cannot delete color. It is associated with products.'
            //     ]);
            // }

            // Ensure the path is relative to the 'public' disk
            $imagePath = str_replace('storage/', 'public/', $professional->professional->profile_image);

            // Delete the profile image file if it exists
            if ($professional->professional->profile_image && Storage::exists($imagePath)) {
                Storage::delete($imagePath);
            }

            $professional->delete();

            return response()->json(['status' => 'success', 'message' => 'Professional deleted successfully']);
        } catch (\Throwable $th) {
            return response()->json(['status' => 'error', 'message' => $th->getMessage()]);
        }
    }

    /**
     * toggle status
     */
    public function toggleStatus(Request $request, $slug)
    {
        try {
            $professional = User::where('slug', $slug)->firstOrFail();
            $professional->status = $request->status;
            $professional->save();

            return response()->json(['message' => 'Status updated successfully.']);
        } catch (\Throwable $th) {
            return response()->json(['status' => 'error', 'message' => $th->getMessage()]);
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
}
