<?php

use App\Models\Order;
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
    Schema::create('orders', function (Blueprint $table) {
      $table->id();
      $table->unsignedBigInteger('customer_id');
      $table->unsignedBigInteger('manager_id')->nullable();
      $table->string('name');
      $table->string('phone_number');
      $table->string('email');
      $table->string('company');
      $table->text('description')->nullable();
      $table->json('services')->nullable();
      $table->string('status')->default(Order::REQUEST_FROM_CLIENT);
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
    Schema::dropIfExists('orders');
  }
};
