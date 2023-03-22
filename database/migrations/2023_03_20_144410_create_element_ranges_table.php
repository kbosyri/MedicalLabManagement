<?php

use App\Models\Element;
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
        Schema::create('element_ranges', function (Blueprint $table) {
            $table->id();
            $table->set('gender',['m','f','n']);
            $table->foreignIdFor(Element::class,'element_id');
            $table->integer('from_age');
            $table->integer('to_age');
            $table->string('age_unit');
            $table->string('unit');
            $table->boolean('is_range');
            $table->boolean('is_affected_by_gender');
            $table->float('min_value');
            $table->float('max_value');
            $table->float('max_possible_value');
            $table->float('min_possible_value');
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
        Schema::dropIfExists('element_ranges');
    }
};
