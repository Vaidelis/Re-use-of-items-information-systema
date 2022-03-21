<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBoughtServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bought_services', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('name2')->nullable();
            $table->foreignId('services_announcement_id')->constrained();
            $table->foreignId('users_id')->constrained();
            $table->string('path')->nullable();
            $table->string('path2')->nullable();
            $table->integer('see')->default(0);
            $table->string('postname')->nullable();
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
        Schema::dropIfExists('bought_services');
    }
}
