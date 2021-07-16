<?php

use App\Models\Clinic;
use Illuminate\Database\Migrations\Migration;

class InsertIntoClinicsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        for($i =1; $i <= 50; $i++){
            Clinic::factory()->create();
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::table('clinics')
            ->delete();
    }
}
