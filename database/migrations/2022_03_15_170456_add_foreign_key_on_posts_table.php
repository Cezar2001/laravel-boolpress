<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeyOnPostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('posts', function (Blueprint $table) {

            $table->unsignedBigInteger('user_id')->nullable();

            $table->foreignId('user_id')
                ->after('slug')
                ->constrained();
      
            $table->foreignId("category_id")
                ->after('user_id')
                ->constrained();
          });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->dropForeign('posts_user_id_foreign');
            $table->dropColumn('user_id');

            $table->dropForeign('posts_category_id_foreign');    
            $table->dropColumn('category_id');
        });
    }
}
