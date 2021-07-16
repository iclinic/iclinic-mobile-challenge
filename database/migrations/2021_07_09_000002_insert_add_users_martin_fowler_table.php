<?php

use Carbon\Carbon;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;

class InsertAddUsersMartinFowlerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::table('users')->insert([
            'name'           => 'Martin Fowler',
            'email'          => 'martinfowler@gmail.com',
            'password'       => Hash::make('martinfowler'),
            'created_at'     => Carbon::now(),
            'updated_at'     => Carbon::now()
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::table('users')->where(['email' => 'martinfowler@gmail.com'])->delete();
    }
}
