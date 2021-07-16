<?php

use Carbon\Carbon;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Webpatser\Uuid\Uuid;

class InsertIntoOauthClientsPersonalAccessTable extends Migration
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
                'id' => '1',
                'name' => 'Medicinae Scraper Challenge Personal Access Client',
                'secret' => 'Rje3WMiN8BG8UabMo6tKOuLRrpiyEv28BngNX3N2',
                'redirect' => 'http://localhost',
                'personal_access_client' => 'true',
                'password_client' => 'false',
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
            ->where('id', '=','1')
            ->delete();
    }
}
