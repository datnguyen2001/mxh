<?php

namespace App\Http\Controllers;

use App\Repositories\ThreadRepository;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;


class ThreadController extends BaseController
{
    protected $threadRepository;

    public function __construct(ThreadRepository $threadRepository)
    {
        $this->threadRepository = $threadRepository;
    }

    //not pagination
    public function index(Request $request)
    {
        $data = $this->threadRepository->index($request);
        if ($data instanceof RedirectResponse) {
            return $data;
        }
        return view('thread.index', $data);
    }

    public function loadMorePaging(Request $request)
    {
        $listNews = $this->threadRepository->loadMorePaging($request);
        if (!empty($listNews)) {
            return view('components.template.item-cate', compact('listNews'));
        }
        return '';
    }

}
