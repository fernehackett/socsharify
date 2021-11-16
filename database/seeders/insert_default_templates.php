<?php

namespace Database\Seeders;

use App\Models\DefaultTemplate;
use Illuminate\Database\Seeder;

class insert_default_templates extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DefaultTemplate::truncate();
        DefaultTemplate::create([
            "name" => "ritika agrawal"
        ]);
    }
}
