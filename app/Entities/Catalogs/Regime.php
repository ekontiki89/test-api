<?php

namespace App\Entities\Catalogs;

use App\Entities\Invoice;
use Illuminate\Database\Eloquent\Model;

class Regime extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'catalog_tax_regime';
    /**
     * @var array
     */
    protected $fillable = ['name'];

    public function invoice(){
        return $this->hasMany(Invoice::class);
    }
}
