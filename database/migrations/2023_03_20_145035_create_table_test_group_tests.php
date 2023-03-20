<?php

use App\Models\Test;
use App\Models\TestsGroup;
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
        Schema::create('table_test_group_tests', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(TestsGroup::class,'tests_group_id');
            $table->foreignIdFor(Test::class,'test_id');
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
        Schema::dropIfExists('table_test_group_tests');
    }
};
