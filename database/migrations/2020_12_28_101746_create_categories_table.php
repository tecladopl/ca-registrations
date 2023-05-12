<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('category_types', function (Blueprint $table) {
            $table->id();
            $table->string('type');
            $table->timestamps();
        });

        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('priority');
            $table->foreignId('assembly_id')->constrained();
            $table->foreignId('category_type_id')->constrained();
            $table->softDeletes('deleted_at', 0);
            $table->timestamps();
        });

        Schema::create('category_values', function (Blueprint $table) {
            $table->id();
            $table->string('value')->nullable()->index();
            $table->integer('min')->nullable()->index();
            $table->integer('max')->nullable()->index();
            $table->integer('amount')->index();
            $table->foreignId('category_id')->constrained();
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
        Schema::dropIfExists('categories');
        Schema::dropIfExists('category_types');
        Schema::dropIfExists('category_values');
    }
}
