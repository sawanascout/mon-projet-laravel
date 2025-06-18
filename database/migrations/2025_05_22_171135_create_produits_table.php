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
      Schema::create('produits', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->decimal('prix', 8, 2);
            $table->decimal('ancien_prix',8,2)->nullable();
            $table->text('description')->nullable();
            $table->foreignId('category_id')->constrained('categories');
            $table->string('photo')->nullable(); // chemin vers la photo
            $table->boolean('disponible')->default(true)->nullable();
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
        Schema::dropIfExists('produits');
    }
};
