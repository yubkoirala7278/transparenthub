<?php
namespace App\Repositories\Interfaces;

Interface BlogRepositoryInterface{
    public function store($request);
    public function update($request,$blog);
    public function destroy($blog);
}