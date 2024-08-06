# VIP-RESELLER API CLIENT FOR LARAVEL

[![Latest Version on Packagist](https://img.shields.io/packagist/v/jstalinko/tokoshani-vipreseller.svg?style=flat-square)](https://packagist.org/packages/jstalinko/tokoshani-vipreseller)
[![Total Downloads](https://img.shields.io/packagist/dt/jstalinko/tokoshani-vipreseller.svg?style=flat-square)](https://packagist.org/packages/jstalinko/tokoshani-vipreseller)
![GitHub Actions](https://github.com/jstalinko/tokoshani-vipreseller/actions/workflows/main.yml/badge.svg)

This is where your description should go. Try and limit it to a paragraph or two, and maybe throw in a mention of what PSRs you support to avoid any confusion with users and contributors.

## Installation

You can install the package via composer:

```bash
composer require jstalinko/tokoshani-vipreseller
```

## Usage

### in Laravel Controllers

```bash
php artisan make:controller VipresellerController
```

```php

namespace Jstalinko\TokoshaniVipreseller\Http\Controllers;

use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Jstalinko\TokoshaniVipreseller\TokoshaniVipreseller;
use PhpParser\Node\Expr\Cast\Object_;
use stdClass;

class VipresellerController extends Controller
{
    protected $vipreseller;

    public function __construct(TokoshaniVipreseller $vipreseller)
    {
        $this->vipreseller = $vipreseller;
    }

    public function buildResponse(bool $success, int $code, array|stdClass $data): JsonResponse
    {
        $response['success'] = $success;
        $response['code'] = $code;
        $response['shnData'] = $data;
        $response['x-api'] = "jstalinko/tokoshani-vipreseller";

        return response()->json($response, $code, [], JSON_PRETTY_PRINT);
    }

    public function getProfile()
    {
        try {
            $profile = $this->vipreseller->getProfile();
            return $this->buildResponse(true, 200, json_decode($profile, true));
        } catch (Exception $e) {
            return $this->buildResponse(false, 500, ['errors' => $e]);
        }
    }

    public function getGameFeatureServices(Request $request): JsonResponse
    {
        try {
            $filterType = $request->filter_type ?? null;
            $filterValue = $request->filter_value ?? null;
            $filterStatus = $request->filter_status ?? null;

            $games = $this->vipreseller->getGameFeatureServices($filterType, $filterValue, $filterStatus);
            return $this->buildResponse(true, 200, json_decode($games, true));
        } catch (Exception $e) {
            return $this->buildResponse(false, 500, ['errors' => $e]);
        }
    }
    public function getPrepaidServices(Request $request): JsonResponse
    {

        try {
            $filterType = $request->filter_type ?? null;
            $filterValue = $request->filter_value ?? null;
            $prepaid = $this->vipreseller->getPrepaidServices($filterType, $filterValue);
            return $this->buildResponse(true, 200, json_decode($prepaid, true));
        } catch (Exception $e) {
            return $this->buildResponse(false, 500, ['errors' => $e]);
        }
    }

    public function getCheckNickname(Request $request): JsonResponse
    {

        try {
            $target = $request->target;
            $additional_target = $request->additional_target ?? null;
            $type = $request->type;
            $getNickname = $this->vipreseller->getNickname($type, $target, $additional_target);
            return $this->buildResponse(true, 200, json_decode($getNickname, true));
        } catch (Exception $e) {
            return $this->buildResponse(false, 500, ['errors' => $e]);
        }
    }
}

```

### Use API 
```bash
curl -s "http://localhost:8000/shn-api/profile"
```

### Testing

```bash
composer test
```

### Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

### Security

If you discover any security related issues, please email alinkokomansuby@gmail.com instead of using the issue tracker.

## Credits

-   [alinko](https://github.com/jstalinko)
-   [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

## Laravel Package Boilerplate

This package was generated using the [Laravel Package Boilerplate](https://laravelpackageboilerplate.com).
