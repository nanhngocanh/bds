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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string("fullname");
            $table->boolean("block_state")->nullable();
            $table->string("email");
            $table->string("phone");
            $table->timestamps();
        });

        Schema::create('user_accounts', function(Blueprint $table){
            $table->string('username');
            $table->string('password');
            $table->timestamps();
        });


        Schema::create("houses", function(Blueprint $table){
            $table->id();
            $table->boolean("sell_state");
            // co san noi that
            $table->string("title");
            $table->boolean("post_state"); // 1: "da duyet", 0 : "chua duyet"
            $table->boolean("furniture");
            $table->integer("livingroom");
            $table->integer("kitchen");
            $table->integer('toilet');
            $table->integer('bedroom');
            $table->integer('bathroom');
            $table->string('city');
            // huyen
            $table->string('district');
            // xa
            $table->string('commune');
            $table->string("address");
            $table->string("images");
            $table->float('size');
            $table->text("desciption");
            $table->integer('price');
            $table->timestamps();
        });
        // Schema::create('projects', function(Blueprint $table){
        //     $table->id();
        //     $table->string('name');
        //     $table->text("content");

        //     // trang thai du an da xong dang xay xung dang cho
        //     //$table->string("projectState");

        //     // trang thai bai dang khoa hay khong khoa
        //     $table->boolean('poster_state');
        //     $table->timestamps();
        // });

        Schema::create('admins', function(Blueprint $table){
            $table->id();
            $table->string('fullname');
            $table->string('email');
            $table->string('phone');
            $table->timestamps();
        });

        Schema::create('admin_accounts', function(Blueprint $table){
            $table->string('username');
            $table->string('password');
            $table->timestamps();
        });

        Schema::create('news', function(Blueprint $table){
            $table->id();
            $table->string("title");
            $table->text('content');
            $table->string('auther');
            $table->timestamps();
        });

        Schema::create('messages', function(Blueprint $table){
            $table->id();
            $table->text('content');
            $table->timestamps();
        });

        Schema::create('message_types', function(Blueprint $table){
            $table->id();
            $table->string('type');
            $table->timestamps();
        });

        // trang thai du an da xong dang xay xung dang cho
        Schema::create('house_states', function(Blueprint $table){
            $table->id();
            $table->string('state');
            $table->timestamps();
        });

        // cho thue, ban
        Schema::create('house_types', function(Blueprint $table){
            $table->id();
            $table->string('type');
            $table->timestamps();
        });

        // chung cu, nha dat
        Schema::create('house_kinds', function(Blueprint $table){
            $table->id();
            $table->string('kind');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('messages');
        Schema::dropIfExists('houses');
        Schema::dropIfExists('news');
        Schema::dropIfExists('user_accounts');
        Schema::dropIfExists('admin_accounts');

        Schema::dropIfExists('projects');

        Schema::dropIfExists('users');
        Schema::dropIfExists('admins');
        Schema::dropIfExists('message_types');
        Schema::dropIfExists('project_states');
        Schema::dropIfExists('house_types');
        Schema::dropIfExists('house_kinds');
    }
};
