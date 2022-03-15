<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeyInPostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->unsignedBigInteger("user_id") // Create the foreign key column
                  ->nullable() // set nullable to avoid the error in migrate
                  ->after("slug");

            $table->foreign("user_id") // the user_id column
                  ->references("id") // refers to the id column
                  ->on("users"); // of the users table

            // contracted version
            // $table->foreignId("user_id")
            //       ->constrained();
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
            $table->dropForeign("posts_user_id_foreign");
            $table->dropColumn("user_id");
        });
    }
}
