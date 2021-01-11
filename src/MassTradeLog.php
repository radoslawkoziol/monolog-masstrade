<?php


namespace radoslawkoziol\MonologMassTrade;

class MassTradeLog {

    public static function log(string $type, \Throwable $e) {
        $exceptionArray = MassTradeHandler::parseExceptionToArray($e, [
            'url' => env('APP_URL'),
            'class' => 'Laravel',
            'server' => env('SERVER_NAME', 'unknown')
        ]);


        switch ($type) {
            case 'error':
                return \Log::error($e->getMessage(), $exceptionArray);
            case 'default':
            default:
                return \Log::debug($e->getMessage(), $exceptionArray);

        }
    }

    public static function error(\Throwable $e) {
        self::log('error', $e);
    }

    public static function debug($debug) {
        if(is_string($debug) === false) $debug = json_encode($debug);
        $e = new \Exception($debug);
        self::log('debug', $e);
    }


}