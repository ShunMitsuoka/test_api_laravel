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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name')->comment('氏名');
            $table->date('birth')->comment('生年月日');
            $table->string('company')->comment('会社名');
            $table->string('department')->comment('所属名');
            $table->string('hobby')->comment('趣味');
            $table->string('recommended_restaurant')->comment('おすすめのレストラン');
            $table->string('favorite_place')->comment('好きな場所');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
