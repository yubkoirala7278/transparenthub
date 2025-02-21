<?php

namespace App\Http\Controllers\admin\professional;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $profile = Auth::user();
            return view('backend.professional.profile.index', compact('profile'));
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }

    /**
     * update Profile
     */
    public function update(Request $request)
    {
        try {
            $user = Auth::user();

            // Validate input data
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email,' . $user->id,
                'phone_number' => 'nullable|string|max:20',
                'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'experience_years' => 'nullable|numeric|min:0',
                'location' => 'nullable|string|max:255',
                'bio' => 'nullable|string|max:1000',
            ]);

            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()], 422);
            }

            // Update user details
            $user->update([
                'name' => $request->name,
                'email' => $request->email,
            ]);

            // If user is a professional, update professional details
            if ($user->hasRole('professional')) {

                // Store profile image if updated
                if ($request->hasFile('profile_image')) {
                    // Delete old profile image if it exists
                    if ($user->professional->profile_image && Storage::exists('public/' . str_replace('storage/', '', $user->professional->profile_image))) {
                        Storage::delete('public/' . str_replace('storage/', '', $user->professional->profile_image));
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
                    $imagePath = $user->professional->profile_image;
                }

                // Update other professional fields
                $user->professional->update([
                    'phone_number' => $request->phone_number,
                    'experience_years' => $request->experience_years,
                    'location' => $request->location,
                    'bio' => $request->bio,
                    'profile_image' => $imagePath
                ]);
            }

            return response()->json([
                'status' => 'success',
                'message' => 'Profile updated successfully!',
            ]);
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()], 500);
        }
    }

    /**
     * update Password
     */
    public function updatePassword(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'current_password' => ['required'],
                'password' => ['required', 'confirmed', 'min:8'],
            ], [
                'password.confirmed' => 'The new password and confirmation password must match.',
                'password.min' => 'The new password must be at least 8 characters long.'
            ]);

            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()], 422);
            }

            $user = auth()->user();

            // Check if current password is correct
            if (!Hash::check($request->current_password, $user->password)) {
                return response()->json(['errors' => ['current_password' => ['The current password is incorrect.']]], 422);
            }

            // Update password
            $user->update([
                'password' => Hash::make($request->password)
            ]);

            return response()->json(['message' => 'Password updated successfully!'], 200);
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()], 500);
        }
    }
}
