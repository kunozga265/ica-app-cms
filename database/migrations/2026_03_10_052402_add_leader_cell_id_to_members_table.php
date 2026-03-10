<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddLeaderCellIdToMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('members', function (Blueprint $table) {
            $table->integer("leader_cell_id")->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('members', function (Blueprint $table) {
            $table->dropColumn('leader_cell_id');
        });
    }
}
