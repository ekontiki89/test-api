<?php

namespace App\Http\Controllers;

use App\Entities\Address;
use App\Entities\Contact;
use App\Entities\Invoice;
use App\Entities\Catalogs\Regime;
use App\Transformers\AccountEditTransformer;
use App\Transformers\AccountTransformer;
use App\Transformers\GetAccountsTransformer;
use DB;
use App\Entities\Account;
use Illuminate\Http\Request;


class AccountController extends Controller
{
    // Account model
    protected $model;

    /**
     * AccountController constructor.
     * @param Account $model
     */
    public function __construct(Account $model)
    {
        $this->model = $model;
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $accounts = $this->model->active(true)->get();
        return response()->json(fractal($accounts, new AccountTransformer())->toArray());

    }

    /**
     * @param Request $request
     * @return $this
     */
    public function store(Request $request)
    {
        $account = $this->model->create($request->only(['name','invoice_required','active']));
        // account invoice
        $regime = Regime::find($request->input('regime_id'));
        $invoice = Invoice::create($request->only(['business_name','rfc']));
        $regime->invoice()->save($invoice);
        $account->invoice()->save($invoice);
        // account address
        $address = Address::create($request->only('street','neighborhood','zip_code','state','city'));
        $invoice->address()->save($address);
        // account Contact page
        $attributes['contact_id'] = $request->get('pcontact');
        $attributes['name'] = $request->get('pname');
        $attributes['last_name'] = $request->get('plastname');
        $attributes['email'] = $request->get('pemail');
        $attributes['phone'] = $request->get('pphone');
        $attributes['cellphone'] = $request->get('pcellphone');
        $contact = Contact::create($attributes);
        $account->contact()->save($contact);

        $page['street'] = $request->get('pstreet');
        $page['neighborhood'] = $request->get('pneighborhood');
        $page['zip_code'] = $request->get('pzip_code');
        $page['state'] = $request->get('pstate');
        $page['city'] = $request->get('pcity');
        $addressP = Address::create($page);
        $contact->address()->save($addressP);

        // account contact tecnico

        $attributes['contact_id'] = $request->get('tcontact');
        $attributes['name'] = $request->get('tname');
        $attributes['last_name'] = $request->get('tlastname');
        $attributes['email'] = $request->get('temail');
        $attributes['phone'] = $request->get('tphone');
        $attributes['cellphone'] = $request->get('tcellphone');
        $contact = Contact::create($attributes);
        $account->contact()->save($contact);

        $tec['street'] = $request->get('tstreet');
        $tec['neighborhood'] = $request->get('tneighborhood');
        $tec['zip_code'] = $request->get('tzip_code');
        $tec['state'] = $request->get('tstate');
        $tec['city'] = $request->get('tcity');
        $addressT = Address::create($tec);
        $contact->address()->save($addressT);

        return response()->json()->setStatusCode(201);
    }

    public function edit($id)
    {
        $account = $this->model->byUuid($id)->with('invoice')->firstOrFail();
        //return response()->json($account);
        return response()->json(fractal($account, new AccountEditTransformer())->toArray());

    }

    /**
     * @param $id
     * @return $this
     */

    public function destroy($id)
    {
       $account =  $this->model->byUuid($id)->firstOrFail();
       $invoice = Invoice::where('account_id',$account->id)->firstOrFail();
       $contact = Contact::where('account_id',$account->id)->get();
       $invoice->address()->delete();
       foreach ($contact as $c)
       {
           $c->address()->delete();
       }

       $account->delete();
        return response()->json()->setStatusCode(204);

    }

    public function getAccounts()
    {
        $accounts = $this->model->active(true)->select('uuid','name')->get();
        return response()->json(fractal($accounts, new GetAccountsTransformer())->toArray())->setStatusCode(200);
    }
}
