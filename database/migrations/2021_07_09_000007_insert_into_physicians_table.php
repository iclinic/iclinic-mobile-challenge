<?php

use App\Models\Physician;
use Illuminate\Database\Migrations\Migration;

class InsertIntoPhysiciansTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        for($i =1; $i <= 50; $i++){
            Physician::factory()->create();
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::table('physicians')
            ->delete();
    }
}
