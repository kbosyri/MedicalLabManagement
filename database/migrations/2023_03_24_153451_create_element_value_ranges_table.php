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
        Schema::create('element_value_ranges', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Element::class,'element_id');
            $table->set('gender',['m','f','n']);
            $table->string('from_age')->nullable();
            $table->string('to_age')->nullable();
            $table->string('age_unit')->nullable();
            $table->string('min_value')->nullable();
            $table->string('max_value')->nullable();
            $table->string('value')->nullable();
            $table->string('unit')->nullable();
            $table->boolean('is_gender_affected')->default(false);
            $table->boolean('is_age_affected')->default(false);
            $table->boolean('is_range')->default(false);
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
        Schema::dropIfExists('element_value_ranges');
    }
};
