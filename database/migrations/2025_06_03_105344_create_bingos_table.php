<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('bingos', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->boolean('has_ended')->default(false);
            $table->boolean('has_started')->default(false);
            $table->timestamps();
        });
    }
};
