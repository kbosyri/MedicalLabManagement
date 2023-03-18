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
        Schema::create('patients', function (Blueprint $table) {
            $table->id();
            $table->string(column:'Fist_Name');
            $table->string(column:'Last_Name');
            $table->string(column:'Father_Name');
            $table->string(column:'Gender');
            $table->string('email')->nullable();
            $table->string('password');
            $table->string('phone')->nullable();
            $table->string(column:'Date_Of_Birth');
            $table->boolean('is_active')->default(true);
            $table->date(column: 'Deactivation_Date')->nullable();
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
        Schema::dropIfExists('patients');
    }
};
