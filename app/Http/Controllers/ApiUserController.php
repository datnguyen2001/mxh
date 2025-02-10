<?php

namespace App\Http\Controllers;

use App\Helpers\LoggerHelpers;
use App\Helpers\MemcachedHelpers;
use App\Helpers\UserInterfaceHelper;

use App\Repositories\NewsRepository;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Validator;
use Exception;

class ApiUserController extends Controller
{
    public function index(Request $request){
        //Quản lí tài khoản theo link json  https://www.getpostman.com/collections/35f2b0936eeeb0ee2892
        $token=filter_var( $request->token,FILTER_SANITIZE_STRING);
        $action=filter_var( $request->m,FILTER_SANITIZE_STRING);
        $pageindex=(int)$request->pageindex;
        $pagesize=(int)$request->pagesize;
        $isimportant=filter_var( $request->isimportant,FILTER_SANITIZE_STRING);
        $userid=filter_var( $request->userid,FILTER_SANITIZE_STRING);
        $passwordOld=filter_var( $request->passwordOld,FILTER_SANITIZE_STRING);
        $passwordNew=filter_var( $request->passwordNew,FILTER_SANITIZE_STRING);
        $passwordComfirm=filter_var( $request->passwordComfirm,FILTER_SANITIZE_STRING);
        $fullName=filter_var( $request->fullName,FILTER_SANITIZE_STRING);
        $avatar=filter_var( $request->avatar,FILTER_SANITIZE_STRING);
        $birthday=filter_var( $request->birth,FILTER_SANITIZE_STRING);
        $sex=filter_var( $request->sex,FILTER_SANITIZE_STRING);
        $address=filter_var( $request->address,FILTER_SANITIZE_STRING);
        $provinceCode=filter_var( $request->provinceCode,FILTER_SANITIZE_STRING);
        $email=filter_var( $request->email,FILTER_SANITIZE_STRING);
        $phone=filter_var( $request->phone,FILTER_SANITIZE_STRING);
        $userTax=filter_var( $request->userTax,FILTER_SANITIZE_STRING);
        $newsId=filter_var( $request->newsid,FILTER_SANITIZE_STRING);
        $title=filter_var( $request->title,FILTER_SANITIZE_STRING);
        $link=filter_var( $request->link,FILTER_SANITIZE_STRING);
        $note=filter_var( $request->note,FILTER_SANITIZE_STRING);
        $actionType=filter_var( $request->actionType,FILTER_SANITIZE_STRING);
        $distributionDate=filter_var( $request->distributionDate,FILTER_SANITIZE_STRING);
        $type=(int)$request->type;
        $sapo=filter_var( $request->sapo,FILTER_SANITIZE_STRING);
        $client = new Client();

        switch ($action){
            case 'userinfo':
                $response =$client->request('GET',
                    url(env('URL_CALL_API_USER').'/ws/user/info'),
                    ['headers' =>['Authorization' => "Bearer ".$token]]
                );
                break;
            case 'provincecode':
                $response =$client->request('GET',
                    url(env('URL_CALL_API_USER').'/ws/user/get-provincecode'),
                    ['headers' =>['Authorization' => "Bearer ".$token]]
                );
                break;
            case 'gethistoryview'://get list lịch sử đọc bài
                if (!empty($type)){
                   $path= env('URL_CALL_API_USER').'/ws/history?pageIndex='.$pageindex.'&type='.$type.'&pageSize='.$pagesize.'';
                }else {
                    $path= env('URL_CALL_API_USER').'/ws/history?pageIndex='.$pageindex.'&pageSize='.$pagesize.'';
                }
                $response =$client->request('GET',
                    url($path),
                    ['headers' =>['Authorization' => "Bearer ".$token],]
                );
                break;
            case 'historyview': //add lịch sử đọc bài
                $request_param = [
                    'newsId' => $newsId,
                    'title' => $title,
                    'link' => $link,
                    'sapo' => $sapo,
                    'avatar' => $avatar,
                    'type' => (int)$type,
                    'distributionDate' =>$distributionDate,
                ];
                $response =$client->request('POST',
                    url(env('URL_CALL_API_USER').'/ws/history/add'),
                    ['headers' =>['Authorization' => "Bearer ".$token],
                        'json'   => $request_param
                    ]
                );
                break;
            case 'userupdatepass':
                $request_param = [
                    'passwordOld' => $passwordOld,
                    'passwordNew' => $passwordNew,
                    'passwordComfirm' => $passwordComfirm,
                ];
                $response =$client->request('PUT',
                    url(env('URL_CALL_API_USER').'/ws/user/'.$userid.'/change-password'),
                    ['headers' =>['Authorization' => "Bearer ".$token],
                        'json'   => $request_param
                    ]
                );
                break;
            case 'userupdate':// update user
                $request_param = [
                    'fullName' => $fullName,
                    'avatar' => $avatar,
                    'birthday' => $birthday,
                    'sex' => $sex,
                    'address' => $address,
                    'provinceCode' => $provinceCode,
                    'email' => $email,
                    'phone' => $phone,
                    'userTax' => $userTax,
                ];
                $response =$client->request('PUT',
                    url(env('URL_CALL_API_USER').'/ws/user/'.$userid),
                    ['headers' =>['Authorization' => "Bearer ".$token],
                        'json'   => $request_param
                    ]
                );
                break;
            case 'historycomment'://add comment
                $request_param = [
                    'newsId' => $newsId,
                    'title' => $title,
                    'url' => $link,
                    'sapo' => $sapo,
                    'avatar' => $avatar,
                    'actionType' =>(int)$actionType,
                    'distributionDate' =>$distributionDate,
                    'type'=>(int)$type,
                ];
                $response =$client->request('POST',
                    url(env('URL_CALL_API_USER').'/ws/interactioncomment/add'),
                    ['headers' =>['Authorization' => "Bearer ".$token],
                        'json'   => $request_param
                    ]
                );
                break;
            case 'gethistorycomment'://get litst comment
                $response =$client->request('GET',
                    url(env('URL_CALL_API_USER').'/ws/interactioncomment?pageIndex='.$pageindex.'&isImportant='.$isimportant.'&pageSize='.$pagesize.''),
                    ['headers' =>['Authorization' => "Bearer ".$token]]
                );
                break;
            case 'interactionread':
                $request_param = [
                    'newsId' => $newsId,
                    'title' => $title,
                    'url' => $link,
                    'sapo' => $sapo,
                    'type' => $type,
                    'avatar' => $avatar,
                    'distributionDate' => $distributionDate,
                    'isImportant' =>$isimportant,
                ];
                $response =$client->request('POST',
                    url(env('URL_CALL_API_USER').'/ws/interactionread/add'),
                    ['headers' =>['Authorization' => "Bearer ".$token],
                        'json'   => $request_param
                    ]
                );
                break;
            case 'getinteractionread':
                if($type==100){
                    $path=env('URL_CALL_API_USER').'/ws/interactionread?pageIndex='.$pageindex.'&isImportant='.$isimportant.'&pageSize='.$pagesize.'';
                }else{
                    $path=env('URL_CALL_API_USER').'/ws/interactionread?pageIndex='.$pageindex.'&isImportant='.$isimportant.'&type='.$type.'&pageSize='.$pagesize.'';
                }
                $response =$client->request('GET',
                    url($path), ['headers' =>['Authorization' => "Bearer ".$token]]
                );
                break;
            case 'checkboomarknewsid':
                $response =$client->request('GET',
                    url(env('URL_CALL_API_USER').'/ws/interactionread/check-bookmark-by-newsid/'.$newsId.''),
                    ['headers' =>['Authorization' => "Bearer ".$token]]
                );
                break;
            case 'removeboomarknewsid':
                $response =$client->request('DELETE',
                    url(env('URL_CALL_API_USER').'/ws/interactionread/remove-bookmark-by-newsid/'.$newsId.''),
                    ['headers' =>['Authorization' => "Bearer ".$token]]
                );
                break;
        }
        if (!empty($response)){
            $response=$response->getBody()->getContents();
        }else{
            $response='';
        }
        return $response;
    }
}
