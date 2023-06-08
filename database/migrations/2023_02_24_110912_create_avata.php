<?php

use App\Models\Admin;
use App\Models\User;
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
        Schema::create('user_avatars', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class);
            $table->string('image');
            $table->timestamps();
        });

        Schema::create('admin_avatars', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Admin::class);
            $table->string('image');
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
        Schema::dropIfExists('user_avatars');
        Schema::dropIfExists('admin_avatars');
    }
};
