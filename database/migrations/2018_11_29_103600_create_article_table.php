<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticleTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('article', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('article_category_id');
            $table->text('relative_url');
            $table->string('title');
            $table->text('excerpt');
            $table->text('content');
            $table->text('image');
            $table->string('seo_title');
            $table->string('seo_keywords');
            $table->string('seo_description');
            $table->boolean('display_in_list')->defalut('false');
            $table->enum('status', ['draft', 'active'])->default('draft');
            $table->dateTime('published_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('article');
    }

}
