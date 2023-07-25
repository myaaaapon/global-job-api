<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemsTable extends Migration
{
    /**
     * マイグレーションを実行します。
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('html_tag_id')->comment('HTMLタグID');
            $table->string('title')->comment('タイトル');
            $table->text('body')->comment('本文');
            $table->unsignedBigInteger('company_id')->comment('会社ID');
            $table->string('price')->comment('価格');
            $table->unsignedBigInteger('category_id')->comment('カテゴリID');
            $table->unsignedBigInteger('contract_type_id')->comment('契約タイプID');
            $table->unsignedBigInteger('remote_id')->comment('リモートID');
            $table->date('published_at')->nullable()->comment('公開日');
            $table->string('image_url')->nullable()->comment('画像URL');
            $table->float('score')->nullable()->comment('スコア');
            $table->timestamps();

            $table->foreign('html_tag_id')->references('id')->on('html_tags');
            $table->foreign('company_id')->references('id')->on('companies');
            $table->foreign('category_id')->references('id')->on('categories');
            $table->foreign('contract_type_id')->references('id')->on('contract_types');
            $table->foreign('remote_id')->references('id')->on('remotes');
        });
    }

    /**
     * マイグレーションをロールバックします。
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('items');
    }
}
