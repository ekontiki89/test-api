<?php

namespace App\Transformers;

use App\Entities\Account;
use League\Fractal\TransformerAbstract;

class AccountEditTransformer extends TransformerAbstract
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
            'business_name' => $model->invoice->business_name,
            'rfc'   =>  $model->invoice->rfc,
            'regime_id' => $model->invoice->regime_id,


        ];
    }
}
