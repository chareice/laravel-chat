<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChatTables extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('chat_sessions', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
        });

        Schema::create('chat_participants', function (Blueprint $table) {
            $table->foreignId('session_id')->constrained('chat_sessions', 'id');
            $table->morphs('chatable');
        });

        Schema::create('chat_messages', function (Blueprint $table) {
            $table->increments('id');
            $table->foreignId('session_id')->constrained('chat_sessions', 'id');
            $table->morphs('receiverable');
            $table->morphs('senderable');
            $table->string('type');
            $table->text('content');
            $table->dateTime('read_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::drop('chat_messages');
        Schema::drop('chat_sessions');
        Schema::drop('chat_participants');
    }
}