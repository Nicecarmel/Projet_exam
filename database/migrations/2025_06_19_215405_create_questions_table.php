<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('questions', function (Blueprint $table) {
           $table->bigIncrements('id_ques');
            $table->unsignedBigInteger('epreuve_id');
            $table->foreign('epreuve_id')->references('id_ep')->on('epreuves')->onDelete('cascade');

            $table->text('libelle_quest');
            $table->enum('type', ['qcm', 'qroc', 'vrai_faux', 'ouverte'])->default('qcm');
            $table->integer('point')->default(1);
            $table->integer('ordre')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('questions');
    }
};
