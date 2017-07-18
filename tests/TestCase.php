<?php

namespace Tests;

use Illuminate\Contracts\Debug\ExceptionHandler;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication, DatabaseMigrations;

    /**
     *
     */
    public function createPassportPasswordClient()
    {
        $this->artisan('passport:client', ['--password' => true, '--name' => 'Test Password']);
    }

    public function getUserAccessToken($user)
    {
        $this->createPassportPasswordClient();
        $client = \Laravel\Passport\Client::where('password_client', 1)->first();
        $response = $this->json('POST','oauth/token', [
            'grant_type' => 'password',
            'client_id' => $client->id,
            'client_secret' => $client->secret,
            'username' => $user->email,
            'password' => 'secret',
            'scope' => ''
        ]);

       return json_decode($response->getContent());
    }

    public function disableErrorHandling()
    {
        $this->app->instance(ExceptionHandler::class, new class extends Handler {
            public function __construct() {}
            public function report(Exception $e) {}
            public function render($request, Exception $e) {
                throw $e;
            }
        });
    }
}
