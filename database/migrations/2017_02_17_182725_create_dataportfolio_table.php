<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDataportfolioTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('dataportfolio', function (Blueprint $table) {
      $table->increments('id');
      $table->string('title', 255)->nullable();
      $table->string('titlesmall', 255)->nullable();
      $table->mediumText('text')->nullable();
      $table->string('video', 255)->nullable();
      $table->string('img', 255)->nullable();
      $table->string('colorfont1', 20)->nullable();
      $table->string('colorfont2', 20)->nullable();
      $table->string('colorbg1', 20)->nullable();
      $table->string('colorbg2', 20)->nullable();
      $table->string('sizefile')->nullable();
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
      Schema::dropIfExists('dataportfolio');
  }
}
