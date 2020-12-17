<?php

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Permission::insert([
            ['permission' => 'Create-post'],
            ['permission' => 'Update-post'],
            ['permission' => 'Delete-post'],
        ]);
    }
}
