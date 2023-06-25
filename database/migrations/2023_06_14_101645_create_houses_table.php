<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('houses', function (Blueprint $table) {
            $table->id();
            $table->integer('living_rooms');
            $table->integer('bedrooms');
            $table->integer('bathrooms');
            $table->timestamps();
        });


        $user = User::find(1); // Assuming you have a User model and retrieve a user from the database

        $adminRole = Role::findByName('admin'); // Retrieve the admin role by name

        $user->assignRole($adminRole); // Assign the admin role to the user

    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('houses');
    }
};
