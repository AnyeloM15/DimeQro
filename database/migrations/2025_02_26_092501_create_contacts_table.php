<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('contacts', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('contact'); // Puede ser email o teléfono
            $table->text('message');
            $table->boolean('subscribed')->default(false); // Suscripción al newsletter
            $table->enum('status', ['pendiente', 'atendido'])->default('pendiente'); // Estado del mensaje
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('contacts');
    }
};
