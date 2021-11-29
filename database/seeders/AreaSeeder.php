<?php

namespace Database\Seeders;

use App\Models\Area;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AreaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('areas')->insert([
            'nombre_area' => 'Rectoría',
            'titular' => 'Ruth Padilla',
            'informacion' => 'Protocolo rectoría',
            'telefono' => '1234567'
        ]);

        Area::create([
            'nombre_area' => 'Coord. Computación',
            'titular' => 'Janeth',
            'informacion' => 'Ayuda en procesos',
            'telefono' => '1234567'
        ]);

        Area::factory(20)->create();
    }
}
