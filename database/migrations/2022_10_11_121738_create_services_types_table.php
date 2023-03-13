<?php

use App\Models\services_type;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServicesTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('services_types', function (Blueprint $table) {
            $table->id();
            $table->string('service_type');
            $table->timestamps();
        });

        services_type::create([
            'service_type'=> "Activities"
        ]);
        services_type::create([
            'service_type'=> "Amenities"
        ]);

        services_type::create([
            'service_type'=> "Functions"
        ]);

        services_type::create([
            'service_type'=> "Cottages"
        ]);

        services_type::create([
            'service_type'=> "Packages"
        ]);

        services_type::create([
            'service_type'=> "Foods"
        ]);
        services_type::create([
            'service_type'=> "Entrance"
        ]);


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('services_types');
    }
}
