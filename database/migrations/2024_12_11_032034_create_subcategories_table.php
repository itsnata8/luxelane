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
        Schema::create('subcategories', function (Blueprint $table) {
            $table->id();
            $table->integer('category_id');
            $table->string('name')->varchar(255);
            $table->string('slug')->varchar(255);
            $table->string('meta_title')->varchar(255);
            $table->text('meta_description');
            $table->string('meta_keywords')->varchar(255);
            $table->integer('created_by');
            $table->tinyInteger('status')->default(0)->comment('0 = inactive, 1 = active');
            $table->tinyInteger('is_delete')->default(0)->comment('0 = active, 1 = deleted');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subcategories');
    }
};
