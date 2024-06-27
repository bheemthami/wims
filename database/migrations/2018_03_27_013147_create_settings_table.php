<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->increments('id');
            $table->string('logo')->default('logo.png');
            $table->string('local_logo')->default('local_logo.png');
            $table->string('favicon')->default('favicon.png');
            $table->string('system_name')->default('Basic Level Grade Automation System');
            $table->string('system_short_name')->default('BLGAS');
            $table->string('tag_line')->default('Edit Your Tag Line');
            $table->string('municipality')->default('Bigu Rural Municipality');
            $table->string('office')->default('Office of the Municipal Executive');
            $table->string('office_address')->default('Edit Office Address');
            $table->string('district_name')->default('Dolakha');
            $table->string('province_name')->default('Edit Province Name');
            $table->integer('province_no')->default(3);
            $table->string('phone')->default('Edit Phone Details');
            $table->string('email')->default('example@gmail.com');
            $table->integer('academic_year_id');
            $table->integer('per_page')->default(20);
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
        Schema::dropIfExists('settings');
    }
}
