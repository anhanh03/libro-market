<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('sellers', function (Blueprint $table) {
            $table->string('business_name')->nullable();
            $table->string('business_address')->nullable();
        });
    }

    public function down()
    {
        Schema::table('sellers', function (Blueprint $table) {
            $table->dropColumn('business_name');
            $table->dropColumn('business_address');
        });
    }
};