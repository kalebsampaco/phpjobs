<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJobTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('job', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('city_id');
            $table->integer('category_id');
            $table->integer('salary_period_id');
            $table->integer('contract_type_id');
            $table->integer('education_type_id');
            $table->string('company_name');
            $table->string('position');
            $table->float('salary_from');
            $table->float('salary_to');
            $table->float('experience');
            $table->text('description');
            $table->string('contact_name');
            $table->string('contact_email');
            $table->string('contact_phone');
            $table->text('apply_url');
            $table->enum('status', ['new', 'active', 'inactive']);
            $table->dateTime('expires_at');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('job');
    }

}
