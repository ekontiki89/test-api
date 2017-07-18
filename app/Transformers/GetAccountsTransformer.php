<?php

namespace App\Transformers;

use App\Entities\Account;
use League\Fractal\TransformerAbstract;

class GetAccountsTransformer extends TransformerAbstract
{
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(Account $model)
    {
        return [
            //
            'id' => $model->uuid,
            'name'  => $model->name
        ];
    }
}
