<?php

namespace App\Services;

use Illuminate\Http\Response;

class ResponseService
{
    public static function default($config = [], $id = null) : array {
        $route = $config['route'];
        $status = false;
        $msg = '';
        $url = '';

        switch ($config['type']) {
            case 'store':
                $status = true;
                $msg = 'Data inserted success!';
                $url = route($route);
                break;
            
            case 'show':
                $status = true;
                $msg = 'Request made success!';
                $url = self::getUrl($route, $id);
                break;
            
            case 'store':
                $status = true;
                $msg = 'Data deleted success!';
                $url = self::getUrl($route, $id);
                break;
        }

        return [
            'status' => $status,
            'msg' => $msg,
            'url' => $url
        ];
    }

    public static function exception($route, $id, $e){
        $status = false;
        $statusCode = 500;
        $error = '';
        $url = '';

        switch ($e->getCode()) {
            case -401:
            case -403:
            case -404:
                $status = false;
                $statusCode = abs($e->getCode());
                $error = $e->getMessage();
                $url = self::getUrl($route, $id);
                break;

            default:
                if(app()->bound('sentry')){
                    $sentry = app('sentry');
                    $user = auth()->user();
                    if($user){
                        $sentry->user_context(['id' => $user->id, 'name' => $user->name]);
                    }
                    $sentry->captureException($e);
                }
                $status = false;
                $statusCode = 500;
                $error = 'General error';
                $url = self::getUrl($route, $id);
                break;
        }

        return response()->json([
            'status' => $status,
            'statusCode' => $statusCode,
            'error' => $error,
            'url' => $url
        ], $statusCode);
    }

    public static function getUrl($route, $id){
        return $id != null ? route($route,$id) : route($route);
    }
}
