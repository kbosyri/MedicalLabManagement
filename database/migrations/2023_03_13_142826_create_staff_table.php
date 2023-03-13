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
        Schema::create('staff', function (Blueprint $table) {
            $table->id();
            $table->integer('biometric_id', $unsigned = true)->nullable();
            $table->string('first_name');
            $table->string('father_name');
            $table->string('last_name');
            $table->string('username')->unique();
            $table->string('password');
            $table->boolean('is_admin')->default(false);
            $table->boolean('is_lab_staff')->default(false);
            $table->boolean('is_reception')->default(false);
            $table->boolean('is_active')->default(true);
            $table->rememberToken();
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
        Schema::dropIfExists('staff');
    }
};
