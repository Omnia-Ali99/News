<?php

namespace Database\Seeders;

use App\Models\Authorization;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions =[];
        foreach(config('authorization.permissions') as $permission=>$value){
            $permissions[] = $permission;
        }
        Authorization::create([
            'role'=>'Manger',
            'permissions' =>json_encode($permissions),
        ]);
    }
}
