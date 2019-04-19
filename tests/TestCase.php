<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use App\User;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    protected function createAdmin()
    {
        return factory(User::class)->create([ 'admin' => true ]);
    }
}
