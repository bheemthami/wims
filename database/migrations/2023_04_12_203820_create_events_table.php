<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug');
            $table->longtext('description')->nullable();
            $table->string('image')->nullable();
            $table->string('attachment')->nullable();
            $table->boolean('status')->default(0);
            $table->date('start_date');
            $table->date('end_date');
            $table->text('start_time');
            $table->text('end_time');
            $table->string('speaker')->nullable();
            $table->string('remarks')->nullable();
            $table->integer('academic_year_id')->unsigned();
            $table->integer('user_id')->unsigned();
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
        Schema::dropIfExists('events');
    }
}
