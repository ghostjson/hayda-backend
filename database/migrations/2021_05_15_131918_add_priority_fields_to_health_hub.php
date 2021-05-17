<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPriorityFieldsToHealthHub extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('health_hub', function (Blueprint $table) {
            $table->unsignedBigInteger('category_priority')->default(0);
            $table->unsignedBigInteger('link_priority')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('health_hub', function (Blueprint $table) {
            $table->dropColumn('category_priority');
            $table->dropColumn('link_priority');
        });
    }
}
