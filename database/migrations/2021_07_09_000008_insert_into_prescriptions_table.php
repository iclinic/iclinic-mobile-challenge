<?php

use App\Models\Prescription;
use Illuminate\Database\Migrations\Migration;

class InsertIntoPrescriptionsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        for($i =1; $i <= 50; $i++){
            Prescription::factory()->create();
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::table('prescriptions')
            ->delete();
    }
}
