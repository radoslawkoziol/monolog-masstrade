## INSTRUCTIONS

* install package
* add logg channel in Laravel in `config/logging.php`
```php 
'masstrade' => [
     'driver'  => 'monolog',
     'handler' => radoslawkoziol\MonologMassTrade\MassTradeHandler::class,
     'with' => [
         'public_api_mt_url' => env('PUBLIC_API_MT_URL', 'UNDEFINED URL')
     ],
 ],
```

* add in `.env` url to public api 
`PUBLIC_API_MT_URL=https://public-api.masstrade.pl`
## USING
```php
$exceptionArray = MassTradeHandler::parseExceptionToArray($exception, [
    'url' => env('APP_URL'),
    'class' => 'Laravel'
]);
\Log::channel('masstrade')->alert('test', $exceptionArray);
```

## OPTIONAL

To get error handler working, add in file `app/Exceptions/Handler.php`

```php
public function report(Throwable $exception)
{
    if ($this->shouldReport($exception)) {
        $this->notifyMassTrade($exception);
    }
    parent::report($exception);
}

public function notifyMassTrade(Throwable $exception)
{
    try {

        $exceptionArray = MassTradeHandler::parseExceptionToArray($exception, [
            'url' => env('APP_URL'),
            'class' => 'Laravel'
        ]);
        \Log::channel('masstrade')->alert('test', $exceptionArray);

    } catch (Throwable $ex) {
        dd($ex);
    }
}
```