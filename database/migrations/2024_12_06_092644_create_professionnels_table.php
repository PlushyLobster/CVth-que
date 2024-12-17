<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('professionnels', function (Blueprint $table) {
            $table->bigIncrements('id')->comment('Identifiant professionnel');
            $table->string('prenom', 25)->comment('Prénom du professionnel');
            $table->string('nom', 40)->comment('Nom du professionnel');
            $table->string('cp', 5)->comment('Code postal');
            $table->string('ville', 38)->comment('Ville');
            $table->string('telephone', 14)->comment('Téléphone fixe ou portable');
            $table->string('email', 255)->unique()->comment('Adresse email');
            $table->date('naissance')->comment('Date de naissance du professionnel');
            $table->boolean('formation')->comment('Action de formation déjà effectuée OUI / NON');
            $table->set('domaine', ['S','R','D'])->comment('Domaine d\'activité : S = Système, R = Réseau, D = Developpement');
            $table->string("source", 255)->nullable()->comment('Source du profil (réseaux, organisme partenaire, presse, ...)');
            $table->text("observation", 255)->nullable()->comment('Observation / Commentaire');
            $table->timestamps();
            $table->unsignedBigInteger('metier_id')->referenves('id')->on('metiers');
            $table->foreign('metier_id')->references('id')->on('metiers')->onDelete('restrict')->onUpdate('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('professionnels');
    }
};
