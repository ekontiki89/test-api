<?php

namespace App\Entities;

use App\Traits\UuidScopeTrait;
use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    use UuidScopeTrait;
    /**
     * @var array
     */
    protected $fillable = ['uuid', 'name', 'invoice_required', 'active'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function invoice()
    {
        return $this->hasOne(Invoice::Class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function contact()
    {
        return $this->hasMany(Contact::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function users()
    {
        return $this->hasMany(User::class);
    }
    // scopes
    /**
     * @param $query
     * @param $flag
     * @return mixed
     */
    public function scopeActive($query,$flag)
    {
        return $query->where('active',$flag);
    }

    /**
     * @param $query
     * @param $flag
     * @return mixed
     */
    public function scopeInvoiceRequired($query,$flag)
    {
        return $query->where('invoice_required',$flag);
    }
    // Accessors
    /**
     * @param $value
     * @return string
     */
    public function getActiveAttribute($value)
    {
        return ($value == 0)? "No":"Si";
    }

    /**
     * @param $value
     * @return string
     */
    public function getInvoiceRequiredAttribute($value)
    {
        return ($value == 0)? "No":"Si";
    }

    // setters

    public function setActiveAttribute($value)
    {
        $this->attributes['active'] = (strcmp($value,'Si'==0))? 1:0;
    }
    public function setInvoiceRequiredAttribute($value)
    {
        $this->attributes['invoice_required'] = (strcmp($value,'Si'==0))? 1:0;
    }
}
