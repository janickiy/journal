<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJournalTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('journal', function (Blueprint $table) {
            $table->increments('id');
            $table->boolean('less30min');
            $table->integer('area_id')->index('area_id');
            $table->integer('equipment_id')->index('equipment_id');
            $table->string('disrepair_description')->nullable();
            $table->boolean('continues_used');
            $table->string('manufacture_member');
            $table->timestamp('time_fixed');
            $table->string('service_member');
            $table->string('work_comment')->nullable();
            $table->integer('worktypes_id');
            $table->text('master_comment')->nullable();
            $table->text('service_comment')->nullable();
            $table->boolean('status')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('journal');
    }
}
