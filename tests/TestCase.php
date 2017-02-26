<?php

namespace Castable\Tests;

use Orchestra\Testbench\TestCase as OrchestraTestCase;

abstract class TestCase extends OrchestraTestCase
{
    protected $castRequest;

    /**
     * Define environment setup.
     *
     * @param  \Illuminate\Foundation\Application  $app
     * @return void
     */
    protected function getEnvironmentSetUp($app)
    {
        $testData = [
            'age'  => '11',
            'birthYear' => '2005',
            'total_money' => '35.34',
            'student' => 'true',
            'name'  => 'Ali',
            'hobbies' => ['book', 'travel'],
            'books' => ['LOTR', 'Harry Potter'],
            'interests' => ['art', 'computer science', 'software']
        ];

        $this->castRequest = $app->make(\Castable\Tests\TestCastRequest::class);

        $requestData = [];

        foreach(['query', 'post', 'attributes', 'cookies', 'files', 'server', 'json'] as $type) {

            if(in_array($type, ['query', 'post', 'json'])) {
                if($type == 'json') {
                    $requestData[$type] = json_encode(array_merge($testData, ['experience' => '4']));
                }else{
                    $requestData[$type] = $testData;
                }
            }else{
                $requestData[$type] = [];
            }
        }

        call_user_func_array([$this->castRequest, 'initialize'], $requestData);
    }

    protected function getPackageProviders($app)
    {
        return [\Castable\CastableServiceProvider::class, \Orchestra\Database\ConsoleServiceProvider::class];
    }
}
