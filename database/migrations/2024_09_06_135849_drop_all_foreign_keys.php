<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropAllForeignKeys extends Migration
{
    public function up()
    {
        Schema::table('your_table_name', function (Blueprint $table) {
            $connection = Schema::getConnection();
            // Sử dụng $connection ở đây
            $table->dropForeignIfExists('orders_user_id_foreign');
            $table->dropForeignIfExists('orders_seller_id_foreign');
            $table->dropForeignIfExists('orders_coupon_id_foreign');    
        });

        Schema::table('orders', function (Blueprint $table) {
            $table->dropForeignKeyIfExists('orders_user_id_foreign');
            $table->dropForeignKeyIfExists('orders_seller_id_foreign');
            $table->dropForeignKeyIfExists('orders_coupon_id_foreign');
        });

        Schema::table('order_items', function (Blueprint $table) {
            $table->dropForeignKeyIfExists('order_items_order_id_foreign');
            $table->dropForeignKeyIfExists('order_items_product_id_foreign');
        });

        Schema::table('carts', function (Blueprint $table) {
            $table->dropForeignKeyIfExists('carts_user_id_foreign');
            $table->dropForeignKeyIfExists('carts_product_id_foreign');
        });

        Schema::table('payments', function (Blueprint $table) {
            $table->dropForeignKeyIfExists('payments_order_id_foreign');
        });

        Schema::table('products', function (Blueprint $table) {
            $table->dropForeignKeyIfExists('products_category_id_foreign');
            $table->dropForeignKeyIfExists('products_seller_id_foreign');
        });

        Schema::table('reviews', function (Blueprint $table) {
            $table->dropForeignKeyIfExists('reviews_user_id_foreign');
            $table->dropForeignKeyIfExists('reviews_product_id_foreign');
        });

        Schema::table('sellers', function (Blueprint $table) {
            $table->dropForeignKeyIfExists('sellers_user_id_foreign');
        });

        Schema::table('shippings', function (Blueprint $table) {
            $table->dropForeignKeyIfExists('shippings_order_id_foreign');
        });
    }

    public function down()
    {
        // Không cần thực hiện gì trong phương thức down()
    }
}
