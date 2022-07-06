<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->string('cover');
            $table->string('title',255);
            $table->string('full_text',5000);
            $table->string('short_text',100);
            $table->string('tags')->nullable();
            $table->integer('likes_counter')->nullable();
            $table->integer('views_counter')->nullable();
            $table->softDeletes();
            $table->timestamps();
            //$table->foreignIdFor(App\Models\User::class,'user_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('articles');
    }
}
