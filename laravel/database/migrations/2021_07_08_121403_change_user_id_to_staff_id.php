<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeUserIdToStaffId extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('time_sheets', function (Blueprint $table) {
            //
            $table->renameColumn('user_id', 'staff_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('time_sheets', function (Blueprint $table) {
            //
            $table->renameColumn('staff_id', 'user_id');
        });
    }
}
