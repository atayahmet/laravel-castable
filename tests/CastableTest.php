<?php

namespace Castable\Tests;

use Castable\Tests\TestCase;
use Illuminate\Support\Collection;
use Illuminate\Http\Request;
use stdClass;

class CastableTest extends TestCase
{
    protected $categories;

    public function setUp()
    {
        parent::setUp();
    }

    public function testAll()
    {
        $all = $this->castRequest->cast()->all();

        $this->assertCount(11, $all);
        $this->assertInternalType('integer', $all['age']);
        $this->assertInternalType('integer', $all['birthYear']);
        $this->assertInternalType('float', $all['total_money']);
        $this->assertInternalType('double', $all['total']);
        $this->assertInternalType('real', $all['total2']);
        $this->assertInternalType('null', $all['phone']);
        $this->assertInternalType('boolean', $all['student']);
        $this->assertInternalType('string', $all['name']);
        $this->assertInternalType('array', $all['hobbies']);
        $this->assertInternalType('object', $all['books']);
        $this->assertTrue($all['books'] instanceof stdClass);
        $this->assertInternalType('object', $all['interests']);
        $this->assertTrue($all['interests'] instanceof Collection);

        $all = $this->castRequest->all();

        $this->assertCount(11, $all);
        $this->assertInternalType('string', $all['age']);
        $this->assertInternalType('string', $all['birthYear']);
        $this->assertInternalType('string', $all['total_money']);
        $this->assertInternalType('string', $all['total']);
        $this->assertInternalType('string', $all['total2']);
        $this->assertInternalType('string', $all['phone']);
        $this->assertInternalType('string', $all['student']);
        $this->assertInternalType('string', $all['name']);
        $this->assertInternalType('array', $all['hobbies']);
        $this->assertInternalType('array', $all['books']);
        $this->assertFalse($all['books'] instanceof stdClass);
        $this->assertInternalType('array', $all['interests']);
        $this->assertFalse($all['interests'] instanceof Collection);
    }

    public function testInput()
    {
        // change method as GET
        $this->castRequest->setMethod('GET');

        $this->assertEquals('GET', $this->castRequest->getRealMethod());

        $input = $this->castRequest->cast()->input();

        $this->assertCount(11, $input);
        $this->assertInternalType('integer', $input['age']);
        $this->assertInternalType('integer', $input['birthYear']);
        $this->assertInternalType('float', $input['total_money']);
        $this->assertInternalType('double', $input['total']);
        $this->assertInternalType('real', $input['total2']);
        $this->assertInternalType('null', $input['phone']);
        $this->assertInternalType('boolean', $input['student']);
        $this->assertInternalType('string', $input['name']);
        $this->assertInternalType('array', $input['hobbies']);
        $this->assertInternalType('object', $input['books']);
        $this->assertTrue($input['books'] instanceof stdClass);
        $this->assertInternalType('object', $input['interests']);
        $this->assertTrue($input['interests'] instanceof Collection);

        $input = $this->castRequest->input();

        $this->assertCount(11, $input);
        $this->assertInternalType('string', $input['age']);
        $this->assertInternalType('string', $input['birthYear']);
        $this->assertInternalType('string', $input['total_money']);
        $this->assertInternalType('string', $input['total']);
        $this->assertInternalType('string', $input['total2']);
        $this->assertInternalType('string', $input['phone']);
        $this->assertInternalType('string', $input['student']);
        $this->assertInternalType('string', $input['name']);
        $this->assertInternalType('array', $input['hobbies']);
        $this->assertInternalType('array', $input['books']);
        $this->assertFalse($input['books'] instanceof stdClass);
        $this->assertInternalType('array', $input['interests']);
        $this->assertFalse($input['interests'] instanceof Collection);

        // change method as POST
        $this->castRequest->setMethod('POST');

        $this->assertEquals('POST', $this->castRequest->getRealMethod());

        $input = $this->castRequest->cast()->input();

        $this->assertCount(11, $input);
        $this->assertInternalType('integer', $input['age']);
        $this->assertInternalType('integer', $input['birthYear']);
        $this->assertInternalType('float', $input['total_money']);
        $this->assertInternalType('double', $input['total']);
        $this->assertInternalType('real', $input['total2']);
        $this->assertInternalType('null', $input['phone']);
        $this->assertInternalType('boolean', $input['student']);
        $this->assertInternalType('string', $input['name']);
        $this->assertInternalType('array', $input['hobbies']);
        $this->assertInternalType('object', $input['books']);
        $this->assertTrue($input['books'] instanceof stdClass);
        $this->assertInternalType('object', $input['interests']);
        $this->assertTrue($input['interests'] instanceof Collection);

        $input = $this->castRequest->input();

        $this->assertCount(11, $input);
        $this->assertInternalType('string', $input['age']);
        $this->assertInternalType('string', $input['birthYear']);
        $this->assertInternalType('string', $input['total_money']);
        $this->assertInternalType('string', $input['total']);
        $this->assertInternalType('string', $input['total2']);
        $this->assertInternalType('string', $input['phone']);
        $this->assertInternalType('string', $input['student']);
        $this->assertInternalType('string', $input['name']);
        $this->assertInternalType('array', $input['hobbies']);
        $this->assertInternalType('array', $input['books']);
        $this->assertFalse($input['books'] instanceof stdClass);
        $this->assertInternalType('array', $input['interests']);
        $this->assertFalse($input['interests'] instanceof Collection);
    }

