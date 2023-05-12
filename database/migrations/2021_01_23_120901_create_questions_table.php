<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('question_types', function (Blueprint $table) {
            $table->id();
            $table->string('type');
            $table->softDeletes('deleted_at', 0);
            $table->timestamps();
        });

        Schema::create('questions', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('input_name');
            $table->foreignId('questionnaire_page_id')->constrained();
            $table->foreignId('question_type_id')->constrained();
            $table->string('options')->nullable();
            $table->text('question');
            $table->text('subtext')->nullable();
            $table->string('label')->nullable();
            $table->smallInteger('order');
            $table->boolean('makes_criterium')->default(1);
            $table->softDeletes('deleted_at', 0);
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
        Schema::dropIfExists('questions');
        Schema::dropIfExists('question_types');
    }
}
