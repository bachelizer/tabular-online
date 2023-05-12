<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('sub_event_scores', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('event_id');
            $table->unsignedInteger('sub_event_id');
            $table->unsignedInteger('participant_id');
            $table->unsignedInteger('sub_criteria_id');
            $table->unsignedInteger('user_id')->comment('given by judges');
            $table->decimal('score')->comment('raw score 1-100');
            $table->timestamps();

            $table->foreign('participant_id')->references('id')->on('participants')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('sub_criteria_id')->references('id')->on('sub_event_criterias')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('event_id')->references('id')->on('events')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('sub_event_id')->references('id')->on('sub_events')->onDelete('restrict')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
};
