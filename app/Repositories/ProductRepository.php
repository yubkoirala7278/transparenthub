<?php

namespace App\Repositories;

use App\Models\Product;
use App\Models\ProductBrand;
use App\Models\ProductCategory;
use App\Models\ProductImage;
use App\Repositories\Interfaces\ProductRepositoryInterface;
use Illuminate\Support\Facades\DB;
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

    /**
     * store product
     */
    public function storeProduct($request)
    {
        // Begin a database transaction
        DB::beginTransaction();

        try {
            // Store feature image
            $imagePath = null;
            if ($request->hasFile('feature_image')) {
                $imagePath = $this->storeImage($request->file('feature_image'), 'product_feature_image');
            }

            // Create the product record
            $product = Product::create([
                'name' => $request->name,
                'description' => $request->description,
                'shipping_returns' => $request->shipping_returns ? $request->shipping_returns : null,
                'price' => $request->price,
                'compare_price' => $request->compare_price ?? null,
                'sku' => $request->sku,
                'track_qty' => $request->track_qty == '1' ? true : false,
                'qty' => $request->qty,
                'status' => $request->status,
                'is_featured' => $request->is_featured,
                'category_id' => $request->category_id,
                'sub_category_id' => $request->sub_category_id ?? null,
                'brand_id' => $request->brand_id ?? null,
                'feature_image' => $imagePath,
                'shipping_charge_inside_valley'=>$request->shipping_charge_inside_valley??0,
                'shipping_charge_outside_valley'=>$request->shipping_charge_outside_valley??0
            ]);

            // Attach selected colors to the pivot table
            if ($request->has('color_id')) {
                $product->colors()->sync($request->color_id);
            }
            // Attach selected sizes to the pivot table
            if ($request->has('size_id')) {
                $product->sizes()->sync($request->size_id);
            }

            // Store product gallery images
            if ($request->hasFile('gallery') && is_array($request->file('gallery'))) {
                foreach ($request->file('gallery') as $image) {
                    $galleryPath = $this->storeImage($image, 'product_gallery');

                    // Create a new record for each gallery image
                    ProductImage::create([
                        'product_id' => $product->id,
                        'image' => $galleryPath,
                    ]);
                }
            }

            // Commit the transaction
            DB::commit();

            // Return true
            return true;
        } catch (\Exception $e) {
            // Rollback the transaction if an exception occurs
            DB::rollBack();
            // You can return a specific message or rethrow the error
            throw new \Exception("Error occurred while saving the product: " . $e->getMessage());
        }
    }

    // Helper method to store images
    private function storeImage($image, $folder)
    {
        $filename = uniqid() . '.webp'; // Change extension to webp
        $path = 'public/' . $folder . '/' . $filename; // Storage path

        // Resize while maintaining aspect ratio & compress
        $img = Image::make($image)
            ->resize(800, null, function ($constraint) {
                $constraint->aspectRatio(); // Maintain aspect ratio
                $constraint->upsize(); // Prevent enlargement
            })
            ->encode('webp', 80); // Convert to WebP with 80% quality

        // Save to storage
        Storage::put($path, $img);

        // Return adjusted path for database storage
        return str_replace('public/', 'storage/', $path);
    }
    /**
     * update product
     */
    public function updateProduct($request, $product)
    {
        // Begin a database transaction
        DB::beginTransaction();

        try {
            // Store feature image if updated
            if ($request->hasFile('feature_image')) {
                // Delete old feature image if it exists
                if ($product->feature_image && Storage::exists('public/' . str_replace('storage/', '', $product->feature_image))) {
                    Storage::delete('public/' . str_replace('storage/', '', $product->feature_image));
                }

                // Store the new feature image
                $imagePath = $this->storeImage($request->file('feature_image'), 'product_feature_image');
            } else {
                // If no new feature image, keep the old one
                $imagePath = $product->feature_image;
            }

            // Update the product record
            $product->update([
                'name' => $request->name,
                'description' => $request->description,
                'shipping_returns' => $request->shipping_returns ? $request->shipping_returns : null,
                'price' => $request->price,
                'compare_price' => $request->compare_price ?? null,
                'sku' => $request->sku,
                'track_qty' => $request->track_qty == '1' ? true : false,
                'qty' => $request->qty,
                'status' => $request->status,
                'is_featured' => $request->is_featured,
                'category_id' => $request->category_id,
                'sub_category_id' => $request->sub_category_id ?? null,
                'brand_id' => $request->brand_id ?? null,
                'feature_image' => $imagePath,
                'shipping_charge_inside_valley'=>$request->shipping_charge_inside_valley??0,
                'shipping_charge_outside_valley'=>$request->shipping_charge_outside_valley??0
            ]);

            // Attach or sync selected colors to the pivot table
            if ($request->has('color_id')) {
                $product->colors()->sync($request->color_id);
            }
             // Attach or sync selected sizes to the pivot table
             if ($request->has('size_id')) {
                $product->sizes()->sync($request->size_id);
            }

            // Update product gallery images if any are uploaded
            if ($request->hasFile('gallery') && is_array($request->file('gallery'))) {
                // Delete old gallery images if necessary
                foreach ($product->images as $image) {
                    if (Storage::exists('public/' . str_replace('storage/', '', $image->image))) {
                        Storage::delete('public/' . str_replace('storage/', '', $image->image));
                    }
                    $image->delete();
                }

                // Store new gallery images
                foreach ($request->file('gallery') as $image) {
                    $galleryPath = $this->storeImage($image, 'product_gallery');

                    // Create a new record for each gallery image
                    ProductImage::create([
                        'product_id' => $product->id,
                        'image' => $galleryPath,
                    ]);
                }
            }

            // Commit the transaction
            DB::commit();

            // Return true
            return true;
        } catch (\Exception $e) {
            // Rollback the transaction if an exception occurs
            DB::rollBack();
            // You can return a specific message or rethrow the error
            throw new \Exception("Error occurred while updating the product: " . $e->getMessage());
        }
    }

    /**
     * destroy product
     */
    public function destroyProduct($product)
    {
        DB::beginTransaction(); // Start transaction

        try {
            // Delete Feature Image if it exists
            if ($product->feature_image) {
                Storage::delete($product->feature_image);
            }

            // Delete all Gallery Images
            foreach ($product->images as $image) {
                Storage::delete($image->image);
                $image->delete(); // Remove record from database
            }

            // Detach Colors (if Many-to-Many relationship exists)
            $product->colors()->detach();
             // Detach Sizes (if Many-to-Many relationship exists)
             $product->sizes()->detach();

            // Delete the product
            $product->delete();

            DB::commit(); // Commit transaction

            return true; // Indicate successful deletion
        } catch (\Exception $e) {
            DB::rollBack(); // Rollback in case of error
            throw new \Exception("Error occurred while deleting the product: " . $e->getMessage());
        }
    }
}
