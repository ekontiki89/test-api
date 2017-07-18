<?php

namespace App\Transformers;

use App\Entities\Account;
use League\Fractal\TransformerAbstract;

class AccountTransformer extends TransformerAbstract
{
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(Account $model)
    {
        return [
            'id'    =>  $model->uuid,
            'name'  =>  $model->name,
            'invoice_required' =>  $model->invoice_required,
            'active'    => $model->active,
            'updated_at' => $model->updated_at->toIso8601String()
        ];
    }
}
