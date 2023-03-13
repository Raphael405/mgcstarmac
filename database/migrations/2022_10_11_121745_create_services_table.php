<?php

use App\Models\services;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->foreignId('services_types_id')->constrained()->onDelete('cascade');
            $table->string('description');
            $table->integer('price');
            $table->string('location')->nullable();
            $table->timestamps();
        });

        services::create([
            'name' => "Jetskie/ 30 Min.",
            'services_types_id' => 1,
            'description' => "Rent jetskie for 30 Minutes",
            'price' => 1500,
        ]);
        services::create([
            'name' => "Jetskie/ 1 Hour",
            'services_types_id' => 1,
            'description' => "Rent jetskie for 1 hour",
            'price' => 2500,
        ]);
        services::create([
            'name' => "Kayak Single",
            'services_types_id' => 1,
            'description' => "Rent kayak single for 1 hour",
            'price' => 250,
        ]);
        services::create([
            'name' => "Basketpool",
            'services_types_id' => 1,
            'description' => "Rent basketpool for 1 hour",
            'price' => 100,
        ]);
        services::create([
            'name' => "Volleypool",
            'services_types_id' => 1,
            'description' => "Rent volleypool for 1 hour",
            'price' => 100,
        ]);
        services::create([
            'name' => "Chess Board Game",
            'services_types_id' => 1,
            'description' => "Rent chess board game for 1 hour",
            'price' => 100,
        ]);

        services::create([
            'name' => "Dart",
            'services_types_id' => 1,
            'description' => "Rent dart for 1 hour",
            'price' => 100,
        ]);
        services::create([
            'name' => "Family Standard Room/ 3PAX",
            'services_types_id' => 2,
            'description' => "Free breakfast for 2PAX/ per night",
            'price' => 2500,
        ]);
        services::create([
            'name' => "Barkadahan Roomm / 10PAX",
            'services_types_id' => 2,
            'description' => "Without free breakfast/ per night",
            'price' => 6500,
        ]);
        services::create([
            'name' => "Family Suite Room/ 2PAX",
            'services_types_id' => 2,
            'description' => "Free breakfast for 2/ per night",
            'price' => 2800,
        ]);
        services::create([
            'name' => "Exclusive Suite Room/ 2PAX",
            'services_types_id' => 2,
            'description' => "Free breakfast for 2PAX/ per night",
            'price' => 3000,
        ]);
        services::create([
            'name' => "Small Function Hall",
            'services_types_id' =>3,
            'description' => "Restaurant/Multi-purpose hall",
            'price' => 5000,
        ]);
        services::create([
            'name' => "Big Function Hall",
            'services_types_id' => 3,
            'description' => "Restaurant/Multi-purpose hall",
            'price' => 6000,
        ]);
        services::create([
            'name' => "Additional",
            'services_types_id' => 3,
            'description' => "Excess/hours",
            'price' => 1000,
        ]);
        services::create([
            'name' => "Cottage Carl ",
            'services_types_id' => 4,
            'description' => "Cottage Carl",
            'price' => 600,
        ]);
        services::create([
            'name' => "Cottage John ",
            'services_types_id' => 4,
            'description' => "Cottage John",
            'price' => 500,
        ]);
        services::create([
            'name' => "Cottage KC ",
            'services_types_id' => 4,
            'description' => "Cottage KC",
            'price' => 500,
        ]);
        services::create([
            'name' => "Cottage Jake ",
            'services_types_id' => 4,
            'description' => "Cottage Jake",
            'price' => 500,
        ]);
        services::create([
            'name' => "Cottage Kierson ",
            'services_types_id' => 4,
            'description' => "Cottage Kierson",
            'price' => 500,
        ]);
        services::create([
            'name' => "Cottage Kliezsa ",
            'services_types_id' => 4,
            'description' => "Cottage Kliezsa",
            'price' => 500,
        ]);
        services::create([
            'name' => "Big Cabana ",
            'services_types_id' => 4,
            'description' => "Big Cabana",
            'price' => 1000,
        ]);
        services::create([
            'name' => "Big Shed ",
            'services_types_id' => 4,
            'description' => "Big Shed",
            'price' => 1500,
        ]);
        services::create([
            'name' => "Board Walk",
            'services_types_id' => 4,
            'description' => "Board Walk",
            'price' => 300,
        ]);
        services::create([
            'name' => "Additional Table",
            'services_types_id' => 4,
            'description' => "Extra Table",
            'price' => 300,
            'location' => "Additional",
        ]);
        services::create([
            'name' => "Additional Person",
            'services_types_id' => 5,
            'description' => "Addition Person",
            'price' => 300,
            'location' => "Additional",
        ]);
        services::create([
            'name' => "Corkages - Lechon",
            'services_types_id' => 5,
            'description' => "Lechon excess corkage",
            'price' => 300,
            'location' => "Corkage",
        ]);
        services::create([
            'name' => "Drinks - /Bottle",
            'services_types_id' => 5,
            'description' => "Corkage Per Bottle",
            'price' => 10,
            'location' => "Corkage",
        ]);
        services::create([
            'name' => "Rice Cooker",
            'services_types_id' => 5,
            'description' => "Rice cooker corkage",
            'price' => 100,
            'location' => "Corkage",
        ]);
        services::create([
            'name' => "Sound System",
            'services_types_id' => 5,
            'description' => "Sound system cokage",
            'price' => 300,
            'location' => "Corkage",
        ]);
        services::create([
            'name' => "Day - Entrance / Adult",
            'services_types_id' => 7,
            'description' => "8:00 Am to 5:00 Pm",
            'price' => 80,
            'location' => "Entrance",
        ]);
        services::create([
            'name' => "Day - Entrance / Kid",
            'services_types_id' => 7,
            'description' => "8:00 Am to 5:00 Pm",
            'price' => 50,
            'location' => "Entrance",
        ]);
        services::create([
            'name' => "Night - Entrance / Adult",
            'services_types_id' =>7,
            'description' => "6:00 Pm to 10:00 Pm",
            'price' => 150,
            'location' => "Entrance",
        ]);
        services::create([
            'name' => "Night - Entrance / Kid",
            'services_types_id' => 7,
            'description' => "6:00 Pm to 10:00 Pm",
            'price' => 75,
            'location' => "Entrance",
        ]);

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('services');
    }
}
