<?php

namespace radoslawkoziol\MonologMassTrade;

use GuzzleHttp\Client;
use Monolog\Handler\AbstractProcessingHandler;
use Monolog\Logger;

class MassTradeHandler extends AbstractProcessingHandler
{
    /** @var Client */
    protected $client;

    public function __construct($public_api_mt_url, $level = Logger::DEBUG, bool $bubble = true)
    {
        $this->client = new Client([
            'base_uri' => $public_api_mt_url
        ]);

        parent::__construct($level, $bubble);
    }

    public static function parseExceptionToArray(\Throwable $exception, $extra = []): array
    {
        return array_merge([
            'msg' => $exception->getMessage(),
            'file' => $exception->getFile(),
            'line' => $exception->getLine(),
            'trace' => $exception->getTraceAsString(),
            'code' => $exception->getCode(),
        ], $extra);
    }

    protected function write(array $record): void
    {
        $context = $record['context'];
        try {
            $this->getClient()->request('post', '/exception/store',[
                'headers' => [
                    'Accept' => 'application/json',
                ],
                'query' => $context
            ]);
        } catch (\Throwable $exception) {

        }
    }

    /**
     * @return Client
     */
    public function getClient(): Client
    {
        return $this->client;
    }


    


}