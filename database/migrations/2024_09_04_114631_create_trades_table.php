<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('trades', function (Blueprint $table) {
            $table->id();
            $table->timestamp('open_at')->nullable();
            $table->timestamp('closed_at')->nullable();
            $table->string('asset');
            $table->decimal('amount', 15, 2);
            $table->integer('qty');
            $table->decimal('pnl', 15, 2)->nullable();
            $table->decimal('opening_price', 15, 2);
            $table->decimal('current_price', 15, 2)->nullable();
            $table->enum('direction', ['buy', 'sell']);
            $table->enum('status', ['opening', 'closed', 'pending']);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('trades');
    }

};
