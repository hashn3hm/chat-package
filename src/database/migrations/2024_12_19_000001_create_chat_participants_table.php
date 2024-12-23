<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChatParticipantsTable extends Migration
{
    public function up()
    {
        Schema::create('chat_participants', function (Blueprint $table) {
            $table->id();
            $table->foreignId('chat_id')->constrained()->onDelete('cascade'); // Links to chats table
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Links to users table
            $table->string('role')->default('member'); // Role: admin, moderator, member
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('chat_participants');
    }
}
