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
        if(!Schema::hasColumn('tests','overview'))
        {
            Schema::table('tests', function (Blueprint $table) {
                $table->longText('overview');
            });
        }
        if(!Schema::hasColumn('tests','preconditions'))
        {
            Schema::table('tests', function (Blueprint $table) {
                $table->longText('preconditions');
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tests', function (Blueprint $table) {
            $table->dropColumn('overview');
            $table->dropColumn('preconditions');
        });
    }
};
