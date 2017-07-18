<?php

namespace Tests\Feature\Functional;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class AuthorizationServerTest extends TestCase
{
    use DatabaseMigrations;

    public function test_it_issues_access_token_for_user()
    {
        $this->createPassportPasswordClient();
        $client = \Laravel\Passport\Client::where('password_client', 1)->first();
        $user = factory(\App\Entities\User::class)->create();
        $response = $this->json('POST','oauth/token', [
            'grant_type' => 'password',
            'client_id' => $client->id,
            'client_secret' => $client->secret,
            'username' => $user->email,
            'password' => 'secret',
            'scope' => ''
        ]);
        $data = json_decode($response->getContent(),true);

        $response
            ->assertStatus(200)
            ->assertJson($data);

    }
}
