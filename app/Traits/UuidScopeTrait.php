<?php

namespace App\Traits;

/**
 * Class UuidScopeTrait
 * @package App\Traits
 */
trait UuidScopeTrait
{

    /**
     * @param $query
     * @param $uuid
     * @return mixed
     */
    public function scopeByUuid($query, $uuid)
    {
        return $query->where('uuid', $uuid);
    }
}
