<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    //
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'accounts_address';
    /**
     * @var array
     */
    protected $fillable = ['street', 'neighborhood', 'zip_code','state','city'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */

    public function address(){
        return $this->morphTo();
    }
}
