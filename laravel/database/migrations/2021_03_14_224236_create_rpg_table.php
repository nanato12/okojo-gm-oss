<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRpgTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rpg', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('uid', 33)->unique();
            $table->text('player_name')->nullable();
            $table->text('player_id')->nullable();
            $table->integer('level')->default(1);
            $table->integer('exp')->default(0);
            $table->integer('point')->default(20000);
            $table->integer('individual')->default(1);
            $table->text('type')->nullable();
            $table->text('item')->nullable();
            $table->text('party')->nullable();
            $table->text('party_request')->nullable();
            $table->integer('point_update')->default(0);
            $table->integer('exp_update')->default(0);
            $table->integer('item_limit_count')->default(7);
            $table->integer('coin')->default(0);
            $table->timestamp('last_login')->nullable();
            $table->integer('total_login_count')->default(0);
            $table->integer('continuous_login_count')->default(0);
            $table->text('same_skill_1')->nullable();
            $table->text('same_skill_2')->nullable();
            $table->text('same_skill_3')->nullable();
            $table->text('same_skill_4')->nullable();
            $table->text('free_skill_1')->nullable();
            $table->text('free_skill_2')->nullable();
            $table->text('free_skill_3')->nullable();
            $table->text('free_skill_4')->nullable();
            $table->timestamp('limit_exp_boost')->nullable();
            $table->timestamp('limit_point_boost')->nullable();
            $table->integer('bp_level')->default(1);
            $table->integer('bp_point')->default(0);
            $table->string('bp_type')->default('normal');
            $table->integer('rate')->default(3000);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rpg');
    }
}
