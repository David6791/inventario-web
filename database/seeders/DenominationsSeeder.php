<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\Denomination;

class DenominationsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Denomination::create([
            'type' => 'BILLETE',
            'value' => 10
        ]);
        Denomination::create([
            'type' => 'BILLETE',
            'value' => 20
        ]);
        Denomination::create([
            'type' => 'BILLETE',
            'value' => 50
        ]);
        Denomination::create([
            'type' => 'BILLETE',
            'value' => 100
        ]);
        Denomination::create([
            'type' => 'BILLETE',
            'value' => 200
        ]);
        Denomination::create([
            'type' => 'MONEDAS',
            'value' => 0.1
        ]);
        Denomination::create([
            'type' => 'MONEDAS',
            'value' => 0.2
        ]);
        Denomination::create([
            'type' => 'MONEDAS',
            'value' => 0.5
        ]);
        Denomination::create([
            'type' => 'MONEDAS',
            'value' => 1
        ]);
        Denomination::create([
            'type' => 'MONEDAS',
            'value' => 2
        ]);
        Denomination::create([
            'type' => 'MONEDAS',
            'value' => 5
        ]);
        Denomination::create([
            'type' => 'OTROS',
            'value' => 0
        ]);
    }
}
