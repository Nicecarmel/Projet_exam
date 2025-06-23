<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('composers', function (Blueprint $table) {
            $table->bigIncrements('id_compo'); // ID auto-incrémenté pour la composition

            // Relation avec l'étudiant
            $table->unsignedBigInteger('etudiant_id');
            $table->foreign('etudiant_id')
                  ->references('id_et')
                  ->on('etudiants')
                  ->onDelete('cascade');

            // Relation avec l’épreuve
            $table->unsignedBigInteger('epreuve_id');
            $table->foreign('epreuve_id')
                  ->references('id_ep')
                  ->on('epreuves')
                  ->onDelete('cascade');

            // Statut de la composition
            $table->enum('statut', ['non_commence', 'en_cours', 'termine', 'corrige'])->default('non_commence');

            // Horodatage du début/fin
            $table->timestamp('date_debut')->nullable();
            $table->timestamp('date_fin')->nullable();

            // Note finale (si notation automatique)
            $table->decimal('note', 5, 2)->nullable(); // ex: 16.75

            // Feedback global optionnel
            $table->text('feedback')->nullable();

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('composers');
    }
};
