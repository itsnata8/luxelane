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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('title')->varchar(255);
            $table->string('slug')->varchar(255);
            $table->integer('category_id');
            $table->integer('sub_category_id');
            $table->integer('brand_id');
            $table->double('old_price');
            $table->double('price');
            $table->text('short_description');
            $table->longText('description');
            $table->text('additional_information');
            $table->text('shipping_returns');
            $table->tinyInteger('status')->default(0)->comment('0 = inactive, 1 = active');
            $table->tinyInteger('is_delete')->default(0)->comment('0 = active, 1 = deleted');
            $table->integer('created_by');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
