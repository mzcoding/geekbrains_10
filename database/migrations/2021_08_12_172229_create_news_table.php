<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('news', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')
				->constrained('categories')
				->cascadeOnDelete();

            $table->string('title', 191);
            $table->string('author', 191)->nullable();
            $table->string('image', 255)->nullable();
            $table->enum('status', ['DRAFT', 'PUBLISHED', 'DELETED'])
				->default('DRAFT');
            $table->boolean('isActive')->default(true);
            $table->text('description')->nullable();
            $table->timestamps();

            $table->index(['status', 'isActive']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('news');
    }
}
