<?php

use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    protected $permissions = [
        'Listar cuentas',
        'Crear cuenta',
        'Consultar cuenta',
        'Actualizar cuenta',
        'Eliminar cuenta'
    ];
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $role = \Spatie\Permission\Models\Role::findByName('Admin');
        foreach ($this->permissions as $permission)
        {
            $permission = \Spatie\Permission\Models\Permission::create(['name'=>$permission]);
            $role->givePermissionTo($permission);

        }
    }
}
