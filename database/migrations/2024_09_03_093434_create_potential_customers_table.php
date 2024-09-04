<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePotentialCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('potential_customers', function (Blueprint $table) {
            $table->id();
            $table->string('email')->unique();
            $table->string('name');
            $table->string('country');
            $table->string('phone');
            $table->foreignId('broker_id')->constrained()->onDelete('cascade');
            $table->enum('status', [
                'no_answer',
                'call_back',
                'new',
                'interested',
                'no_interested',
                'busy',
                'wrong_number'
            ])->default('new');
            $table->foreignId('agent_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('potential_customers');
    }
}

