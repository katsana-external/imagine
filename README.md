Imagine (Wrapper) Component for Laravel 5
==============

Imagine (Wrapper) Component is a Laravel 5 package wrapper for [Imagine](https://github.com/avalanche123/Imagine).

[![Build Status](https://travis-ci.org/orchestral/imagine.svg?branch=master)](https://travis-ci.org/orchestral/imagine)
[![Latest Stable Version](https://poser.pugx.org/orchestra/imagine/v/stable)](https://packagist.org/packages/orchestra/imagine)
[![Total Downloads](https://poser.pugx.org/orchestra/imagine/downloads)](https://packagist.org/packages/orchestra/imagine)
[![Latest Unstable Version](https://poser.pugx.org/orchestra/imagine/v/unstable)](//packagist.org/packages/orchestra/imagine)
[![License](https://poser.pugx.org/orchestra/imagine/license)](https://packagist.org/packages/orchestra/imagine)

## Table of Content

* [Version Compatibility](#version-compatibility)
* [Installation](#installation)
* [Configuration](#configuration)
* [Usage](#usage)
* [Changelog](https://github.com/orchestral/imagine/releases)

## Version Compatibility

Laravel    | Imagine
:----------|:----------
 5.5.x     | 3.5.x
 5.6.x     | 3.6.x
 5.7.x     | 3.7.x
 5.8.x     | 3.8.x

## Installation

To install through composer, simply put the following in your `composer.json` file:

```json
{
    "require": {
        "orchestra/imagine": "^3.5"
    }
}
```

And then run `composer install` from the terminal.

### Quick Installation

Above installation can also be simplify by using the following command:

    composer require "orchestra/imagine=^3.5"

## Configuration

Add `Orchestra\Imagine\ImagineServiceProvider` service provider in `config/app.php`.

```php
'providers' => [

    // ...

    Orchestra\Imagine\ImagineServiceProvider::class,
],
```

Add `Imagine` alias in `config/app.php`.

```php
'aliases' => [

    // ...

    'Imagine' => Orchestra\Imagine\Facade::class,
],
```

## Usage

Here a simple example how to create a thumbnail from an image:

```php
<?php

use Imagine\Image\ImageInterface;
use Orchestra\Imagine\Jobs\CreateThumbnail;

dispatch(new CreateThumbnail([
    'path' => $path,
    'filename' => $filename, // filename without extension
    'extension' => $extension,
    'format' => '{filename}.thumb.{extension}',
    'dimension' => 320, // width and height will be 320.
    'mode' => ImageInterface::THUMBNAIL_OUTBOUND,
    'filter' => ImageInterface::FILTER_UNDEFINED,
]));
```
