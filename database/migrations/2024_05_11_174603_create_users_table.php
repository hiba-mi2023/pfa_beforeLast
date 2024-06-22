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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('family_name');
            $table->string('email', 50)->unique();
            $table->string('password');
            $table->rememberToken();
            $table->string('university')->nullable(); // New column for university
            $table->string('study_field')->nullable(); // New column for study field
            $table->string('study_level')->nullable(); // New column for study level
            //$table->string('coordinates')->nullable(); // New column for coordinates
            $table->string('photo_de_profil')->nullable();
            $table->string('phone')->nullable();
            //$table->string('pays')->nullable();
            //$table->string('city')->nullable();
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
        Schema::dropIfExists('users');
    }
};
