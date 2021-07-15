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
        // \App\Models\User::factory(10)->create();
        $this->call(UserSeeder::class);
        $this->call(RoleSeeder::class);
        $this->call(PermmissionSeeder::class);
        $this->call(UserRolePermissionSeeder::class);
        $this->call(LocalizacionSeeder::class);
        $this->call(TipoDocumentosSeeder::class);
        $this->call(FnProcesosSeeder::class);
        $this->call(TiposViasSeeder::class);
        $this->call(CondecionesEconomicasSeeder::class);
        $this->call(GastosEstimadoYOperativoSeeder::class);
        $this->call(RecorridoSeeder::class);

    }
}
