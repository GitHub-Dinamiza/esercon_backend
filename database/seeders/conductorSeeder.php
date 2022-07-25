<?php

namespace Database\Seeders;

use App\Models\Persona\Conductor;
use App\Models\Persona\Persona;
use Database\Factories\Persona\ConductorFactory;
use Illuminate\Database\Seeder;

class conductorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Persona::factory()->count(50)->create();
       $conducto = new ConductorFactory;
       $conducto->count(50)->create();
    }
}
