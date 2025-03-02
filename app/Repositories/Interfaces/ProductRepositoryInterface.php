<?php
namespace App\Repositories\Interfaces;

Interface ProductRepositoryInterface{
    // category
    public function storeProductCategory($request);
    public function updateProductCategory($request,$category);
    public function destroyProductCategory($category);
    // brand
    public function storeProductBrand($request);
    public function updateProductBrand($request, $brand);
    public function destroyProductBrand($brand);
    // product
    public function storeProduct($request);
    public function updateProduct($request,$product);
    public function destroyProduct($product);
}