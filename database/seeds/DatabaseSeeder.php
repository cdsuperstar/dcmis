<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;


class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $this->call(UsersTableSeeder::class);
        $this->call(dcmodelsTableSeeder::class);

        $this->command->info('All jobs has been done!');

        Model::reguard();
        // $this->call(UsersTableSeeder::class);
    }
}
