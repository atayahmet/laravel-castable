# Laravel Castable

**Laravel Castable** package is a type converter, input filter or sanitizer. It is possible to do all of these operations. Supported `POST`, `RAW DATA`, `GET` requests methods. We started by inspiring the Laravel Eloquent data cast.

Supported Laravel versions: **5.3** and **5.4**

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

## Create Castable Form Request class

We created new artisan command that inspired `make:request` from laravel built in command.

```sh
$ php artisan make:cast ContactFormRequest
```

**New form of the form request class:**

```php

<?php

namespace App\Http\Requests;

use Castable\Castable;

class ContactFormRequest extends Castable
{
    protected $casts = [
        'json' => [
            //
        ],
        'post'  => [
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

Raw type of the attributes:
