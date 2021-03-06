<?php

namespace Database\Seeders;

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
//        $this->call(users::class);
        $this->call(create_plan_data::class);
        $this->call(insert_default_templates::class);

        if (config('variables.WITH_FAKER')) {
            // FAKE data
        }
    }
}
