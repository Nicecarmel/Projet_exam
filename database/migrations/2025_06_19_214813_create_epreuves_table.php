<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('epreuves', function (Blueprint $table) {
            // ID de l'épreuve
            $table->bigIncrements('id_ep');

            // Professeur qui a créé l’épreuve
            $table->unsignedBigInteger('professeur_id'); // Remplace user_id par professeur_id
            $table->foreign('professeur_id')
                  ->references('id_prof')
                  ->on('professeurs')
                  ->onDelete('cascade');

            // Filière et matière associées
            $table->unsignedBigInteger('filiere_id')->nullable();
            $table->foreign('filiere_id')
                  ->references('id_fil')
                  ->on('filieres')
                  ->onDelete('set null');

            $table->unsignedBigInteger('matiere_id')->nullable();
            $table->foreign('matiere_id')
                  ->references('id_mat')
                  ->on('matieres')
                  ->onDelete('set null');

            // Champs principaux
            $table->string('type_ep')->nullable(); // ex: QCM, Oral, Écrit...
            $table->string('titre');
            $table->text('description')->nullable();
            $table->date('date_ep')->nullable();
            $table->time('heure_debut')->nullable();
            $table->time('heure_fin')->nullable();
            $table->integer('duree_minutes')->nullable()->min(10)->max(300);
            $table->enum('statut_ep', ['brouillon', 'en_attente_validation', 'validee', 'refusee'])->default('brouillon');
            $table->boolean('mode_notation_auto')->default(false);

            // Admin qui a validé/refusé l’épreuve
            $table->unsignedBigInteger('admin_id')->nullable();
            $table->foreign('admin_id')
                  ->references('id_admin')
                  ->on('administrateurs')
                  ->onDelete('set null');

            // Timestamps
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('epreuves');
    }
};
