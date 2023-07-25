<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobsTable extends Migration
{
    /**
     * マイグレーションを実行します。
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('jobs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('site_id')->comment('サイトID');
            $table->string('url')->comment('URL');
            $table->text('content')->comment('コンテンツ');
            $table->timestamps();

            $table->foreign('site_id')->references('id')->on('sites')->onDelete('cascade');
        });
    }

    /**
     * マイグレーションをロールバックします。
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('jobs');
    }
}
