<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('reviews', function (Blueprint $table) {
      $table->id();
      $table->unsignedBigInteger('customer_id');
      $table->text('message');
      $table->smallInteger('grade');
      $table->boolean('published');
      $table->timestamps();

      $table->foreign('customer_id')->references('id')->on('customers');
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('reviews');
  }
};
