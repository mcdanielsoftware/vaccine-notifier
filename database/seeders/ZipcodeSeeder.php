<?php

namespace Database\Seeders;

use App\Models\Zipcode;
use Illuminate\Database\Seeder;

class ZipcodeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = json_decode(file_get_contents('us-zip-code-latitude-and-longitude.json'));
        foreach ($data as $zip) {
            Zipcode::create([
                'zipcode' => $zip->fields->zip,
                'city' => $zip->fields->city,
                'state' => $zip->fields->state,
                'lat' => $zip->fields->latitude,
                'long' => $zip->fields->longitude,
            ]);
        }
    }
}
