<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFileuploadTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('fileupload', function (Blueprint $table) {
      $table->increments('id');
      $table->string('user_id');
      $table->string('namefile');
      $table->string('file');
      $table->string('type');
      $table->string('sizefile');
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
      Schema::dropIfExists('fileupload');
  }
}
