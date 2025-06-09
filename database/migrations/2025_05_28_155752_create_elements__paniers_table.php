<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('elements_paniers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('paniers_id')->constrained('paniers')->onDelete('cascade');
            $table->foreignId('produits_id')->constrained('produits')->onDelete('cascade');
            $table->string('taille');
            $table->string('couleur');
            $table->unsignedInteger('quantite');
            $table->decimal('prix');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('elements__paniers');
    }
};
