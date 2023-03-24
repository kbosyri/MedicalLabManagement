<?php

use App\Models\CategoryElement;
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
        Schema::create('category_element_exist_value.phps', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(CategoryElement::class,'element_id');
            $table->boolean('value');
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
        Schema::dropIfExists('category_element_exist_value.phps');
    }
};
