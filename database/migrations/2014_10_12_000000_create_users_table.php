<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('role');
            $table->bigInteger('subscription')->unsigned();

            $table->text('subscription_id')->nullable();

            $table->string('zip_code')->nullable();
            $table->string('weight')->nullable();
            $table->string('height')->nullable();
            $table->string('age')->nullable();
            $table->string('gender')->nullable();

//            $table->string('session_id')->nullable();
//            $table->string('stripe_customer_id')->unique()->default(1);

            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
