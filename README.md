[![Build Status](https://travis-ci.org/atayahmet/laravel-castable.svg?branch=master)](https://travis-ci.org/atayahmet/laravel-castable) [![Total Downloads](https://poser.pugx.org/atayahmet/laravel-castable/downloads)](https://packagist.org/packages/atayahmet/laravel-castable) [![License](https://poser.pugx.org/atayahmet/laravel-castable/license)](https://packagist.org/packages/atayahmet/laravel-castable) [![Latest Stable Version](https://poser.pugx.org/atayahmet/laravel-castable/v/stable)](https://packagist.org/packages/atayahmet/laravel-castable)

# Laravel Castable

**Laravel Castable** package is a type converter, input filter or sanitizer. It is possible to do all of these operations. Supported `POST`, `RAW DATA`, `GET` requests methods. We started by inspiring the Laravel Eloquent data cast.

## Requirements

PHP 5.6, 7.0+
Laravel 5.3 (LTS) or Laravel 5.4 (Current)


## Get Started

Firstly, we install package:

```sh
$ composer require atayahmet/laravel-castable
```

and then we need add the service provider to the app.php

```php
Castable\CastableServiceProvider::class
```

OK, we done.

Let's see how to use the laravel-castable.

### Castable types

| Types  |
|-------|
| string |
| integer |
| boolean |
| float |
| double |
| real |
| unset |
| array |
| object (stdClass) |
| collection |


## Create Castable Form Request class

We created new artisan command that inspired `make:request` from laravel built in command.

```sh
$ php artisan make:cast ContactRequest
```

**New form of the form request class:**

```php

<?php

namespace App\Http\Requests;

use Castable\Castable;

class ContactRequest extends Castable
{
    protected $casts = [
        'json' => [
            //
        ],
        'post'  => [
            'name' => 'string',
            'age' => 'integer',
            'student' => 'boolean',
            'interests' => 'collection'
        ],
        'query' => [
            'save' => 'boolean'
        ]
    ];

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //
        ];
    }
}
```

We added four inputs to casts property, status attibute added to query string parameters and age, student and interests attributes added to post parameters.

### Raw and converted type of the attributes

**Post:**

| Name  | Value | Type | Cast Type |
|-------|-------|------| -----------|
| name  | Ali | string  | string |
| age   | 19  | string  | integer |
| student | true   | string  | boolean |
| interests | books, computers   | array  | collection |

**Query String:**

| Name  | Value | Type | Cast Type |
|-------|-------|------| ----------|
| save  | true  | string| boolean |

To get the above result for:

```php
<?php

ContactController extends Controller {

  public index(ContactRequest $contactRequest)
  {
      $contactRequest->input();
  }
}
```

**Get a input:**

```php
$contactRequest->input('interests'); // collection

$contactRequest->input('student') // boolean (true)

$contactRequest->input('save') // boolean (true)
````

if request is post raw data:

```php
$contactRequest->json();

$contactRequest->json('age');
````

**Get original inputs:**

```php
$contactRequest->original()->input();
```

**Get original an input:**

```php
$contactRequest->original()->input('student'); // string (true)
```

**Original raw data:**

```php
$contactRequest->original()->json();
```

## Add presenter to the inputs

You can add presenter to the all post, query and json inputs. This feature gives you a chance to filter  inputs.

Add presenter for post parameters:

```php

public function PostNameAttribute($value, $original)
{
    return ucfirst($value);
}
````

Add presenter for query string parameters:

```php

public function QuerySaveAttribute($value, $original)
{
    return $value === true ? 1 : 0;
}
````

Add presenter for json raw data parameters:

```php

public function JsonSaveAttribute($value, $original)
{
    return ucfirst($name);
}
````

## License

This package is open-source software licensed under the [MIT license](https://opensource.org/licenses/MIT).
