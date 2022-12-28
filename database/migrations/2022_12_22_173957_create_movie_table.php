<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('movie', function (Blueprint $table) {
            $table->string('title');
            $table->date('release_date');
            $table->text('overview')->nullable();
            $table->string('poster_url')->nullable();
            $table->unsignedBigInteger('tmdb_id')->primary();
            $table->float('tmdb_vote_average');
            $table->integer('tmdb_vote_count');
            $table->string('tmdb_url');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('movie');
    }
};
