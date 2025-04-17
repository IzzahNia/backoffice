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
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Event name
            $table->text('description')->nullable(); // Event description
            $table->dateTime('start_time'); // Event start datetime
            $table->dateTime('end_time'); // Event end datetime
            $table->string('location'); // Event location (address)
            $table->boolean('is_verified')->default(false); // Verification status
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // User who created the event
            $table->softDeletes(); // Soft delete column
            $table->timestamps(); // Created at and updated at timestamps
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
