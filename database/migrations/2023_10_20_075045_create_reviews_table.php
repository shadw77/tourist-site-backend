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
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            $table->text('comment');
            $table->foreignId('user_id')->constrained('users')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('restaurant_id')->constrained('restaurants')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('hotel_id')->constrained('hotels')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('trip_id')->constrained('trips')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('destination_id')->constrained('destinations')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('reviews');
    }
};
