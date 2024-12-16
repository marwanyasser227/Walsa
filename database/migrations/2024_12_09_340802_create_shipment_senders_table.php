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
        Schema::create('shipment_senders', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email');
            $table->string('phone');
            $table->string('secondPhone')->nullable();
            $table->foreignId('city_id')->constrained('cities')->cascadeOnDelete();
            $table->string('bulid_Number')->nullable();
            $table->string('appartement')->nullable();
            $table->string('floor')->nullable();
            $table->string('street')->nullable();
            $table->integer('postCode')->nullable();
            $table->boolean('createAccount')->default(0)->comment('0 => no , 1 => yes');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shipment_senders');
    }
};
