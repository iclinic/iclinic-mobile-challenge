<?php

use App\Models\Patient;
use Illuminate\Database\Migrations\Migration;

class InsertIntoPatientsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        for($i =1; $i <= 50; $i++){
            Patient::factory()->create();
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::table('patients')
            ->delete();
    }
}
