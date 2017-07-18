<?php

namespace App\Entities\Catalogs;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'catalog_contact';
    /**
     * @var array
     */
    protected $fillable = ['name'];

    public function contact(){
        return $this->hasMany(\App\Entities\Contact::class);
    }
}
