<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDocumentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('documents', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug');
            $table->longText('summary')->nullable();
            $table->string('image')->nullable();
            $table->string('attachment')->nullable();
            $table->integer('order');
            $table->boolean('status');
            $table->string('remarks')->nullable();
            $table->integer('academic_year_id')->unsigned();
            $table->integer('document_type_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->date('date');
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
        Schema::dropIfExists('documents');
    }
}
