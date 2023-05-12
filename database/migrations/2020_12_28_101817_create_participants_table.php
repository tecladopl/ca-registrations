<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateParticipantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('applicants', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();
            $table->string('identity_string')->unique();
            $table->string('name')->nullable();
            $table->string('surname')->nullable();
            $table->string('email')->nullable();
            $table->string('phone_no')->nullable();
            $table->date('birth_date')->nullable();
            $table->boolean('consent_to_the_processing_of_personal_data')->nullable();
            $table->boolean('declaration_of_data_compliance_with_the_truth')->nullable();
            $table->foreignId('questionnaire_id')->nullable()->constrained();
            $table->foreignId('questionnaire_participant_id')->nullable()->constrained();
            $table->boolean('questionnaire_completed')->default(0);
            $table->integer('current_page')->nullable();
            $table->string('session_token')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('participants', function (Blueprint $table) {
            $table->id();
            $table->foreignId('applicant_id')->constrained();
            $table->timestamps();
            $table->softDeletes('deleted_at', 0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('participants');
        Schema::dropIfExists('applicants');
    }
}
