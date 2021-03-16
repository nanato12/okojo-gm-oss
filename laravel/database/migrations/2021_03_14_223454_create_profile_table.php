<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfileTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profile', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('uid', 33)->unique();
            $table->text('display_name')->nullable();
            $table->text('picture_url')->nullable();
            $table->text('status_message')->nullable();
            $table->text('lang')->nullable();
            $table->boolean('is_registered')->default(false);
            $table->integer('donation')->default(0);
            $table->text('last_word')->nullable();
            $table->text('regulation_words')->nullable();
            $table->timestamp('regulation_timestamp')->nullable();
            $table->text('invite_code')->nullable();
            $table->text('used_invite_code')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('profile');
    }
}
