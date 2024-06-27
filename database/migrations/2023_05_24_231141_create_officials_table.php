<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOfficialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('officials', function (Blueprint $table) {
            $table->id();

            $table->string('first_name');
            $table->string('middle_name')->nullable();
            $table->string('last_name');
            $table->string('district');
            $table->integer('local_level_type_id')->unsigned();
            $table->integer('academic_year_id')->unsigned();
            $table->unsignedBigInteger('department_id');
            $table->integer('designation_id')->unsigned();
            $table->string('municipality')->nullable();
            $table->integer('ward_no')->nullable();
            $table->string('image')->nullable();
            $table->string('dob')->nullable();
            $table->string('joining_date');
            $table->string('leaving_date')->nullable();
            $table->string('mobile')->nullable();
            $table->string('email')->nullable();
            $table->string('degree')->nullable();
            $table->enum('gender',['Male'=>'Male','Female'=>'Female','Other'=>'Other']);
            $table->boolean('working_status')->default(0);
            $table->boolean('is_teaching_official')->default(0);
            $table->boolean('status')->default(0);
            $table->integer('order');
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
        Schema::dropIfExists('officials');
    }
}
