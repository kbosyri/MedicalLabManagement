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
        Schema::create('element_exist_values', function (Blueprint $table) {
            $table->id();
            $table->set('gender',['m','f','n']);
            $table->foreignIdFor(Element::class,'element_id');
            $table->integer('from_age');
            $table->integer('to_age');
            $table->string('age_unit');
            $table->boolean('is_affected_by_gender');
            $table->set('result',['p','a','pa']);
            $table->set('limit',['0','+1','+2','+3','+4']);
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
        Schema::dropIfExists('element_exist_values');
    }
};
