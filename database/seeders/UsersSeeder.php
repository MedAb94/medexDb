<?php

namespace Database\Seeders;

use App\Models\User;
use Faker\Generator;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Generator $faker)
    {
        $user = User::updateOrCreate(['email' => 'superuser@medex.mr'], [
            'name' => "Superuser",
            'email' => 'superuser@medex.mr',
            'password' => Hash::make('demo'),
            'email_verified_at' => now(),
        ]);
//        $user->assignRole('superuser');
    }
}
