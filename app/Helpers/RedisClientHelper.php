<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Redis;
use Exception;
class RedisClientHelper
{
    //Redis key
    public static function mGet($array)
    {
        try {
            $listContentJson = Redis::mGet($array);
            if(!empty($listContentJson)){
                $listContent = array_filter($listContentJson);
            }
            return $listContent??[];
        } catch (Exception $exception) {
            LoggerHelpers::CallApiSetLog('mGet Redis Error', 'RedisEx');
        }
    }

    public static function zRange($key, $start, $stop)
    {
        try {
            return Redis::zRange($key, $start, $stop);
        }catch (Exception $exception){
            LoggerHelpers::CallApiSetLog('zRange'.$key.'Redis Error','RedisEx');
        }
    }//ASC

    public static function zrevrange($key, $start, $stop)
    {
        try {
            return Redis::zrevrange($key, $start, $stop);
        } catch (Exception $exception) {
            LoggerHelpers::CallApiSetLog('zrevrange' . $key . ' Redis Error', 'RedisEx');
        }
    }//DESC

    public static function hGetAll($key)
    {
        try {
            return Redis::hGetAll($key);
        } catch (Exception $exception) {
            LoggerHelpers::CallApiSetLog('hGetAll' . $key . ' Redis Error', 'RedisEx');
        }
    }

    public static function keys($key)
    {
        try {
            return Redis::keys($key);
        } catch (Exception $exception) {
            LoggerHelpers::CallApiSetLog('keys' . $key . ' Redis Error', 'RedisEx');
        }
    }

    public static function hGet($key, $filedName)
    {
        try {
            return Redis::hGet($key, $filedName);
        } catch (Exception $exception) {
            LoggerHelpers::CallApiSetLog('hGet' . $key . ' Redis Error', 'RedisEx');
        }
    }

    public static function get($key)
    {
        try {
            return Redis::get($key);
        } catch (Exception $exception) {
            LoggerHelpers::CallApiSetLog('get' . $key . ' Redis Error', 'RedisEx');
        }
    }

    public static function zCard($key)
    {
        try {
            return Redis::ZCARD($key);
        } catch (Exception $exception) {
            LoggerHelpers::CallApiSetLog('get' . $key . ' Redis Error', 'RedisEx');
        }
    }

    public static function zrevrangeByScore($key,$endDate, $startDate, $start=null ,$lenght=null)
    {
        try {
            if ($start == null && $lenght == null){
                return Redis::zrevrangeByScore($key,$endDate, $startDate);
            }else{
                return Redis::zrevrangeByScore($key,$endDate, $startDate, 'LIMIT', $start ,$lenght);
            }

        } catch (Exception $exception) {
            LoggerHelpers::CallApiSetLog('get' . $key . ' Redis Error', 'RedisEx');
        }
    }

    public static function exists($key)
    {
        try {
            return Redis::EXISTS($key);
        } catch (Exception $exception) {
            LoggerHelpers::CallApiSetLog('zrevrange' . $key . ' Redis Error', 'RedisEx');
        }
    }//exists


    public static function hgetNewsContentInpage($newsId)
    {
        $newsContent=Redis::connection('news_content')->client();
        return $newsContent->hGet(config('keyredis.KeyNewsContentInpage'), $newsId);
    }

    // News content
    public static function hgetNewsContentPage($pageId, $fieldName)
    {
        $newsContent=Redis::connection('news_content')->client();
        return $newsContent->hGet(
            sprintf(config('keyredis.KeyNewsContentPage'), $pageId),
            $fieldName
        );
    }


    public static function getDataByPipeLine($arrayKeys)
    {
        try {
        $dataFromRedis = Redis::pipeline(function ($pipe) use ($arrayKeys) {
            foreach ($arrayKeys as  $value) {
                switch ($value['cmd']) {
                    case 'mGet':
                        $pipe->mGet($value['key']);
                        break;
                    case 'zRange':
                        $pipe->zRange($value['key'], $value['start'], $value['stop']);
                        break;
                    case 'zrevrange':
                        $pipe->zrevrange($value['key'], $value['start'], $value['stop']);
                        break;
                    case 'hGetAll':
                        $pipe->hGetAll($value['key']);
                        break;
                    case 'keys':
                        $pipe->keys($value['key']);
                        break;
                    case 'hGet':
                        $pipe->hGet($value['key'], $value['filedName']);
                        break;
                    case 'get':
                        $pipe->get($value['key']);
                        break;
                    case 'zCard':
                        $pipe->zCard($value['key']);
                        break;
                    case 'zCount':
                        $pipe->zCount($value['key'],$value['startDate'],$value['endDate']);
                        break;
                    case 'zrevrangeByScore':
                        $pipe->zrevrangeByScore($value['key'], $value['endDate'],$value['startDate'], 'LIMIT',  $value['start'],$value['lenght']);
                        break;
                    case 'hScan':
                        $pipe->hScan($value['key'], $value['start'],'COUNT', $value['stop']);
                        break;
                    case 'type':
                        $pipe->type($value['key']);
                        break;
                }
            }
        });
        return $dataFromRedis ?? [];
        } catch (Exception $exception) {
            LoggerHelpers::CallApiSetLog('get pipelineRedis Error:'.$exception->getMessage(), 'RedisEx');
        }
    }

}
