<?php

use App\Models\user_type;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_types', function (Blueprint $table) {
            $table->id();
            $table->string('user_type');
            $table->timestamps();
        });
        user_type::create([
            'user_type' => 'admin'
        ]);
        user_type::create([
            'user_type' => 'staff'
        ]);
        user_type::create([
            'user_type' => 'customer'
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_types');
    }
}
