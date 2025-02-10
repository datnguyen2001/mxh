<?php

namespace App\Http\Controllers;

use App\Repositories\TopicRepository;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;


class TopicController extends BaseController
{
    protected $topicRepository;

    public function __construct(TopicRepository $topicRepository)
    {
        $this->topicRepository = $topicRepository;
    }

    //not pagination
    public function index(Request $request)
    {
        $data = $this->topicRepository->index($request);
        if ($data instanceof RedirectResponse) {
            return $data;
        }
        return view('topic.index', $data);
    }

    //is pagination
    public function index2(Request $request)
    {
        $data = $this->topicRepository->index2($request);
        if ($data instanceof RedirectResponse) {
            return $data;
        }
        return view('topic.index', $data);
    }


    public function loadMorePaging(Request $request)
    {
        $listNews = $this->topicRepository->loadMorePaging($request);
        if (!empty($listNews)) {
            return view('components.template.box-item', compact('listNews'));
        }
        return '';
    }

}
