<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCountriesTable extends Migration
{
    /**
     * マイグレーションを実行します。
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('countries', function (Blueprint $table) {
            $table->id();
            $table->string('name')->comment('国名');
            $table->timestamps();
        });
    }

    /**
     * マイグレーションをロールバックします。
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('countries');
    }
}
