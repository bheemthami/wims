<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrainingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trainings', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug');
            $table->text('summary')->nullable();
            $table->text('description');
            $table->string('image')->nullable();
            $table->string('attachment')->nullable();
            $table->integer('order');
            $table->boolean('status')->default(0);
            $table->string('quota');
            $table->string('duration');
            $table->string('eligibility');
            $table->unsignedBigInteger('training_type_id');
            $table->unsignedBigInteger('training_category_id');
            $table->foreign('training_type_id')->references('id')->on('training_types')->onDelete('cascade');
            $table->foreign('training_category_id')->references('id')->on('training_categories')->onDelete('cascade');
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
        Schema::dropIfExists('trainings');
    }
}