    public function testJson()
    {
        $json = $this->castRequest->cast()->json()->all();

        $this->assertCount(12, $json);
        $this->assertInternalType('integer', $json['age']);
        $this->assertInternalType('integer', $json['birthYear']);
        $this->assertInternalType('float', $json['total_money']);
        $this->assertInternalType('double', $json['total']);
        $this->assertInternalType('real', $json['total2']);
        $this->assertInternalType('null', $json['phone']);
        $this->assertInternalType('boolean', $json['student']);
        $this->assertInternalType('string', $json['name']);
        $this->assertInternalType('array', $json['hobbies']);
        $this->assertInternalType('object', $json['books']);
        $this->assertTrue($json['books'] instanceof stdClass);
        $this->assertInternalType('object', $json['interests']);
        $this->assertTrue($json['interests'] instanceof Collection);

        $json = $this->castRequest->json()->all();

        $this->assertCount(12, $json);
        $this->assertInternalType('string', $json['age']);
        $this->assertInternalType('string', $json['birthYear']);
        $this->assertInternalType('string', $json['total_money']);
        $this->assertInternalType('string', $json['total']);
        $this->assertInternalType('string', $json['total2']);
        $this->assertInternalType('string', $json['phone']);
        $this->assertInternalType('string', $json['student']);
        $this->assertInternalType('string', $json['name']);
        $this->assertInternalType('array', $json['hobbies']);
        $this->assertInternalType('array', $json['books']);
        $this->assertFalse($json['books'] instanceof stdClass);
        $this->assertInternalType('array', $json['interests']);
        $this->assertFalse($json['interests'] instanceof Collection);
    }

    public function testCast()
    {
        $this->assertTrue($this->castRequest->cast() instanceof Request);

        $data = $this->castRequest->cast($this->testData, 'query');

        $this->assertCount(11, $data);
        $this->assertInternalType('integer', $data['age']);
        $this->assertInternalType('integer', $data['birthYear']);
        $this->assertInternalType('float', $data['total_money']);
        $this->assertInternalType('double', $data['total']);
        $this->assertInternalType('real', $data['total2']);
        $this->assertInternalType('null', $data['phone']);
        $this->assertInternalType('boolean', $data['student']);
        $this->assertInternalType('string', $data['name']);
        $this->assertInternalType('array', $data['hobbies']);
        $this->assertInternalType('object', $data['books']);
        $this->assertTrue($data['books'] instanceof stdClass);
        $this->assertInternalType('object', $data['interests']);
        $this->assertTrue($data['interests'] instanceof Collection);
    }

    public function testQueryAgeAttribute()
    {
        $this->castRequest->setMethod('GET');

        // QueryAgeAttribute is in TestCaseRequest
        // Default value: 11
        // Method: GET
        $this->assertEquals(12, $this->castRequest->cast()->input('age'));
    }

    public function testPostAgeAttribute()
    {
        $this->castRequest->setMethod('POST');

        // QueryAgeAttribute is in TestCaseRequest
        // Default value: 11
        // Method: POST
        $this->assertEquals(12, $this->castRequest->cast()->input('age'));
    }

    public function testJsonExperienceAttribute()
    {
        $this->castRequest->setMethod('POST');

        // QueryAgeAttribute is in TestCaseRequest
        // Default value: 4
        // Data: Raw data
        // Method: POST
        $this->assertEquals(5, $this->castRequest->cast()->json('experience'));
    }
}
