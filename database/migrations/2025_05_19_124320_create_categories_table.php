<?php

// database/migrations/xxxx_xx_xx_create_categories_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('category_name')->unique(); // Nom de la catégorie
            $table->string('slug')->nullable();
            $table->timestamps();
        });
    }

    public function down() {
        Schema::dropIfExists('categories');
    }
};
