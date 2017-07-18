<?php

namespace App\Transformers;

use App\Entities\User;
use League\Fractal\TransformerAbstract;

class UserEditTransformer extends TransformerAbstract
{
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(User $model)
    {
        return [
            'id'    =>  $model->uuid,
            'name'  =>  $model->name,
            'email' =>  $model->email,
            'account_id'    => $model->account_id


        ];
    }
}
