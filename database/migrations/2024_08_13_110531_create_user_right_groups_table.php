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
        Schema::create('user_right_groups', function (Blueprint $table) {
            $table->id();
            $table->string('group_name');
            $table->string('icon_class')->nullable();
            $table->string('href')->nullable();
            $table->integer('ordering');
            $table->boolean('is_deleted')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_right_groups');
    }
};
