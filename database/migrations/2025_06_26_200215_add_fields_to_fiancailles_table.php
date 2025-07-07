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
        Schema::table('fiancailles', function (Blueprint $table) {
            $table->date('date_benediction')->nullable()->after('date_mariage');
            $table->string('lieu_dot', 255)->nullable()->after('date_dot');
            $table->string('lieu_mariage', 255)->nullable()->after('date_mariage');
            $table->string('lieu_benediction', 255)->nullable()->after('date_benediction');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('fiancailles', function (Blueprint $table) {
            $table->dropColumn([
                'date_benediction',
                'lieu_dot',
                'lieu_mariage',
                'lieu_benediction'
            ]);
        });
    }
};