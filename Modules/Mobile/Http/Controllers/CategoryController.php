<?php

namespace Modules\Mobile\Http\Controllers;

use App\Repositories\CategoryRepository;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

class CategoryController extends BaseController
{

    protected $categoryRepository;

    public function __construct(CategoryRepository $categoryRepository) {
        $this->categoryRepository = $categoryRepository;
    }

    public function index(Request $request)
    {
        $options = [
            'imgW' => 642,
            'imgH' => 401,
            'sImgW' => 230,
            'sImgH' => 144,
        ];
        $data = $this->categoryRepository->index($request, $options, true);
        return view('mobile::category.index', $data);
    }

    public function loadMorePaging(Request $request)
    {
        $options = [
            'imgW' => 230,
            'imgH' => 144,
        ];
        $listNews = $this->categoryRepository->loadMorePaging($request, $options);
        if (!empty($listNews)) {
            return view('components.template.item-cate', compact('listNews'));
        }  return null;
    }

    public function loadCateSidebar(Request $request)
    {
        $options = [
            'imgW' => 230,
            'imgH' => 144,
            'length' => 4,
            'stopFocus' => 3,
            'stopInZone' => 3,
        ];
        $data = $this->categoryRepository->loadCateSidebar($request, $options);

        return view('mobile::components.category.box-bottom', $data);
    }

}
