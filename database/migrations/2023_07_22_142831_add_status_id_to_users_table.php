<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Domain\Entities\UserStatus;

class AddStatusIdToUsersTable extends Migration
{
    /**
     * マイグレーションを実行します。
     *
     * @return void
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->unsignedBigInteger('status_id')->default(UserStatus::FREE_USER)->comment('ステータスID');
            $table->foreign('status_id')->references('id')->on('user_statuses')->onDelete('restrict');
        });
    }

    /**
     * マイグレーションをロールバックします。
     *
     * @return void
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['status_id']);
            $table->dropColumn('status_id');
        });
    }
}
