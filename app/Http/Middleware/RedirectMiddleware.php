<?php

namespace App\Http\Middleware;

use App\Repositories\NewsRepository;
use App\Repositories\ZoneRepository;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Str;


class RedirectMiddleware
{

    protected $news;
    protected $zone;
    const siteId=0;

    public function __construct(NewsRepository $news, ZoneRepository $zone)
    {
        $this->news = $news;
        $this->zone= $zone;
    }


    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $path=$request->path();
        $searchDetailIsRedirect=preg_match('%/tim-kiem/.*%', $request->getRequestUri(), $regsSearchDetail);
        $newsIsRedirect=preg_match('%([a-zA-Z0-9-_]+(?<!random|chu-de|su-kien|video|tim-kiem|brand|sitemaps|rss)+)/([a-zA-Z0-9-]+/)?(\d*[0-9])+/[a-zA-Z0-9-_]+-(\d*[0-9]{3,})%', $path, $regsnews);//Tin tức


       if ($searchDetailIsRedirect && !empty($request->key)){
            return redirect(config('siteInfo.site_path').'/tim-kiem.htm?keywords='.$request->key,301);
        }
        elseif ($newsIsRedirect){
            $idNewsOld=$regsnews[4];
            $idNews=self::siteId.$idNewsOld;
            if (!empty($idNews)){
                $news=$this->news->getKeyNewsPublish($idNews);
                if(!empty($news)){
                    return redirect(config('siteInfo.site_path').$news->Url, 301);
                }
            }

        }
        return $next($request);
    }
}
