<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('etudiants', function (Blueprint $table) {
            $table->bigIncrements('id_et');
            $table->string('nom_et');
            $table->string('prenom_et');
            $table->string('email_et')->unique();
            $table->string('sexe')->nullable();
            $table->string('tel_et')->nullable();
            $table->string('num_mat')->unique(); // Matricule étudiant
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('etudiants');
    }
};
