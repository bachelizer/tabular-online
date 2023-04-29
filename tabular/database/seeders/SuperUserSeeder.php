<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\SuperUser;

class SuperUserSeeder extends Seeder
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
                'full_name' => 'Admin Account',
                'password' => 'Admin',
                'role_id' => \App\Enums\RoleEnum::Admin
            ]
        ];

        SuperUser::insert($data);
    }
}
