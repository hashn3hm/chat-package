<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChatsTable extends Migration
{
    public function up()
    {
        Schema::create('chats', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable(); // Group chat name
            $table->boolean('is_group')->default(false); // False = Single Chat, True = Group Chat
            $table->foreignId('created_by')->nullable()->constrained('users')->onDelete('set null'); // Admin/Creator of the group
            $table->text('group_description')->nullable(); // Metadata for the group
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('chats');
    }
}
