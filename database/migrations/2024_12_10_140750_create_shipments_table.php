<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\User;
use App\Models\ShipmentReciver;
use App\Models\ShipmentSender;
return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('shipments', function (Blueprint $table) {
            $table->id();
            $table->string('trackNumber');
            $table->double('itemSize');
            $table->string('itemType');
            $table->foreignIdFor(User::class)->default(0); //! to attach shipment with user if exits
            $table->foreignIdFor(ShipmentReciver::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(ShipmentSender::class)->constrained()->cascadeOnDelete();
            $table->string('shipmentType');
            $table->boolean('collectMoney')->default(0)->comment('1 => yes , 0 =>no');
            $table->string('collectedPrice')->default(0);
            $table->integer('shipment_costs')->default(0);
            $table->integer('status')->default(0)->comment("0 => recived , 1 => prepared , 2 => in deliver , 3 =>deliverd , 4 => delayed , 5 =>cancelled , 6 => refund");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shipments');
    }
};
