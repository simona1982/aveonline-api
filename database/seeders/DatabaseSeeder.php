<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
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

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        /**
         * 
         * 
         * Administrador (1): Control total del sistema
         * Usuario (2):
         *    Para revisar las órdenes de compra
         *    Para cargar los productos
         *    Para ver las ordenes de compra de todos los clientes
         * Cliente (3):
         *    Para ingresar la orden de compra
         *    Para ver sus órdenes de compra
         */

        //USUARIOS
         DB::table('usuarios')->insert([
            'login' => "administrador",
            'clave' => Hash::make('password'),
            'nombre' => "andres velasquez",
            'rol' => 1
        ]); 

        DB::table('usuarios')->insert([
            'login' => "usuario",
            'clave' => Hash::make('password'),
            'nombre' => "juan fernandez",
            'rol' => 2
        ]);

        DB::table('usuarios')->insert([
            'login' => "cliente",
            'clave' => Hash::make('password'),
            'nombre' => "juan fernandez",
            'rol' => 3
        ]);

        //ROLES
        DB::table('roles')->insert([
            'nombre' => "administrador"
        ]);

        DB::table('roles')->insert([
            'nombre' => "usuario"
        ]);

        DB::table('roles')->insert([
            'nombre' => "cliente"
        ]);

        //PRODUCTOS
        DB::table('productos')->insert([
            'nombre' => "Kindle",
            'descripcion' => 'Lector de libros electronicos',
            'precio_unidad' => 530000,
            'numero_existencias' => 100
        ]);

        DB::table('productos')->insert([
            'nombre' => "Ipad",
            'descripcion' => 'Tablet',
            'precio_unidad' => 1000000,
            'numero_existencias' => 200
        ]);

        DB::table('productos')->insert([
            'nombre' => "Iphone 11",
            'descripcion' => 'Celular',
            'precio_unidad' => 2000000,
            'numero_existencias' => 50
        ]);
        
        
    }
}
