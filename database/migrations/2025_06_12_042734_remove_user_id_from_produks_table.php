<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveUserIdFromProduksTable extends Migration
{
    public function up()
    {
        Schema::table('produks', function (Blueprint $table) {
            $table->dropColumn('user_id');
        });
    }

    public function down()
    {
        Schema::table('produks', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->after('id');
        });
    }
}
