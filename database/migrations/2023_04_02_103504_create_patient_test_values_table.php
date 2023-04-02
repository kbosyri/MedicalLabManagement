<?php

use App\Models\CategoryElement;
use App\Models\Patienttest;
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
        Schema::create('patient_test_values', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Patienttest::class,'patient_test_id');
            $table->foreignIdFor(Element::class,'element_id')->nullable();
            $table->foreignIdFor(CategoryElement::class,'category_element_id')->nullable();
            $table->string('value');
            $table->boolean('is_category_element')->default(false);
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
        Schema::dropIfExists('patient_test_values');
    }
};
