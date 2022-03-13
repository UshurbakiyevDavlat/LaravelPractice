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
        //php artisan db:seed - запуск всех наполнителей
        //php artisan db:seed --class=UserSeeder запуск определенного наполнителя

        $this->call([
            UsersSeeder::class
        ]);
    }
}
