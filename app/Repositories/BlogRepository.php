<?php

namespace App\Repositories;

use App\Models\Blog;
use App\Repositories\Interfaces\BlogRepositoryInterface;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

class BlogRepository implements BlogRepositoryInterface
{
    /**
     * Store Blog
     */
    public function store($request)
    {
        // Handle file upload for the image
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = uniqid() . '.webp'; // Convert to WebP
            $path = 'public/blog/' . $filename; // Storage path

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
        }

        // Create the blog record
        Blog::create([
            'title' => $request['title'],
            'image' => $imagePath,
            'description' => $request['description'],
            'status' => $request['status']
        ]);
        return;
    }

    /**
     * update Blog
     */
    public function update($request, $blog)
    {
        // Handle file upload for the blog
        if ($request->hasFile('image')) {
            // Delete the old blog image if it exists
            if ($blog->image && Storage::exists(str_replace('storage/', 'public/', $blog->image))) {
                Storage::delete(str_replace('storage/', 'public/', $blog->image));
            }

            // Process and compress the new image
            $image = $request->file('image');
            $filename = uniqid() . '.webp'; // Convert to WebP
            $path = 'public/blog/' . $filename; // Storage path

            // Resize and compress the image
            $img = Image::make($image)
                ->resize(800, null, function ($constraint) {
                    $constraint->aspectRatio(); // Maintain aspect ratio
                    $constraint->upsize(); // Prevent upscaling
                })
                ->encode('webp', 80); // Convert to WebP with 80% quality

            // Save the processed image to storage
            Storage::put($path, $img);

            // Adjust path for database storage
            $blogPath = str_replace('public/', 'storage/', $path);
        } else {
            // Keep the old blog image if no new one is uploaded
            $blogPath = $blog->image;
        }

        // Update the blog record
        $blog->update([
            'title' => $request['title'],
            'image' => $blogPath,
            'description' => $request['description'],
            'status' => $request['status']
        ]);
        return;
    }
     /**
     * destroy Blog
     */
    public function destroy($blog){
          // Ensure the path is relative to the 'public' disk
          $relativeBlogPath = str_replace('storage/', 'public/', $blog->image);

          // Delete the blog file if it exists
          if ($blog->image && Storage::exists($relativeBlogPath)) {
              Storage::delete($relativeBlogPath);
          }

          $blog->delete();
          return;
    }
}
