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
            "name" => "ritika_agrawal",
            "display_name" => "Ritika Agrawal",
            "options" => [
                "social networks" => [
                    "type" => "multiple",
                    "values" => ["facebook","twitter","linkedin","tumblr","snapchat","pinterest","reddit","telegram"],
                    "max" => 5
                ],
                "position" =>[
                    "type" => "one",
                    "values" => ["top", "left", "bottom", "right"]
                ]
            ]
        ]);
        DefaultTemplate::create([
            "name" => "rob_vermeer",
            "display_name" => "Rob Vermeer",
            "options" => [
                "social networks" => [
                    "type" => "multiple",
                    "values" => ["facebook","twitter","linkedin","tumblr","snapchat","pinterest","reddit","telegram"],
                    "max" => 8
                ],
                "position" =>[
                    "type" => "one",
                    "values" => ["top", "bottom"]
                ]
            ]
        ]);
        DefaultTemplate::create([
            "name" => "charlie_marcotte",
            "display_name" => "Charlie Marcotte",
            "options" => [
                "social networks" => [
                    "type" => "multiple",
                    "values" => ["facebook","twitter","linkedin","tumblr","snapchat","pinterest","reddit","telegram"],
                    "max" => 5
                ],
                "position" =>[
                    "type" => "one",
                    "values" => ["left", "right"]
                ]
            ]
        ]);
    }
}
