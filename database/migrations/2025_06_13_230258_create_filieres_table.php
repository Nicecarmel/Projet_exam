<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('filieres', function (Blueprint $table) {
            $table->bigIncrements('id_fil');
            $table->string('libelle_fil');
            $table->string('code_fil')->unique();
            $table->integer('effectif')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('filieres');
    }
};
