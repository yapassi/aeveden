<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('rapports', function (Blueprint $table) {
            $table->dropColumn('date_de_creation');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('rapports', function (Blueprint $table) {
            $table->timestamp('date_de_creation')->nullable()->after('coaching_id');
        });
    }
};