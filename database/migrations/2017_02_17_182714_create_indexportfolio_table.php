<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIndexportfolioTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('indexportfolio', function (Blueprint $table) {
      $table->increments('id');
      $table->string('background', 1024)->nullable();
      $table->string('indexbox', 1024)->nullable();
      $table->string('id_fk', 1024)->nullable();
      $table->string('phpindex', 1024)->nullable();
      $table->mediumText('position')->nullable();
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
      Schema::dropIfExists('indexportfolio');
  }
}
