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
        Schema::create('user_addresses', function (Blueprint $table) {
            $table->id();
            $table->text('street');
            $table->foreignId('user_id')->constrained()->cascadeOnDelete(); //to attach with table of users;
            $table->foreignId('city_id')->constrained('cities')->cascadeOnDelete(); //to attach with table of cities;
            $table->string('bulid_Number')->nullable();
            $table->string('appartement')->nullable();
            $table->string('floor')->nullable();
            $table->string('secondPhone')->nullable();
            $table->integer('postCode')->nullable();
            $table->boolean('isMain')->default(0)->comment('0 => no , 1=>yes');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_addresses');
    }
};
