<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Repositories\Interfaces\NewsRepositoryInterface;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    private $newsRepository;

    public function __construct(NewsRepositoryInterface $newsRepository) {
        $this->newsRepository = $newsRepository;
    }
    public function index(){
        $data = $this->newsRepository->all();
        return view('frontend.pages.index');
    }
}
