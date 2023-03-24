<?php

use App\Models\CategoryElement;
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
        Schema::create('category_elements', function (Blueprint $table) {
            $table->id();
            $table->text('name');
            $table->text('arabic_name');
            $table->foreignIdFor(Element::class,'category_id')->nullable();
            $table->foreignIdFor(CategoryElement::class,'subcategory_id')->nullable();
            $table->string('symbol')->nullable();
            $table->boolean('is_value')->default(false);
            $table->boolean('is_exist')->default(false);
            $table->boolean('is_subcategory')->default(false);
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
        Schema::dropIfExists('category_elements');
    }
};
