<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeDetailNullableOnContactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
{
    Schema::table('contacts', function (Blueprint $table) {
        $table->integer('detail')->nullable()->change();
    });
}

public function down()
{
    Schema::table('contacts', function (Blueprint $table) {
        $table->integer('detail')->nullable(false)->change();
    });
}


}
