<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $rules = [
            'name' => 'required|string|max:255',
            'description'       => 'required|string',
            'shipping_returns'  => 'nullable|string',


            'price'             => 'required|numeric|min:0',
            'compare_price'     => 'nullable|numeric|gte:price', // Must be greater than or equal to price
            'sku'               => 'required|string|max:50|unique:products,sku,' . $this->product . ',slug',

            'track_qty'         => 'required|boolean',
            'qty'               => 'nullable|integer|min:0|required_if:track_qty,true',

            'status'            => 'required|in:active,inactive',
            'is_featured'       => 'required|in:Yes,No',

            'category_id'       => 'required|exists:product_categories,id',
            'sub_category_id'   => 'nullable|exists:product_sub_categories,id',
            'brand_id'          => 'nullable|exists:product_brands,id',
            'color_id' => 'nullable|array', // Ensure it's an array
            'color_id.*' => 'exists:product_colors,id', // Validate each color ID
            'size_id' => 'nullable|array', // Ensure it's an array
            'size_id.*' => 'exists:product_sizes,id', // Validate each size ID
            'shipping_charge_inside_valley'=>'nullable|min:0',
            'shipping_charge_outside_valley'=>'nullable|min:0'
        ];

        // Handle feature_image validation based on the request method
        if ($this->isMethod('post')) {
            $rules['feature_image'] = 'required|image|mimes:webp,jpeg,png,jpg,gif,svg|max:2048';
            $rules['gallery'] = 'required|array|min:1'; // Gallery is required when creating
            $rules['gallery.*'] = 'image|mimes:webp,jpeg,png,jpg,gif,svg|max:2048'; // Each image validation
        } elseif ($this->isMethod('put') || $this->isMethod('patch')) {
            $rules['feature_image'] = 'nullable|image|mimes:webp,jpeg,png,jpg,gif,svg|max:2048';

            // Allow gallery to be optional, but enforce image rules if provided
            $rules['gallery'] = 'nullable|array'; // No min:1 here, as it's optional
            $rules['gallery.*'] = 'nullable|image|mimes:webp,jpeg,png,jpg,gif,svg|max:2048'; // Each image validation
        }



        return $rules;
    }

    public function messages(): array
    {
        return [
            'name.required'             => 'Product name is required.',
            'name.unique'               => 'This product name already exists.',
            'slug.unique'               => 'This slug is already taken.',
            'description.required'      => 'Product description is required.',

            'gallery.required'          => 'At least one product image is required.',
            'gallery.*.image'           => 'Each gallery item must be a valid image.',
            'gallery.*.mimes'           => 'Only webp, jpeg, png, jpg, gif, and svg formats are allowed.',

            'price.required'            => 'Product price is required.',
            'price.numeric'             => 'Price must be a valid number.',
            'compare_price.numeric'     => 'Compare price must be a valid number.',
            'compare_price.gte'         => 'Compare price must be greater than or equal to the price.',

            'sku.required'              => 'SKU is required.',
            'sku.unique'                => 'This SKU is already in use.',

            'track_qty.required'        => 'Specify if you want to track product quantity.',
            'qty.required_if'           => 'Quantity is required when stock tracking is enabled.',
            'qty.integer'               => 'Quantity must be a valid number.',
            'qty.min'                   => 'Quantity cannot be negative.',

            'status.required'           => 'Product status is required.',
            'status.in'                 => 'Status must be either active or inactive.',

            'is_featured.required'      => 'Please specify if this product is featured.',
            'is_featured.in'            => 'Featured status must be either Yes or No.',

            'category_id.required'      => 'A product category is required.',
            'category_id.exists'        => 'Selected category does not exist.',
            'sub_category_id.exists'    => 'Selected subcategory does not exist.',
            'brand_id.exists'           => 'Selected brand does not exist.',
            'color_id.exists'           => 'Selected color does not exist.',

            'feature_image.required'    => 'Feature image is required.',
            'feature_image.image'       => 'Feature image must be a valid image file.',
            'feature_image.mimes'       => 'Allowed image formats are webp, jpeg, png, jpg, gif, svg.',
        ];
    }
}
