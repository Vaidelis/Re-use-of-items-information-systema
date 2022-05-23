<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Carbon\Carbon;

class CreateItemsAnnouncementTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items_announcements', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('price');
            $table->string('address');
            $table->string('information');
            $table->integer('change');
            $table->integer('hide')->default(0);
            $table->integer('aprooved')->default(0);
            $table->foreignId('user_id')->constrained();
            $table->foreignId('categorys_id')->constrained();
            $table->date('expiration')->default(Carbon::now()->addDays(30));
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
        Schema::dropIfExists('items_announcement');
    }
}
