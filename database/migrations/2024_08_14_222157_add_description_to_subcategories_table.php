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
        Schema::table('subcategories', function (Blueprint $table) {
            $table->text('description')->nullable();  // Agrega una columna text nullable
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('subcategories', function (Blueprint $table) {
            $table->dropColumn('description');
        });
    }

    
};
