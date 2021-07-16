<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterPrescriptionsAddForeignKeyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('prescriptions', function (Blueprint $table) {
            $table->foreign('clinic_id','prescriptions_clinic_id')->references('id')->on('clinics');
            $table->foreign('physician_id','prescriptions_physician_id')->references('id')->on('physicians');
            $table->foreign('patient_id','prescriptions_patient_id')->references('id')->on('patients');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('prescriptions', function (Blueprint $table) {
            $table->dropForeign('prescriptions_clinic_id');
            $table->dropForeign('prescriptions_physician_id');
            $table->dropForeign('prescriptions_patient_id');
        });
    }
}
