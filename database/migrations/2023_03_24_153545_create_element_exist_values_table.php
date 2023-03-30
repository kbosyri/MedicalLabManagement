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
        Schema::create('element_exist_values', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Element::class,'element_id');
            $table->set('value',['p','a','pa']);
            $table->set('difference',['0','+1','+2','+3','+4']);
            $table->boolean('is_difference_affected')->default(false);
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
