<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHolidaysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('holidays', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->date('start');
            $table->date('end');
            $table->boolean('halfDay')->nullable();
            $table->float('daysTaken');
            $table->date('dateAuthorised')->nullable();
            $table->bigInteger('authorisedBy')->nullable();
            $table->boolean('pending')->default(false);
            $table->boolean('authorised')->default(false);
            $table->boolean('bankholiday')->default(false);
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
        Schema::dropIfExists('holidays');
    }
}
