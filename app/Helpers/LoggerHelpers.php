<?php

namespace App\Helpers;


use GuzzleHttp\Client;
use Exception;
use Illuminate\Support\Facades\Log;


class LoggerHelpers
{
    private static $logConfig;

    public function __construct()
    {
        self::CnndLogger();
    }

    public static function CnndLogger()
    {
        try {
            if (self::$logConfig == null) {
                $result = (object)[
                    'AllowLog' => !empty(config('cnndlog.AllowLog')) ? config('cnndlog.AllowLog') : '',
                    'ApiSetLog' => !empty(config('cnndlog.ApiSetLog')) ? config('cnndlog.ApiSetLog') : '',
                    'namespace' => !env('SITE_MOBILE') ? config('cnndlog.Namespace_web') : config('cnndlog.Namespace_mob'),
                ];
                self::$logConfig = $result;
            }
        } catch (\Throwable $e) {

        }
    }


    public static function CallApiSetLog(string $message, string $tag)
    {
        try {
            self::CnndLogger();
            $message = date('Y-m-d H:i:s') . '| SeveName: '.env('SEVERNAME',0).'=>' . $message;
            if (self::$logConfig == null || !self::$logConfig->AllowLog) return;
            self::MakeApiLogCnnd(self::$logConfig->ApiSetLog, self::$logConfig->namespace, $message, $tag);
        } catch (\Throwable $e) {
        }

    }

    public static function MakeApiLogCnnd(string $uri, string $ns, string $message, string $tag)
    {
        try {
            $client = new Client();
            $res = $client->request('PUT', $uri, [
                'timeout' => 1,
                'connect_timeout' =>1,
                'form_params' => [
                    'Message' => $message,
                    'NameSpace' => $ns,
                    'Tag' => $tag
                ]
            ]);
            if ($res->getStatusCode() == 200) {
                return;
            }
        } catch (\Throwable $e) {
        }

    }
}
