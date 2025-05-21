<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomProductsTable extends Migration
{
    public function up()
{
    Schema::create('custom_products', function (Blueprint $table) {
        $table->id();
        $table->string('fullname'); // 👈 nom du client
        $table->enum('gender', ['homme', 'femme']); // 👈 genre
        $table->float('rating')->default(4.5); // note par défaut
        $table->string('image_path');
        $table->text('description')->nullable();
        $table->string('status')->default('pending'); // en attente d'approbation
        $table->timestamps();
    });
}


    public function down()
    {
        Schema::dropIfExists('custom_products');
    }
}
