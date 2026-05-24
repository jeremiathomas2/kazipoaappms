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
        Schema::create('professionals', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('service');
            $table->string('region');
            $table->decimal('rating', 3, 2)->default(0);
            $table->integer('jobs_count')->default(0);
            $table->boolean('is_verified')->default(false);
            $table->string('avatar_color')->nullable();
            $table->string('status')->default('available'); // available, in_session, starting_soon
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('professionals');
    }
};
