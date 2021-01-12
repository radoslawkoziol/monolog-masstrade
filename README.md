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

* add in `.env` url to public api 
`PUBLIC_API_MT_URL=https://public-api.masstrade.pl`
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