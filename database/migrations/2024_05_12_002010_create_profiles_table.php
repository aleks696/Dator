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
        Schema::create('profiles', function (Blueprint $table) {
            $table->id();
            $table->binary('image')->nullable();
            $table->bigInteger('user_id')->unsigned();
            $table->integer("age");
            $table->string("gender");
            $table->string("city");
            $table->string("about_info");
            $table->text("hobbies");
            $table->dateTime("created_at");
            $table->dateTime("updated_at");

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profiles');
    }
};
