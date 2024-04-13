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
        Schema::create('profile', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('address_id')->nullable()->constrained()->unsigned();
            $table->foreign('address_id')->references('id')->on('user_role')->onDelete('cascade')->onUpdate('cascade');
            $table->date('dob');
            $table->string('gender');
            $table->string('phone_number');
            $table->string('religion');
            $table->integer('current_exp');
            $table->string('badge_name');
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
        Schema::dropIfExists('profile');
    }
};
