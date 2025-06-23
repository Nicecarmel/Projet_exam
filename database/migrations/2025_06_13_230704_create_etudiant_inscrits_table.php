<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('etudiant_inscrits', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            $table->unsignedBigInteger('filiere_id');
            $table->foreign('filiere_id')->references('id_fil')->on('filieres')->onDelete('cascade');

            $table->unsignedBigInteger('annee_id');
            $table->foreign('annee_id')->references('id_annee')->on('annees')->onDelete('cascade');

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('etudiant_inscrits');
    }
};
