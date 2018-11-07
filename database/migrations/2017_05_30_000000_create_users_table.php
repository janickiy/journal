<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('role_id')->default(1);
            $table->string('name');
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('password', 60)->nullable();
            $table->string('avatar', 255)->nullable()->default(NULL);
            $table->string('provider')->nullable();
            $table->string('provider_id')->nullable();
            $table->boolean('notifyDetectedFault')->default(0);
            $table->boolean('notifyFaultFix')->default(0);
            $table->integer('area_id')->index('area_id')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
