<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('events', function (Blueprint $table) {
            $table->increments('id')->change();
            $table->dropIndex('events_event_name_index');
            $table->dropIndex('events_event_prefecture_index');
            $table->dropIndex('events_event_venue_index');
            $table->dropIndex('events_event_date_index');
            $table->dropIndex('events_event_starttime_index');
            $table->dropIndex('events_event_artist_index');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('events', function (Blueprint $table) {
            //
        });
    }
}
