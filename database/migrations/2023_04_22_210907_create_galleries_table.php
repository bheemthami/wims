<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGalleriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('galleries', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug');
            $table->enum('type',['image'=>'image','video'=>'video'])->default('image');
            $table->text('summary')->nullable();
            $table->text('link')->nullable();
            $table->integer('academic_year_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->date('date');
            $table->boolean('status')->default(0);
            $table->boolean('is_slider')->default(0);
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
        Schema::dropIfExists('galleries');
    }
}
