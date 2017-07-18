<?php

use Illuminate\Database\Seeder;

class TaxRegimeTableSeeder extends Seeder
{
    /**
     * @var array roles
     */
    protected $regime = [
        'Persona moral',
        'Persona fisica'
    ];
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach($this->regime as $r)
        {
            \App\Entities\Catalogs\Regime::create(['name'=>$r]);
        }
    }
}
