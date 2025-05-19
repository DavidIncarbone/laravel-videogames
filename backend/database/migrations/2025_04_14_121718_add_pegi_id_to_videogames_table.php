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
            $table->foreignId('pegi_id')->after('id')->constrained()->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('videogames', function (Blueprint $table) {
            $table->dropForeign(['pegi_id']);
            $table->dropColumn('pegi_id');
        });
    }
};
