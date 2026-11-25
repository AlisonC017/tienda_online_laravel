<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->categorias();
        $this->admin();
    }

    private function categorias(): void
    {
        $categorias = ['Tecnología', 'Hogar', 'Moda', 'Belleza', 'Deportes', 'Juguetes', 'Alimentos', 'Mascotas'];

        foreach ($categorias as $nombre) {
            if (!DB::table('categorias')->where('nombre', $nombre)->exists()) {
                DB::table('categorias')->insert(['nombre' => $nombre]);
            }
        }
    }

    private function admin(): void
    {
        DB::table('usuarios')->insertOrIgnore([
            'google_id' => '109876543210987654321',
            'nombre'    => 'Admin',
            'correo'    => 'admin@gmail.com',
            'foto'      => null,
            'rol'       => 'administrador',
        ]);

        DB::table('usuarios')
            ->where('correo', 'admin@gmail.com')
            ->whereNull('password')
            ->update(['password' => Hash::make('admin12345')]);
    }
}
