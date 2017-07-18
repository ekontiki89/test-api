<?php

namespace App\Http\Controllers;

use DB;
use App\Entities\User;
use App\Entities\Account;
use Illuminate\Http\Request;
use App\Transformers\UserTransformer;
use App\Transformers\UserEditTransformer;



class UserController extends Controller
{
    // User model
    protected $model;
    // Account model
    protected $account;
    /**
     * UserController constructor.
     * @param User $model
     */
    public function __construct(User $model, Account $account)
    {
        $this->model = $model;
        $this->account = $account;
    }

    public function index()
    {
        $users = $this->model->where('account_id','!=',null)->get();
        return response()->json(fractal($users, new UserTransformer())->toArray());

    }

    public function store(Request $request)
    {
        DB::beginTransaction();
        try{
            $user = $this->model->create($request->only(['name','email','password']));
            if($request->has('account_id')){
                $account = $this->account->byUuid($request->get('account_id'))->firstOrFail();
                $account->users()->save($user);
            }
            DB::commit();
        }catch (\Exception $e){
            DB::rollBack();
            return response()->json($e->getMessage())->setStatusCode(500);
        }
        return response()->json()->setStatusCode(201);
    }

    public function edit($id)
    {
        $account = $this->model->byUuid($id)->firstOrFail();
        return response()->json(fractal($account, new UserEditTransformer())->toArray());

    }

    /**
     * @param $id
     * @return $this
     */
    public function destroy($id)
    {
        $user =  $this->model->byUuid($id)->firstOrFail();
        $user->delete();
        return response()->json()->setStatusCode(204);

    }
}
