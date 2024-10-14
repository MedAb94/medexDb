<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Http\Controllers\StandController;
use App\Models\GlobalModel;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        // Global models
        GlobalModel::updateOrCreate(['model' => 'App\\Models\\ContactType'], [
            'name' => 'Contact type',
            'url_prefix' => 'types',
            'icon' => 'briefcase',
            'add_title' => 'Creation',
            'edit_title' => 'Modification',
        ]);
        GlobalModel::updateOrCreate(['model' => 'App\\Models\\Continent'], [
            'name' => 'Continent',
            'url_prefix' => 'continents',
            'icon' => 'list',
            'add_title' => 'Creation',
            'edit_title' => 'Modification',
        ]);

        $this->call([
            UsersSeeder::class,
            ContinentAndCountrySeeder::class,
            StandSeeder::class,
        ]);

    }
}
