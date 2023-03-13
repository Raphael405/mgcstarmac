<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('username')->nullable();
            $table->string('password')->nullable();
            $table->foreignId('user_types_id')->constrained()->onDelete('cascade');
            $table->string('lname')->nullable();
            $table->string('fname')->nullable();
            $table->string('mname')->nullable();
            $table->string('valid_id')->nullable();
            $table->string('contact_number')->nullable();
            $table->string('email')->nullable();
            $table->string('address')->nullable();
            $table->string('verified')->nullable();
            $table->timestamps();
        });

        User::create([
            'username' => "admin",
            'password' => Hash::make("admin"),
            'user_types_id' => 1,
            'verified' => 'Verified',
            'fname' => 'Ralph',
            'mname' => 'Plando',
            'lname' => 'Padere',
            'address' => 'Carmen CDO',
            'contact_number' => '09062456879',
            'email' => 'rpadere@gmail.com',
            'valid_id' => 'uploads/user.png',
        ]);
        User::create([
            'username' => "frontdesk",
            'password' => Hash::make("frontdesk"),
            'user_types_id' => 2,
            'verified' => 'Verified',
            'fname' => 'Romel John',
            'mname' => 'P.',
            'lname' => 'Salvaleon',
            'address' => 'Balulang',
            'contact_number' => '09057134567',
            'email' => 'rsalvaleon@gmail.com',
            'valid_id' => 'uploads/user.png',
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
