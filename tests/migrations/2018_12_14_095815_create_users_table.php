<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('avatar');
            $table->timestamps();
        });

        Schema::create('chat_messages', function (Blueprint $table) {
            $table->increments('id');
            $table->morphs('receiverable');
            $table->morphs('senderable');
            $table->string('type');
            $table->text('content');
            $table->dateTime('read_at')->nullable();
            $table->timestamps();
        });

        Schema::create('chat_sessions', function (Blueprint $table) {
            $table->increments('id');
            $table->morphs('ownerable');
            $table->morphs('targetable');
            $table->unsignedInteger('unread_count')->default(0);
            $table->string('message_preview');
            $table->dateTime('last_message_at');
            $table->timestamps();
        });

        Schema::create('chat_sessions_messages', function (Blueprint $table) {
            $table->foreignId('session_id')->constrained('chat_sessions');
            $table->foreignId('message_id')->constrained('chat_messages');

            $table->primary(['session_id', 'message_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::drop('users');
        Schema::drop('chat_messages');
        Schema::drop('chat_sessions');
        Schema::drop('chat_sessions_messages');
    }
}