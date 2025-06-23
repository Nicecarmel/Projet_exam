<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('annees', function (Blueprint $table) {
            $table->bigIncrements('id_annee');
            $table->string('libelle_annee')->unique(); // Ex: "2024-2025"
            $table->boolean('est_actuelle')->default(false);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('annees');
    }
};
