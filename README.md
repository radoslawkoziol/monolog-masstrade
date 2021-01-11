## INSTRUCTIONS

* install package
* add log channel in Laravel `config/logging.php`
```php 
'masstrade' => [
     'driver' => 'custom',
     'via' => radoslawkoziol\MonologMassTrade\MasstradeLogger::class,
     'level' => 'debug'
 ],
```

* add/edit in `.env` url to public api 
`PUBLIC_API_MT_URL=https://public-api.masstrade.pl`
SERVER_NAME=your_server_name
LOG_CHANNEL=masstrade
## USING
```php
$exceptionArray = MassTradeHandler::parseExceptionToArray($exception, [
    'url' => env('APP_URL'),
    'class' => 'Laravel'
]);
Log::error($exception->getMessage(), $exceptionArray);
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
    $exceptionArray = MassTradeHandler::parseExceptionToArray($exception, [
        'url' => env('APP_URL'),
        'class' => 'Laravel'
    ]);
    Log::error($exception->getMessage(), $exceptionArray);

}
```