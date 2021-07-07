<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTimeSheetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('time_sheets', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->comment('ユーザーID');
            $table->date('workday')->comment('勤務日');
            $table->float('work_hour', 4, 2)->comment('労働時間');
            $table->time('work_start', $precision = 0)->comment('出勤時間');
            $table->time('work_end', $precision = 0)->comment('退勤時間');
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
        Schema::dropIfExists('time_sheets');
    }
}
