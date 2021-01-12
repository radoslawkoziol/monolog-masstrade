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
`SERVER_NAME=your_server_name`
## USING
```php
radoslawkoziol\MonologMassTrade\MassTradeLog::error($exception);
```

## OPTIONAL

To get error handler working, add in file `app/Exceptions/Handler.php`

```php
public function report(Throwable $exception)
{
    if ($this->shouldReport($exception)) {
        radoslawkoziol\MonologMassTrade\MassTradeLog::error($exception);
    }
    parent::report($exception);
}

```