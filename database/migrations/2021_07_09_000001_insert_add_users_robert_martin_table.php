<?php

use Carbon\Carbon;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;

class InsertAddUsersRobertMartinTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::table('users')->insert([
            'name'           => 'Robert Martin',
            'email'          => 'unclebob@gmail.com',
            'password'       => Hash::make('unclebob'),
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
        DB::table('users')->where(['email' => 'unclebob@gmail.com'])->delete();
    }
}
