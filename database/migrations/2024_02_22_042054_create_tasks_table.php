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
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->string('title', 255);
            $table->text('description');
            $table->string('sync_id',50)->nullable()->comment("Will be sync id from app");
            $table->date('start_date')->nullable();
            $table->date('due_date')->nullable();
            $table->enum('priority', ['low', 'medium','high'])->default('low');
            $table->enum('status', ['completed', 'incomplete','delete'])->default('incomplete');
            $table->foreignId('user_id')->constrained();
            $table->foreignId('updated_user_id')->nullable()->constrained('users');
            $table->foreignId('assignee_user_id')->nullable()->constrained('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
