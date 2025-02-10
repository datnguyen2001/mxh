<?php

namespace App\Http\Controllers;

use App\Repositories\CategoryRepository;
use Illuminate\Http\Request;

class CategoryController extends Controller
{

    protected $categoryRepository;

    public function __construct(CategoryRepository $categoryRepository) {
        $this->categoryRepository = $categoryRepository;
    }

    public function index(Request $request)
    {
        $options = [
            'imgW' => 565,
            'imgH' => 353,
            'sImgW' => 235,
            'sImgH' => 147,
        ];
        $data = $this->categoryRepository->index($request, $options);
        return view('category.index', $data);
    }


    public function index1(Request $request)
    {
        $options = [
            'imgW' => 565,
            'imgH' => 353,
            'sImgW' => 235,
            'sImgH' => 147,
        ];
        $data = $this->categoryRepository->index1($request, $options);
        return view('category.index1', $data);
    }

    //is pagination
    public function index2(Request $request)
    {
        $data = $this->categoryRepository->index2($request);
        return view('category.index2', $data);
    }


    public function loadMorePaging(Request $request)
    {
        $options = [
            'imgW' => 235,
            'imgH' => 147,
        ];
        $listNews = $this->categoryRepository->loadMorePaging($request, $options);
        if (!empty($listNews)) {
            return view('components.template.item-cate', compact('listNews'));
        }
        return null;
    }

    public function loadCateSidebar(Request $request)
    {
        $options = [
            'imgW' => 203,
            'imgH' => 127,
            'length' => 3,
            'stopFocus' => 2,
            'stopInZone' => 2,
        ];
        $data = $this->categoryRepository->loadCateSidebar($request, $options);
        return view('components.category.box-sidebar', $data);
    }

    public function loadTagTrending(Request $request){
        $data = $this->categoryRepository->loadTagTrending($request);
        return view('components.category.box-tag-trending', $data);
    }

}
