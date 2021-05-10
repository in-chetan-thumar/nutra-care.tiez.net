<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->id();
            $table->string('section_title')->nullable();
            $table->string('field_title')->nullable();
            $table->string('input_type')->nullable();
            $table->string('column')->nullable();
            $table->text('value')->nullable();
            $table->text('rules')->nullable();
            $table->integer('section_sort_no')->nullable();
            $table->integer('sort_no')->nullable();
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
