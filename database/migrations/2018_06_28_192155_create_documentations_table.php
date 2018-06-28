<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDocumentationsTable extends Migration
{
    public function up()
    {
        Schema::create('documentations', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->text('documentation');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('documentations');
    }
}
