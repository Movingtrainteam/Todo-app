<?php


use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDefaultValueToIsCompleted extends Migration
{
    public function up()
    {
        Schema::table('todos', function (Blueprint $table) {
            $table->boolean('is_completed')->default(false)->change();
        });
    }

    public function down()
    {
        Schema::table('todos', function (Blueprint $table) {
            $table->boolean('is_completed')->default(null)->change();
        });
    }
}

                                                 