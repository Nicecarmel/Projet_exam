<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('matieres', function (Blueprint $table) {
            $table->bigIncrements('id_mat');
            $table->string('libelle_mat');
            $table->string('code_mat')->unique();
            $table->boolean('obligatoire')->default(false);
            $table->unsignedBigInteger('filiere_id')->nullable();
            $table->foreign('filiere_id')->references('id_fil')->on('filieres')->onDelete('set null');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('matieres');
    }
};
