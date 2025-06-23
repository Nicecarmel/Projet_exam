<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('administrateurs', function (Blueprint $table) {
            $table->bigIncrements('id_admin');
            $table->string('email_admin')->unique();
            $table->string('mdp_admin'); // Tu peux renommer 'mdp_admin' → 'password'
            $table->rememberToken();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('administrateurs');
    }
};
