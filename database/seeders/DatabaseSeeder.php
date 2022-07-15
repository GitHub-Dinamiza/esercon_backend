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
        $this->call(GeneralDataSeesd::class);

        $this->call(EstadosSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(RoleSeeder::class);
        $this->call(TipoDocumentosSeeder::class);
        $this->call(ProveedoresSeeders::class);
        $this->call(PermmissionSeeder::class);
        $this->call(UserRolePermissionSeeder::class);
        $this->call(LocalizacionSeeder::class);
        $this->call(ProveedoreSeed::class);

        $this->call(FnProcesosSeeder::class);
        $this->call(TiposViasSeeder::class);
        $this->call(CondecionesEconomicasSeeder::class);
        $this->call(GastosEstimadoYOperativoSeeder::class);
        $this->call(RecorridoSeeder::class);
        $this->call(VehiculoSeeder::class);
        $this->call(ValidacionDocumentoSeed::class);
        $this->call(listValidacionSeed::class);
        $this->call(vehItemRevisionSeeder::class);
    }
}
