<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;


class Contact extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'accounts_contact';
    /**
     * @var array
     */
    protected $fillable = ['account_id','contact_id', 'name', 'last_name','email','phone','cellphone'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function address()
    {
        return $this->morphMany(Address::class, 'address');
    }

    public function account()
    {
        return $this->belongsTo(Account::class);
    }

    public function catalogContact()
    {
        return $this->belongsTo(\App\Entities\Catalogs\Contact::class);
    }
}
