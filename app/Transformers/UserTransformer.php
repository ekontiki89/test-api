<?php

namespace App\Transformers;

use App\Entities\User;
use League\Fractal\TransformerAbstract;

class UserTransformer extends TransformerAbstract
{
    /**
     * A Fractal transformer.
     * @param User $model
     * @return array
     */
    public function transform(User $model)
    {
        return [
            'account'  => $model->account->name,
            'id'    =>  $model->uuid,
            'name'  =>  $model->name,
            'email' =>  $model->email,
            'updated_at' => $model->updated_at->toIso8601String()
        ];
    }
}
