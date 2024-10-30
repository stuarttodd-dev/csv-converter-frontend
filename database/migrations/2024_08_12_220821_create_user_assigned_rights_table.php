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
        Schema::create('user_assigned_rights', function (Blueprint $table) {
            $table->id(); // Creates an 'id' column with auto-increment and primary key.
            $table->unsignedInteger('right_id')->nullable(); // Equivalent of 'int(11) DEFAULT NULL'
            $table->unsignedInteger('user_id')->nullable(); // Equivalent of 'int(11) DEFAULT NULL'
            $table->boolean('is_deleted')->default(0); // Equivalent of 'bit(1) DEFAULT NULL'
            $table->timestamps(); // Creates 'created_at' and 'updated_at' columns.

            $table->primary('id'); // Sets 'id' as the primary key
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('administrator_assigned_rights');
    }
};
