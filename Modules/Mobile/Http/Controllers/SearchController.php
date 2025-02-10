<?php

namespace Modules\Mobile\Http\Controllers;


use App\Helpers\FormatHelpers;
use App\Helpers\ElasticsearchHelpers;
use App\Helpers\LoggerHelpers;
use App\Helpers\UserInterfaceHelper;
use App\Repositories\NewsRepository;
use App\Repositories\RedisPipeLineRepository;
use App\Repositories\ZoneRepository;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;

class SearchController extends BaseController
{
    const  searchSize = 15,imgW = 230,imgH = 144;
    protected $news;
    protected $zone;
    protected $redisPipeLine;
    public function __construct(NewsRepository $news, ZoneRepository $zone, RedisPipeLineRepository $redisPipeLine)
    {
        $this->news = $news;
        $this->zone= $zone;
        $this->redisPipeLine = $redisPipeLine;
    }

    /**
     * Display a listing of the resource.
     * @param Request $request
     * @return Application|Factory|View
     */
    public function index(Request $request)
    {
        $keywords = filter_var($request->keywords, FILTER_SANITIZE_STRING);
        if (empty($keywords)) {
            return redirect('/', 301);
        }

        $pageIndex = $request->pageIndex ?? 1;

        // Gọi hàm lấy danh sách tin tức
        $searchNews = $this->getListNewsByTitle($keywords, $pageIndex);
        $listNews = $searchNews['data'] ?? [];
        $total = $searchNews['total']->value ?? 0;

        // Định dạng danh sách tin tức
        $listNews = $this->news->formatNewsDefault($listNews, self::imgW, self::imgH);

        $ZoneInfoClientScript = sprintf(
            '<input type="hidden" name="hdKeyword" id="hdKeyword" value="%s" />
         <input type="hidden" name="hdPageIndex" id="hdPageIndex" value="%s" />',
            $keywords, $pageIndex
        );

        $data = [
            'keywords' => $keywords,
            'listNews' => $listNews,
            'total' => $total,
            'ZoneInfoClientScript' => $ZoneInfoClientScript,
        ];

        return view('mobile::search.index', $data);
    }

    public function getListNewsByTitle($keywords, $pageIndex, $searchSize = self::searchSize, $fromDate = null, $toDate = null)
    {
        return ElasticsearchHelpers::SearchByTitle($keywords, $pageIndex, $searchSize, 0, $fromDate, $toDate);
    }

    public function loadMorePaging(Request $request)
    {
        $currentPage = (int) $request->pageIndex;
        $keywords = $request->keywords;

        $searchNews = $this->getListNewsByTitle($keywords, $currentPage);
        $listNews = $searchNews['data'] ?? [];

        if (!empty($listNews)) {
            $listNews = $this->news->formatNewsDefault($listNews, self::imgW, self::imgH);
            return view('mobile::components.template.itemcate', ['listNews' => $listNews]);
        }
        return null;
    }

    public function listPaper(Request $request)
    {
        $type = ($request->path() == "an-pham.htm") ? 2 : 1;
        $pageInfo = (object) [
            'Name' => ($type === 2) ? 'Ấn phẩm' : 'Tạp chí',
            'ShortUrl' => ($type === 2) ? 'an-pham' : 'tap-chi',
            'Url' => ($type === 2) ? '/an-pham.htm' : '/tap-chi.htm',
        ];

        $pipeLineData = $this->redisPipeLine->getDataByPipeLine([
            'listPaper' => [
                'cmd' => 'zrevrange',
                'key' => sprintf(config('keyredis.KeyMagazineType'), $type),
                'start' => 0,
                'stop' => 15,
            ],
        ]);

        $listPaper = $this->news->formatNewsDefault($pipeLineData['listPaper'] ?? [], 174, 271);

        $ZoneInfoClientScript = sprintf(
            '<input type="hidden" name="hdNewsByPaper" id="hdNewsByPaper" value="%s" />',
            $type
        );

        return view('mobile::search.tap-chi-giay', [
            'listPaper' => $listPaper,
            'pageInfo' => $pageInfo,
            'ZoneInfoClientScript' => $ZoneInfoClientScript,
        ]);
    }
    public function loadMorePagingPaper(Request $request)
    {
        $currentPage = (int) $request->pageIndex;
        $type = $request->type;
        $limit = 16;
        $start = ($currentPage - 1) * $limit;
        $stop = $currentPage * $limit - 1;

        $pipeLineData = $this->redisPipeLine->getDataByPipeLine([
            'listPaper' => [
                'cmd' => 'zrevrange',
                'key' => sprintf(config('keyredis.KeyMagazineType'), $type),
                'start' => $start,
                'stop' => $stop,
            ],
        ]);
        $listPaper = $this->news->formatNewsDefault($pipeLineData['listPaper'] ?? [], 174, 271);

        if (!empty($listPaper)) {
            return view('components.template.box-new-paper', ['listPaper' => $listPaper]);
        }

        return null;
    }

}
