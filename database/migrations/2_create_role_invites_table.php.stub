<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('role_invites', function (Blueprint $table) {
            $table->id();
            $table->string('email');
            $table->foreignId('role_id')->constrained()->onDelete('cascade');
            $table->foreignId('inviter_id')->constrained('users')->onDelete('cascade');
            $table->string('token');
            $table->tinyInteger('is_confirmed')->default(0);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('role_invites');
    }
};
