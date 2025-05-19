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
        Schema::table('videogames', function (Blueprint $table) {
            $table->dropColumn('pegi');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('videogames', function (Blueprint $table) {
            $table->integer('pegi')->nullable()->after('year_of_publication');
        });
    }
};
