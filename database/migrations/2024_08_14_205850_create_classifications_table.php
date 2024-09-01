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
        Schema::create('classifications', function (Blueprint $table) {
            $table->id(); // Crée une colonne 'id' de type unsignedBigInteger avec auto-incrémentation
            $table->string('name'); // Crée une colonne 'name' pour le nom de la classification

            // Crée une colonne 'parent_id' qui est une clé étrangère auto-référencée sur la même table 'classifications'
            // Si 'parent_id' est NULL, cela signifie que c'est une classification de niveau supérieur
            $table->foreignId('parent_id')
                  ->nullable()
                  ->constrained('classifications')
                  ->onDelete('cascade');

            $table->timestamps(); // Crée les colonnes 'created_at' et 'updated_at'
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('classifications'); // Supprime la table 'classifications' si elle existe
    }
};
