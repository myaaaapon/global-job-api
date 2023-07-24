<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('html_tag_id');
            $table->string('title');
            $table->text('body');
            $table->unsignedBigInteger('company_id');
            $table->string('price');
            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('contract_type_id');
            $table->unsignedBigInteger('remote_id');
            $table->date('published_at')->nullable();
            $table->string('image_url')->nullable();
            $table->float('score')->nullable();
            $table->timestamps();

            $table->foreign('html_tag_id')->references('id')->on('html_tags');
            $table->foreign('company_id')->references('id')->on('companies');
            $table->foreign('category_id')->references('id')->on('categories');
            $table->foreign('contract_type_id')->references('id')->on('contract_types');
            $table->foreign('remote_id')->references('id')->on('remotes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('items');
    }
}
