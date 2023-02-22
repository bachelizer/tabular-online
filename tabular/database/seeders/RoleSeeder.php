<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $data = [
            [
                'id' => \App\Enums\RoleEnum::Admin,
                'role' => 'Admin'
            ],
            [
                'id' => \App\Enums\RoleEnum::Emcee,
                'role' => 'Emcee'
            ],
            [
                'id' => \App\Enums\RoleEnum::Judge,
                'role' => 'Judge'
            ],
        ];
        Role::insert($data);
    }
}
