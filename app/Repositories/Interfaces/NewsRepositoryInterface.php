<?php
namespace App\Repositories\Interfaces;

Interface NewsRepositoryInterface{
    public function storeNews($request);
    public function updateNews($request,$news);
    public function destroyNews($news);
}