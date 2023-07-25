<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHtmlTagsTable extends Migration
{
    /**
     * マイグレーションを実行します。
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('html_tags', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('job_id')->comment('求人情報ID');
            $table->string('title')->comment('タイトル');
            $table->text('body')->comment('本文');
            $table->unsignedBigInteger('language_id')->comment('言語ID');
            $table->timestamps();

            $table->foreign('job_id')->references('id')->on('jobs')->onDelete('cascade');
            $table->foreign('language_id')->references('id')->on('languages')->onDelete('cascade');
        });
    }

    /**
     * マイグレーションをロールバックします。
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('html_tags');
    }
}