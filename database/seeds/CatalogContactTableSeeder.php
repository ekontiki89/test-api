<?php

use Illuminate\Database\Seeder;

class CatalogContactTableSeeder extends Seeder
{
    /**
     * @var array roles
     */
    protected $contacts = [
        'Pago',
        'Tecnico'
    ];
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach($this->contacts as $c)
        {
            \App\Entities\Catalogs\Contact::create(['name'=>$c]);
        }
    }
}
