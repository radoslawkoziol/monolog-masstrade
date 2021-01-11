<?php

namespace radoslawkoziol\MonologMassTrade;
use Monolog\Logger;

class MassTradeLogger {


    public function __invoke(array $config)
    {
        return new Logger('masstrade', [
            new MassTradeHandler(env('PUBLIC_API_MT_URL'), !env('APP_DEBUG'), $config['level'])
        ]);
    }

}