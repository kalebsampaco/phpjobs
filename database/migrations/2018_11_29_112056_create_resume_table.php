<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateResumeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('resume', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('city_id');
            $table->integer('category_id');
            $table->integer('salary_period_id');
            $table->integer('contract_type_id');
            $table->integer('education_type_id');
            $table->string('full_name');
            $table->string('position');
            $table->string('experience');
            $table->string('expected_salary');
            $table->text('description');
            $table->string('email');
            $table->string('phone');
            $table->text('photo');
            $table->enum('status', ['new', 'active', 'inactive'])->default('new');
            $table->dateTime('expires_at');
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
        Schema::dropIfExists('resume');
    }
}
