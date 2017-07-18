<?php

use Illuminate\Database\Seeder;

class RoleTableSeeder extends Seeder
{
    /**
     * @var array roles
     */
    protected $roles = [
        'Admin',
        'User'
    ];
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        foreach($this->roles as $rol)
        {
            \Spatie\Permission\Models\Role::create(['name' => $rol]);
        }
    }
}
