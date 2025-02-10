<?php

namespace App\Http\Controllers;

use App\Repositories\NewsRepository;
use App\Repositories\RedisPipeLineRepository;
use App\Repositories\ZoneRepository;
use Illuminate\Http\Request;

class VoteController extends Controller
{
    public function __construct(NewsRepository $news, ZoneRepository $zone, RedisPipeLineRepository $redisPipeLine)
    {
        $this->news = $news;
        $this->zone = $zone;
        $this->redisPipeLine = $redisPipeLine;
    }

    public function getVoteInfo(Request $request){
        $id =  $request->Id;
        $listKey['voteInfo'] = [
            'cmd' => 'get',
            'key' => sprintf(config('keyredis.KeyBoxVote'), $id ?? ''),
        ];
        $pipeLineData = $this->redisPipeLine->getDataByPipeLine($listKey);
        $voteInfo = $pipeLineData['voteInfo'] ?? [];

        if (!empty($voteInfo)){
            $voteInfo = json_decode($voteInfo);
            return response()->json($voteInfo)->header('Content-Type', 'application/json;charset=UTF-8');
        }
        return null;
    }
}
