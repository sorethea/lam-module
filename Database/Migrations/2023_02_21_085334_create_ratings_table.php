<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ratings', function (Blueprint $table) {
            $table->id();
            $table->integer('rating');
            $table->string('title')->nullable();
            $table->string('body')->nullable();
            $table->morphs('rateable');
            $table->morphs('reviewer');
            $table->text('properties')->nullable();
            $table->string('criteria')->nullable();
            $table->enum('status', ['approved', 'disapproved', 'spam', 'pending'])->default('approved');
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
        Schema::dropIfExists('ratings');
    }
};
