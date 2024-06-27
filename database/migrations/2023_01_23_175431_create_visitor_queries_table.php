<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVisitorQueriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('visitor_queries', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('qid');
            $table->integer('academic_year_id')->unsigned();
            $table->string('name');
            $table->string('subject');
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->text('message');
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
        Schema::dropIfExists('visitor_queries');
    }
}
