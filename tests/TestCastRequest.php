<?php

namespace Castable\Tests;

use Castable\Castable;

class TestCastRequest extends Castable {

    protected $casts = [
        'json' => [
            'age'  => 'integer',
            'birthYear' => 'integer',
            'total_money' => 'float',
            'student' => 'boolean',
            'name'  => 'string',
            'hobbies' => 'array',
            'books' => 'object',
            'interests' => 'collection',
            'experience' => 'integer'
        ],
        'post'  => [
            'age'  => 'integer',
            'birthYear' => 'integer',
            'total_money' => 'float',
            'student' => 'boolean',
            'name'  => 'string',
            'hobbies' => 'array',
            'books' => 'object',
            'interests' => 'collection'
        ],
        'query' => [
            'age'  => 'integer',
            'birthYear' => 'integer',
            'total_money' => 'float',
            'student' => 'boolean',
            'name'  => 'string',
            'hobbies' => 'array',
            'books' => 'object',
            'interests' => 'collection'
        ]
    ];

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [

        ];
    }

    public function QueryAgeAttribute($value)
    {
        return $value + 1;
    }

    public function PostAgeAttribute($value)
    {
        return $value + 1;
    }

    public function JsonExperienceAttribute($value)
    {
        return $value + 1;
    }
}
