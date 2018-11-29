<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('user', function (Blueprint $table) {
            $table->increments('id');
            $table->string('full_name');
            $table->string('email')->unique();
            $table->string('phone')->unique();
            $table->string('password')->nullable();
            $table->string('company_name')->nullable();
            $table->string('company_logo')->nullable();
            $table->text('company_url')->nullable();
            $table->longText('company_description')->nullable();
            $table->boolean('is_agency')->defalut('false');
            $table->enum('type', ['jobseeker', 'employer']);
            $table->enum('status', ['new', 'active', 'disabled'])->default('new');
            $table->enum('promo_status', ['active', 'inactive'])->default('inactive');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('user');
    }

}
