<?php

namespace App\Http\Controllers;


use App\Helpers\ElasticsearchHelpers;
use App\Helpers\FormatHelpers;
use App\Helpers\LoggerHelpers;
use App\Helpers\UserInterfaceHelper;
use App\Repositories\NewsRepository;
use App\Repositories\RedisPipeLineRepository;
use App\Repositories\ZoneRepository;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Str;


class TagsController extends BaseController
{
    protected $zone;
    protected $redisPipeLine;
    protected $news;
    const  pageSize = 15, imgW = 235, imgH = 147;

    public function __construct(NewsRepository $news, ZoneRepository $zone, RedisPipeLineRepository $redisPipeLine)
    {
        $this->news = $news;
        $this->zone = $zone;
        $this->redisPipeLine = $redisPipeLine;
    }
    public function index(Request $request)
    {
        $shortURL = $request->tag;
        $page = $request->pageIndex ? (int)$request->pageIndex : 1;

        // Retrieve tag data from Redis
        $arrKey = [
            'tag' => [
                'cmd' => 'get',
                'key' => sprintf(config('keyredis.KeyTagUrl'), $shortURL ?? ''),
            ],
        ];
        $pipeLineData = $this->redisPipeLine->getDataByPipeLine($arrKey);
        $tagInfo = $this->news->parseTagInfo($pipeLineData['tag'] ?? null);

        // Retrieve and format news list
        $listNewsData = ElasticsearchHelpers::SearchByTag($shortURL, $page, self::pageSize, 0);
        $total = $listNewsData['total']->value ?? 0;
        $listNews = $this->news->formatNewsDefault($listNewsData['data'] ?? [], self::imgW, self::imgH);

        // Handle missing tag info
        if (!$tagInfo && !empty($listNews[0]->TagItem)) {
            $tagInfo = $this->news->fetchTagInfoBySlug($listNews[0]->TagItem, $shortURL);
        }

        // Generate client script and prepare data
        $ZoneInfoClientScript = sprintf(
            '<input type="hidden" name="hdCatUrl" id="hdCatUrl" value="%s" />
         <input type="hidden" name="hdPageIndex" id="hdPageIndex" value="%s" />',
            $shortURL, $page
        );

        // Check if data exists, otherwise abort
        if (empty($tagInfo) && empty($listNews)) {
            return abort(404);
        }

        // Prepare view data
        $data = [
            'tagInfo' => $tagInfo ?? '',
            'shortURL' => ucfirst($shortURL ?? ''),
            'total' => $total,
            'pagination' => $pagination ?? '',
            'listNews' => $listNews,
            'ZoneInfoClientScript' => $ZoneInfoClientScript,
        ];

        return view('tags.index', $data);
    }

    // Load more pagination for news list
    public function loadMorePaging(Request $request)
    {
        $currentPage = (int)$request->pageIndex;
        $keywords = $request->keywords;

        // Retrieve and format paginated news list
        $responseData = ElasticsearchHelpers::SearchByTag($keywords, $currentPage, self::pageSize, 0);
        if (empty($responseData['data'])) {
            return null;
        }

        $listNews = $this->news->formatNewsDefault($responseData['data'], self::imgW, self::imgH);
        return view('components.template.item-cate', ['listNews' => $listNews]);
    }
}
