<?php

use App\Models\Patient;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Staff;
use App\Models\Test;
use App\Models\Patienttest;
return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patienttests', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Patient::class,'patient_id');
            $table->foreignIdFor(Staff::class,'staff_id');
            $table->foreignIdFor(Test::class,'test_id');
            $table->date('test_date');
            $table->boolean('is_finished')->default(false);
            $table->boolean('is_audited')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('patienttests');
    }
};
