<?php

namespace App\Repositories;

use App\Models\News;
use App\Repositories\Interfaces\NewsRepositoryInterface;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

class NewsRepository implements NewsRepositoryInterface
{
    /**
     * Store news
     */
    public function storeNews($request)
    {
        $imagePath = null; // Initialize imagePath

        // Handle file upload for the image
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = uniqid() . '.webp'; // Convert to WebP
            $path = 'public/news/' . $filename; // Storage path

            // Process and compress the image
            $img = Image::make($image)
                ->resize(800, null, function ($constraint) {
                    $constraint->aspectRatio(); // Maintain aspect ratio
                    $constraint->upsize(); // Prevent upscaling
                })
                ->encode('webp', 80); // Convert to WebP with 80% quality

            // Store the processed image
            Storage::put($path, $img);

            // Adjust path for database storage
            $imagePath = str_replace('public/', 'storage/', $path);
        }

        // Create the news record
        News::create([
            'title' => $request->title,
            'description' => $request->description,
            'image' => $imagePath,
            'status' => $request->status,
            'news_categories_id' => $request->category,
            'news_sources_id' => $request->source ?? null,
            'rss' => $request->rss ?? null,
            'trending_news' => $request->trending_news
        ]);
        return;
    }

    /**
     * update news
     */
    public function updateNews($request, $news)
    {
        // Handle file upload for the news
        if ($request->hasFile('image')) {
            // Delete the old news image if it exists
            if ($news->image && Storage::exists(str_replace('storage/', 'public/', $news->image))) {
                Storage::delete(str_replace('storage/', 'public/', $news->image));
            }

            // Process and compress the new image
            $image = $request->file('image');
            $filename = uniqid() . '.webp'; // Convert to WebP
            $path = 'public/news/' . $filename; // Storage path

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
            $newsPath = str_replace('public/', 'storage/', $path);
        } else {
            // Keep the old news image if no new one is uploaded
            $newsPath = $news->image;
        }

        // Update the news record
        $news->update([
            'title' => $request['title'],
            'description' => $request['description'],
            'image' => $newsPath,
            'status' => $request['status'],
            'news_categories_id' => $request['category'],
            'news_sources_id' => $request['source'] ?? null,
            'rss' => $request['rss'] ?? null,
            'trending_news' => $request['trending_news']
        ]);
        return;
    }

    /**
     * destroy news
     */
    public function destroyNews($news){
        // Ensure the path is relative to the 'public' disk
        $relativeNewsPath = str_replace('storage/', 'public/', $news->image);

        // Delete the news file if it exists
        if ($news->image && Storage::exists($relativeNewsPath)) {
            Storage::delete($relativeNewsPath);
        }

        $news->delete();
    }
}
