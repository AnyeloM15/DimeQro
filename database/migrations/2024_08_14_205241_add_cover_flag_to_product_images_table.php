<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('product_images', function (Blueprint $table) {
            $table->boolean('is_cover')->default(false); // Por defecto, se considera que no es la imagen de portada
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('product_images', function (Blueprint $table) {
            $table->dropColumn('is_cover');
        });
    }
    
};
