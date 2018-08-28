<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned()->index();
            $table->string('event_name')->index();
            $table->string('event_prefecture')->index();
            $table->string('event_venue')->index();
            $table->date('event_date')->index();
            $table->time('event_starttime')->index();
            $table->string('event_artist')->index();
            $table->string('event_imageUrl')->index()->nullable();
            $table->string('event_remarks')->index()->nullable();
            $table->timestamps();
            
            // 外部キー設定
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('events');
    }
}
