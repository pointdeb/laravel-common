# LARAVEL COMMON
this package provide common laravel functionality used to begin a project.

## Installation
```bash
composer require pointdeb/laravel-common
```


## VALIDATORS:

In AppServiceProvider.php add this line in boot function

```php
public function boot()
{
    ...
    \Pointdeb\LaravelCommon\Validators\HttpValidator::boot();
}
```

## ETAG

Lumen:
in app.php register the middleware

```php
$app->middleware([
    ...
     \Pointdeb\LaravelCommon\Middlewares\Etag::class,
 ]);
```

Comming soon :smile:

LICENCE MIT