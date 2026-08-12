<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('testimonials', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('role_or_company')->nullable(); // misal: "Pelanggan Setia" atau "CEO PT ABC"
            $table->string('avatar')->nullable();
            $table->text('message');
            $table->unsignedTinyInteger('rating')->default(5); // 1 - 5 Bintang
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('testimonials');
    }
};