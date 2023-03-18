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
        if(!Schema::hasColumn('staff','email'))
        {
            Schema::table('staff',function(Blueprint $table){
                $table->string('email')->nullable();
                
            });
        }

        if(!Schema::hasColumn('staff','phone'))
        {
            Schema::table('staff',function(Blueprint $table){
                $table->string('phone')->nullable();
                
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
        Schema::table('staff', function (Blueprint $table) {
            $table->dropColumn('email');
            $table->dropColumn('phone');
        });
    }
};
