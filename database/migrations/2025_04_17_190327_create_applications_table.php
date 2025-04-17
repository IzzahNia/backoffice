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
        Schema::create('applications', function (Blueprint $table) {
            $table->id();
            $table->string('title'); // Application title
            $table->text('description')->nullable(); // Application description
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // User who submitted the application
            $table->foreignId('event_id')->nullable()->constrained()->onDelete('cascade'); // Event the application is tied to
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending'); // Application status
            $table->timestamps(); // Created at and updated at timestamps
            $table->softDeletes(); // Soft delete column
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('applications');
    }
};
