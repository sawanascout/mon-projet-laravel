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
        Schema::create('ligne_commandes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('commandes_id')->constrained('commandes')->onDelete('cascade');
            $table->foreignId('produits_id')->constrained('produits');
            $table->string('couleur')->nullable();
            $table->string('taille')->nullable();
            $table->unsignedInteger('quantite');
            $table->decimal('unit_price', 10, 2);
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
        Schema::dropIfExists('ligne__commandes');
    }
};
