<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('options', function (Blueprint $table) {
            $table->bigIncrements('id_op');
            $table->unsignedBigInteger('question_id');
            $table->foreign('question_id')->references('id_ques')->on('questions')->onDelete('cascade');

            $table->text('libelle_op');
            $table->boolean('correct')->default(false);
            $table->integer('ordre')->nullable(); // Champ ordre ajouté ici

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('options');
    }
};
