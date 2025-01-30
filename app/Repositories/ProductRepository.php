<?php

namespace App\Repositories;

use App\Models\ProductBrand;
use App\Models\ProductCategory;
use App\Repositories\Interfaces\ProductRepositoryInterface;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

class ProductRepository implements ProductRepositoryInterface
{
    /**
     * store product category
     */
    public function storeProductCategory($request)
    {
        $imagePath = null;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = uniqid() . '.webp'; // Change extension to webp
            $path = 'public/product_category/' . $filename; // Storage path

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

        // Create the category record
        ProductCategory::create([
            'name' => $request->name,
            'status' => $request->status,
            'image' => $imagePath
        ]);
        return;
    }

    /**
     * update product category
     */
    public function updateProductCategory($request, $category)
    {
        // Handle file upload for the category image
        if ($request->hasFile('image')) {
            // Delete the old category image if it exists
            if ($category->image && Storage::exists(str_replace('storage/', 'public/', $category->image))) {
                Storage::delete(str_replace('storage/', 'public/', $category->image));
            }

            $image = $request->file('image');
            $filename = uniqid() . '.webp'; // Convert to WebP
            $path = 'public/product_category/' . $filename; // Storage path

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
            $categoryPath = str_replace('public/', 'storage/', $path);
        } else {
            // Keep the old category image if no new one is uploaded
            $categoryPath = $category->image;
        }

        // Update the category record
        $category->update([
            'name' => $request['name'],
            'image' => $categoryPath,
            'status' => $request['status']
        ]);
        return;
    }

    /**
     * destroy product category
     */
    public function destroyProductCategory($category)
    {
        // Ensure the path is relative to the 'public' disk
        $relativeCategoryPath = str_replace('storage/', 'public/', $category->image);

        // Delete the category file if it exists
        if ($category->image && Storage::exists($relativeCategoryPath)) {
            Storage::delete($relativeCategoryPath);
        }

        $category->delete();
        return;
    }


    /**
     * store product brand
     */
    public function storeProductBrand($request)
    {
        $imagePath = null;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = uniqid() . '.webp'; // Change extension to webp
            $path = 'public/product_brand/' . $filename; // Storage path

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

        // Create the brand record
        ProductBrand::create([
            'name' => $request->name,
            'status' => $request->status,
            'image' => $imagePath
        ]);
        return;
    }

    /**
     * update product brand
     */
    public function updateProductBrand($request, $brand)
    {
        // Handle file upload for the brand image
        if ($request->hasFile('image')) {
            // Delete the old brand image if it exists
            if ($brand->image && Storage::exists(str_replace('storage/', 'public/', $brand->image))) {
                Storage::delete(str_replace('storage/', 'public/', $brand->image));
            }

            $image = $request->file('image');
            $filename = uniqid() . '.webp'; // Convert to WebP
            $path = 'public/product_brand/' . $filename; // Storage path

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
            $brandPath = str_replace('public/', 'storage/', $path);
        } else {
            // Keep the old brand image if no new one is uploaded
            $brandPath = $brand->image;
        }

        // Update the brand record
        $brand->update([
            'name' => $request['name'],
            'image' => $brandPath,
            'status' => $request['status']
        ]);
        return;
    }

    /**
     * destroy product brand
     */
    public function destroyProductBrand($brand)
    {
        // Ensure the path is relative to the 'public' disk
        $relativeBrandPath = str_replace('storage/', 'public/', $brand->image);

        // Delete the brand file if it exists
        if ($brand->image && Storage::exists($relativeBrandPath)) {
            Storage::delete($relativeBrandPath);
        }

        $brand->delete();
        return;
    }
}
