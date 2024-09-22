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
        Schema::create('orders', function (Blueprint $table) {

            $table->string('shipping_name')->nullable(); // Thêm trường tên người nhận
            $table->string('shipping_address')->nullable(); // Thêm trường địa chỉ giao hàng
            $table->string('shipping_phone')->nullable(); // Thêm trường số điện thoại giao hàng
           
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn('shipping_name');
            $table->dropColumn('shipping_address');
            $table->dropColumn('shipping_phone');
        });
    }
};
