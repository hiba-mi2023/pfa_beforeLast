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
        Schema::create('notes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('topic_id');
            $table->string('title');
            $table->text('description');
            $table->string('keywords')->nullable();
            $table->string('photo')->nullable();
            $table->dateTime('published_at');
            $table->timestamps();

            // Define the foreign key constraint
            $table->foreign('topic_id')->references('id')->on('topics')->onDelete('cascade');
            $table->unsignedBigInteger('ID_utilisateur')->nullable();

            // Define foreign key constraint
            $table->foreign('ID_utilisateur')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('notes');
        Schema::table('notes', function (Blueprint $table) {
            $table->dropForeign(['ID_utilisateur']);
            $table->dropColumn('ID_utilisateur');
        });
    }
};
