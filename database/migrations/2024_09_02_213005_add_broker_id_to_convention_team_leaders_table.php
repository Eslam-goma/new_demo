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
        Schema::table('convention_team_leaders', function (Blueprint $table) {
            $table->foreignId('broker_id')->nullable()->constrained()->onDelete('cascade');
                });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('convention_team_leaders', function (Blueprint $table) {
            $table->dropForeign(['broker_id']);
            $table->dropColumn('broker_id');
        });
    }
};
