<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bookmarks', function(Blueprint $table){
            $table->foreignId('user_id')->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('house_id')->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->primary(['user_id', 'house_id']);
        });

        Schema::table('messages', function(Blueprint $table){
            $table->foreignId('message_type_id')->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('house_id')->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('user_id')->constrained()->onDelete('cascade')->onUpdate('cascade');
        });

        // Schema::table('projects', function(Blueprint $table){
        //     $table->foreignId('user_id')->constrained();
        //     $table->foreignId('project_state_id')->constrained();
        // });

        Schema::table('houses', function(Blueprint $table){
            $table->foreignId('user_id')->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('house_kind_id')->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('house_type_id')->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('house_state_id')->constrained()->onDelete('cascade')->onUpdate('cascade');
        });

        Schema::table('news', function(Blueprint $table){
            $table->foreignId('admin_id')->constrained()->onDelete('cascade')->onUpdate('cascade');
        });

        Schema::table('user_accounts', function(Blueprint $table){
            $table->foreignId('user_id')->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->primary('user_id');
        });
        Schema::table('admin_accounts', function(Blueprint $table){
            $table->foreignId('admin_id')->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->primary('admin_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bookmarks');
    }
};
