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
        Schema::create('user_rights', function (Blueprint $table) {
            $table->id(); // Creates an 'id' column with auto-increment and primary key.
            $table->string('right_name', 45)->nullable(); // Equivalent of 'varchar(45) DEFAULT NULL'
            $table->string('right_display_name')->nullable(); // Equivalent of 'varchar(255) DEFAULT NULL'
            $table->unsignedInteger('right_group_id')->nullable(); // Equivalent of 'int(10) UNSIGNED DEFAULT NULL'
            $table->string('icon_class')->nullable(); // Equivalent of 'varchar(255) DEFAULT NULL'
            $table->boolean('is_deleted')->nullable(); // Equivalent of 'bit(1) DEFAULT NULL'
            $table->timestamps(); // Creates 'created_at' and 'updated_at' columns.

            $table->primary('id'); // Sets 'id' as the primary key
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('administrator_rights');
    }
};
