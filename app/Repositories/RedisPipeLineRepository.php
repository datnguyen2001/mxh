<?php

namespace App\Repositories;

use App\Helpers\RedisClientHelper;
use Illuminate\Support\Arr;

class RedisPipeLineRepository
{
    /**
     * Get multiple key data from Redis by pipeline
     */
    private function generateKeyByObjectType($item)
    {
        if ($item->ObjectType == 0) {
            return 'newspublish:newsid' . $item->ObjectId;
        } elseif ($item->ObjectType == 2) {
            return sprintf(config('keyredis.KeyVideo') ?? '', $item->ObjectId);
        }
        return null;
    }


    public function getDataByPipeLine(array $arrayKeys)
    {
        try {
            $arrayPipeLine =  RedisClientHelper::getDataByPipeLine($arrayKeys);
            $megaKey = []; //gop tất cả cá key mget
            $index = 0; //set index theo array $arrayPipeLine
            $megaData = [];// dữ liệu cuối khi trả ra
            $setdataMget = [];// để mapping khi dữ liệu lấy ra từ $megaKey
            if (!empty($arrayPipeLine)) {
                foreach ($arrayKeys as $key => $value) {
                    if (!empty($arrayPipeLine[$index]) && is_array($arrayPipeLine[$index])) {
                        $colection = collect($arrayPipeLine[$index]); // sắp xếp và thu thập dữ liệu từ PipeLine lần 1
                        $colection = $colection->sortKeys()->values()->whereNotNull()->all();

                        if (!empty($value['callback'])) {
                            $objkey = [];

                            if (!empty($colection)){
                                $colection = array_splice($colection, (int)$value['start'], (int)$value['stop'] + 1);
                                foreach ($colection as $item) {
                                    $decodedItem = is_string($item) ? json_decode($item) : $item;
                                    if (isset($decodedItem->ObjectType)) {
                                        $objkey[] = $this->generateKeyByObjectType($decodedItem);
                                    }
                                }
                            }

                            if (!empty($objkey)){
                                $arr = [
                                    'keymap' => $key,
                                    'length' => count($objkey),
                                ];
                                $megaKey = array_merge($megaKey, $objkey);
                                array_push($setdataMget, $arr);
                            }else{
                                $arr = [
                                    'keymap' => $key,
                                    'length' => count($colection),
                                ];
                                $megaKey = array_merge($megaKey, $colection);
                                array_push($setdataMget, $arr);
                            }
                        }else{
                            if (!empty($colection[0])) {
                                if (json_decode($colection[0])) {
                                    $colection = array_map(function ($item) {
                                        if (!empty($item)) {
                                            return json_decode($item);
                                        }
                                    }, $colection);
                                    $colection = array_splice($colection, (int)$value['start'], (int)$value['stop'] + 1);
                                    $megaData[$key] = $colection;
                                } else {
                                    $arr = [
                                        'keymap' => $key,
                                        'length' => count($colection),
                                    ];
                                    $megaKey = array_merge($megaKey, $colection);
                                    array_push($setdataMget, $arr);
                                }
                            } else {
                                $arr = [
                                    'keymap' => $key,
                                    'length' => count($arrayPipeLine[$index]),
                                ];
                                array_push($setdataMget, $arr);
                            }
                        }
                    } else {// value khi không phải array trả lại như cũ
                        $megaData[$key] = $arrayPipeLine[$index] ?? '';
                    }
                    $index++;
                }

                $listData = self::getDataByMgetFormat($megaKey);
                foreach ($setdataMget as $key => $value) {
                    $data = array_splice($listData, 0, (int)$value['length']);
                    $megaData[$value['keymap']] = array_filter($data);
                }
            }
            return $megaData;
        } catch (\Throwable $th) {
            return [];
        }
    }

    /**
     * Get List News from Redis by Mget
     * @param array $arrayKey example: ['key1','key2']
     * @return array
     */

    public function getDataByMgetFormat(array $arrayKey)
    {
        if (empty($arrayKey)) {
            return [];
        }

        $listNews = RedisClientHelper::getDataByPipeLine([['cmd' => 'mGet', 'key' => $arrayKey]]);
        $listNews = Arr::first($listNews) ?? [];

        return array_map(function ($item) {
            return !empty($item) ? json_decode($item) : $item;
        }, $listNews);
    }


    public function mgetNewsByListNews(array $arrNews = [])
    {
        if (empty($arrNews)) {
            return [];
        }

        // Tạo mảng key bằng array_map thay vì dùng vòng lặp
        $arrkey = array_map(function ($item) {
            return 'newspublish:newsid' . ($item->NewsId ?? '');
        }, $arrNews);

        // Lấy dữ liệu từ Redis nếu arrkey không rỗng
        return !empty($arrkey) ? self::getDataByMgetFormat($arrkey) : [];
    }
}
