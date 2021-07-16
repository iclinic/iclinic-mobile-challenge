<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Webpatser\Uuid\Uuid;
use DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('users')->insert([
            'name'           => 'Rick',
            'email'          => 'rick@gmail.com',
            'password'       => Hash::make('rickandmorty'),
            'created_at'     => Carbon::now(),
            'updated_at'     => Carbon::now()
        ]);

        DB::table('users')->insert([
            'name'           => 'Morty',
            'email'          => 'morty@gmail.com',
            'password'       => Hash::make('rickandmorty'),
            'created_at'     => Carbon::now(),
            'updated_at'     => Carbon::now()
        ]);


    }
}
