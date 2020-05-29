<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

use App\User;
use App\Dealer;

use Illuminate\Support\Facades\Artisan;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    use DatabaseMigrations;

    public $users, $user, $profile;

    public function setUp()
    {
        parent::setUp();

//        Artisan::call('migrate',['-vvv' => true]);
        // Artisan::call('passport:install',['-vvv' => true]);
//        Artisan::call('db:seed',['-vvv' => true]);
    }
}
