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
        Schema::create('exp_setting', function (Blueprint $table) {
            $table->id();
            $table->integer('exp_bronze');
            $table->integer('exp_silver');
            $table->integer('exp_gold');
            $table->integer('exp_purple');
            $table->integer('exp_emerald');
            $table->integer('do_quest');
            $table->integer('do_asg');
            $table->integer('do_exam');
            $table->integer('do_project');
            $table->integer('create_task');
            $table->integer('create_question');
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
        Schema::dropIfExists('exp_setting');
    }
};
