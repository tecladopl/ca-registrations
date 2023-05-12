<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateValidationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('validations', function (Blueprint $table) {
            $table->id();
            $table->string('rule');
            $table->string('attach');
            $table->text('message');
            $table->softDeletes('deleted_at', 0);
            $table->timestamps();
        });
        Schema::create('question_validation', function (Blueprint $table) {
            $table->id();
            $table->foreignId('question_id');
            $table->foreignId('validation_id');
            $table->timestamps();
        });
        Schema::create('answer_validation', function (Blueprint $table) {
            $table->id();
            $table->foreignId('answer_id');
            $table->foreignId('validation_id');
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
        Schema::dropIfExists('validations');
        Schema::dropIfExists('question_validation');
        Schema::dropIfExists('answer_validation');
    }
}
