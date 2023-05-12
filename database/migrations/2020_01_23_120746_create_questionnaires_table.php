<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuestionnairesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('questionnaires', function (Blueprint $table) {
            $table->id();
            $table->foreignId('assembly_id')->constrained();
            $table->string('path')->default("");
            $table->string('name');
            $table->text('description')->default("");
            $table->text('first_page')->default("");
            $table->text('is_past_msg')->default("");
            $table->text('is_future_msg')->default("");
            $table->text('last_page')->default("");
            $table->text('confirmation_email')->default("");
            $table->text('confirmation_email_subject')->default("");
            $table->text('declaration_of_data_compliance_with_the_truth')->default("");
            $table->text('consent_to_the_processing_of_personal_data')->default("");
            $table->dateTimeTz('start');
            $table->dateTimeTz('end');
            $table->softDeletes('deleted_at', 0);
            $table->timestampsTz();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('questionnaires');
    }
}
