<?php

namespace App\Entities;

use App\Entities\Catalogs\Regime;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'accounts_invoice';
    /**
     * @var array
     */
    protected $fillable = ['account_id', 'business_name', 'rfc', 'regime_id'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function account()
    {
        return $this->belongsTo(Account::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function regime(){
        return $this->belongsTo(Regime::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function address()
    {
        return $this->morphMany(Address::class, 'address');
    }

    /**
     * @param $value
     */
    public function setRfcAttribute($value)
    {
        $this->attributes['rfc'] = strtoupper($value);
    }
}
