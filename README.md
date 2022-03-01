# SpatieTagsNovaFilter

This package allows you to filter resources by tags.
(using the awesome [Spatie/laravel-tags](https://github.com/spatie/laravel-tags) and [Selectize.js](https://github.com/selectize/selectize.js) )

## Installation

First you must install [spatie/laravel-tags](https://github.com/spatie/laravel-tags) into your Laravel app. Here are [the installation instructions](https://spatie.be/docs/laravel-tags/v4/installation-and-setup) for that package.

Next, you can install this package in to a Laravel app that uses [Nova](https://nova.laravel.com) via composer:

```bash
composer require mahi/spatie-tags-nova-filter
```

## Usage

After the package has been installed with Composer, simply register the filter in your resource:

```php
use Mahi\SpatieTagsNovaFilter\SpatieTagsNovaFilter;

class MyResource extends Resource
{
    /**
     * Get the filters available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function filters(Request $request)
    {
        return [
            new SpatieTagsNovaFilter
        ];
    }
}
```

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
