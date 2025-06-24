<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('reponses', function (Blueprint $table) {
            $table->unsignedBigInteger('epreuve_id')->nullable()->after('etudiant_id'); // position facultative
            $table->foreign('epreuve_id')
                  ->references('id_ep')
                  ->on('epreuves')
                  ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::table('reponses', function (Blueprint $table) {
            $table->dropForeign(['epreuve_id']);
            $table->dropColumn('epreuve_id');
        });
    }
};
