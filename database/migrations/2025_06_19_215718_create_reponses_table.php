<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('reponses', function (Blueprint $table) {
            $table->bigIncrements('id_rep'); // Réponse ID auto-incrementé

            // Relations avec les tables custom
            $table->unsignedBigInteger('etudiant_id');
            $table->foreign('etudiant_id')
                  ->references('id_et')
                  ->on('etudiants')
                  ->onDelete('cascade');

            $table->unsignedBigInteger('question_id');
            $table->foreign('question_id')
                  ->references('id_ques')
                  ->on('questions')
                  ->onDelete('cascade');

            $table->unsignedBigInteger('option_id')->nullable();
            $table->foreign('option_id')
                  ->references('id_op')
                  ->on('options')
                  ->onDelete('set null');

            // Réponse textuelle pour questions ouvertes
            $table->text('reponse_text')->nullable();

            // Score obtenu par l’étudiant sur cette question
            $table->integer('point_obtenu')->nullable();

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('reponses');
    }
};
