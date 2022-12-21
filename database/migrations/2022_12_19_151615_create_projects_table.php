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
        Schema::create('projects', function (Blueprint $table) {
            $table->id('projectid')->unique();
            $table->string('studentid');
            $table->string('superviserid');
            $table->string('examinerid1');
            $table->string('examinerid2');
            $table->date('startdate')->nullable();
            $table->date('enddate')->nullable();
            $table->string('progress')->nullable();
            $table->integer('duration')->nullable();
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('projects');
    }
};
