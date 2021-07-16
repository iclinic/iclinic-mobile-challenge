<?php

use Carbon\Carbon;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Webpatser\Uuid\Uuid;

class InsertIntoOauthClientsPasswordGrantTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::table('oauth_clients')->insert([
            [
                'id' => '2',
                'name' => 'Medicinae Scraper Challenge Password Grant Client',
                'secret' => 'xOjzZgqTuklsZFhQWnB1CdyCGX2kQOX8v7d21wVr',
                'redirect' => 'http://localhost',
                'personal_access_client' => 'false',
                'password_client' => 'true',
                'revoked' => 'false',
                'provider' => 'users',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::table('oauth_clients')
            ->where('id', '=','2')
            ->delete();
    }
}
