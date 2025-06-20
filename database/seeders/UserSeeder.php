<?php

namespace Database\Seeders;

use App\Enums\RolesEnum;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder {
    /**
    * Run the database seeds.
    */

    public function run(): void {

        User::factory()->create( [
            'name' => 'reader',
            'email' => 'reader@gmail.com'
        ] )->assignRole( RolesEnum::Reader->value );

        User::factory()->create( [
            'name' => 'writer',
            'email' => 'writer@gmail.com'
        ] )->assignRole( RolesEnum::Writer->value );

        User::factory()->create( [
            'name' => 'admin',
            'email' => 'admin@gmail.com'
        ] )->assignRole( RolesEnum::Admin->value );
    }
}
