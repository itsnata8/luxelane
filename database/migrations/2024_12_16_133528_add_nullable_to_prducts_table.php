<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->string('title')->varchar(255)->nullable(true)->change();
            $table->string('slug')->varchar(255)->nullable(true)->change();
            $table->integer('category_id')->nullable(true)->change();
            $table->integer('sub_category_id')->nullable(true)->change();
            $table->integer('brand_id')->nullable(true)->change();
            $table->double('old_price')->nullable(true)->change();
            $table->double('price')->nullable(true)->change();
            $table->text('short_description')->nullable(true)->change();
            $table->longText('description')->nullable(true)->change();
            $table->text('additional_information')->nullable(true)->change();
            $table->text('shipping_returns')->nullable(true)->change();
            $table->integer('created_by')->nullable(true)->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->string('title')->varchar(255)->nullable(false)->change();
            $table->string('slug')->varchar(255)->nullable(false)->change();
            $table->integer('category_id')->nullable(false)->change();
            $table->integer('sub_category_id')->nullable(false)->change();
            $table->integer('brand_id')->nullable(false)->change();
            $table->double('old_price')->nullable(false)->change();
            $table->double('price')->nullable(false)->change();
            $table->text('short_description')->nullable(false)->change();
            $table->longText('description')->nullable(false)->change();
            $table->text('additional_information')->nullable(false)->change();
            $table->text('shipping_returns')->nullable(false)->change();
            $table->integer('created_by')->nullable(false)->change();
        });
    }
};
