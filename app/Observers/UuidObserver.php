<?php
/**
 * Created by PhpStorm.
 * User: ekontiki
 * Date: 16/05/17
 * Time: 13:22
 */

namespace App\Observers;


use Webpatser\Uuid\Uuid;

class UuidObserver
{
    /**
     * @param $model
     * @throws \Exception
     */
    public function creating($model)
    {
        if (empty($model->uuid)) {
            $model->uuid = Uuid::generate(4);
        }
    }

}