<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('professeurs', function (Blueprint $table) {
             $table->bigIncrements('id_prof');
            $table->string('nom_prof');
            $table->string('prenom_prof');
            $table->string('email_prof')->unique();
            $table->string('tel_prof')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('professeurs');
    }
};
