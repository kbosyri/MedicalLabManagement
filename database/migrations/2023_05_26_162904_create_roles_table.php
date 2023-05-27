<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->id();
            $table->text('name');
            $table->boolean('tests')->default(false);
            $table->boolean('patient_tests')->default(false);
            $table->boolean('auditing')->default(false);
            $table->boolean('reports')->default(false);
            $table->boolean('announcements')->default(false);
            $table->boolean('job_applications')->default(false);
            $table->boolean('finance')->default(false);
            $table->boolean('human_resources')->default(false);
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
        Schema::dropIfExists('roles');
    }
};
