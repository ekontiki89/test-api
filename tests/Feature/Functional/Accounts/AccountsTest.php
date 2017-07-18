<?php

namespace Tests\Feature\Accounts;

use App\Entities\Catalogs\Contact;
use App\Entities\Catalogs\Regime;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class AccountsTest extends TestCase
{
    use DatabaseMigrations;

    protected function createRegime($count = 2){
        $regime = factory(Regime::class,$count)->create();
        return $regime;
    }

    protected function createContact($count =2){
        $contacts = factory(Contact::class,$count)->create();
        return $contacts;
    }

    public function test_it_can_create_an_account()
    {
        $user = factory(\App\Entities\User::class)->create();
        $token = $this->getUserAccessToken($user);
        $regime = $this->createRegime();
        $contact = $this->createContact();


        $response = $this->json('POST','api/accounts', [
            'name' => 'Cuenta numero 1',
            'invoice_required' => 1,
            'active' => 1,
            'business_name'=>"S.A de C.V Empresa Fulanita",
            'rfc' => 'cavj1701019V6',
            'regime_id' => $regime->first()->id,
            'street'   => 'Sucre',
            'neighborhood' => 'Col. independencia',
            'state' => 'Jalisco',
            'city'  =>  'Guadalajara',
            'zip_code'  => 44560

        ], ['Authorization' => 'Bearer '.$token->access_token]);

       // dd($response->getContent());

        $response->assertStatus(201);
        $this->assertDatabaseHas('accounts', [
            'name' => 'Cuenta numero 1',
            'invoice_required' => 1,
            'active' => 1
        ]);
        $this->assertDatabaseHas('accounts_invoice', [
            'business_name'=>"S.A de C.V Empresa Fulanita",
            'rfc' => 'cavj1701019V6',
            'regime_id' => $regime->first()->id
        ]);
        $this->assertDatabaseHas('accounts_address', [
            'street'   => 'Sucre',
            'neighborhood' => 'Col. independencia',
            'state' => 'Jalisco',
            'city'  =>  'Guadalajara',
            'zip_code'  => 44560
        ]);
    }


    public function test_it_deletes_an_account()
    {
        $user = factory(\App\Entities\User::class)->create();
        $token = $this->getUserAccessToken($user);
        $account = factory(\App\Entities\Account::class)->create();
        $response = $this->json('DELETE','api/accounts/'.$account->uuid, [],
            ['Authorization' => 'Bearer '.$token->access_token]);
        $response->assertStatus(204);

    }
}
