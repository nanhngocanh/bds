<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        DB::table('users')->insert([
            ['fullname' => Str::random(10), 'email' => Str::random(10)."@gmail.com", 'block_state' => false, 'phone' => rand(1000000, 999999)],
            ['fullname' => Str::random(10), 'email' => Str::random(10)."@gmail.com", 'block_state' => false, 'phone' => rand(1000000, 999999)],
            ['fullname' => Str::random(10), 'email' => Str::random(10)."@gmail.com", 'block_state' => false, 'phone' => rand(1000000, 999999)],
            ['fullname' => Str::random(10), 'email' => Str::random(10)."@gmail.com", 'block_state' => false, 'phone' => rand(1000000, 999999)],
            ['fullname' => Str::random(10), 'email' => Str::random(10)."@gmail.com", 'block_state' => false, 'phone' => rand(1000000, 999999)],
            ['fullname' => Str::random(10), 'email' => Str::random(10)."@gmail.com", 'block_state' => false, 'phone' => rand(1000000, 999999)],
            ['fullname' => Str::random(10), 'email' => Str::random(10)."@gmail.com", 'block_state' => false, 'phone' => rand(1000000, 999999)],
            ['fullname' => Str::random(10), 'email' => Str::random(10)."@gmail.com", 'block_state' => false, 'phone' => rand(1000000, 999999)],
            ['fullname' => Str::random(10), 'email' => Str::random(10)."@gmail.com", 'block_state' => false, 'phone' => rand(1000000, 999999)],
            ['fullname' => Str::random(10), 'email' => Str::random(10)."@gmail.com", 'block_state' => false, 'phone' => rand(1000000, 999999)],
        ]);


        DB::table('user_accounts')->insert([
            ['user_id' => '10', 'username' => 'username10', 'password' => bcrypt('111111')],
            ['user_id' => '1', 'username' => 'username1', 'password' => bcrypt('111111')],
            ['user_id' => '2', 'username' => 'username2', 'password' => bcrypt('111111')],
            ['user_id' => '3', 'username' => 'username3', 'password' => bcrypt('111111')],
            ['user_id' => '4', 'username' => 'username4', 'password' => bcrypt('111111')],
            ['user_id' => '5', 'username' => 'username5', 'password' => bcrypt('111111')],
            ['user_id' => '6', 'username' => 'username6', 'password' => bcrypt('111111')],
            ['user_id' => '7', 'username' => 'username7', 'password' => bcrypt('111111')],
            ['user_id' => '8', 'username' => 'username8', 'password' => bcrypt('111111')],
            ['user_id' => '9', 'username' => 'username9', 'password' => bcrypt('111111')],
        ]);

        DB::table('admins')->insert([
            ['fullname' => Str::random(10), 'email' => Str::random(10)."@gmail.com", 'phone' => rand(1000000, 999999)],
            ['fullname' => Str::random(10), 'email' => Str::random(10)."@gmail.com", 'phone' => rand(1000000, 999999)],
            ['fullname' => Str::random(10), 'email' => Str::random(10)."@gmail.com", 'phone' => rand(1000000, 999999)],
        ]);


        DB::table('admin_accounts')->insert([
            ['admin_id' => '3', 'username' => 'admin', 'password' => bcrypt('password')],
            ['admin_id' => '1', 'username' => 'admin', 'password' => bcrypt('password')],
            ['admin_id' => '2', 'username' => 'admin', 'password' => bcrypt('password')],
        ]);

        DB::table('message_types')->insert([
            ['type' => 'warning'],      // canh bao
            ['type' => 'contact'],      // lien lac lai
            ['type' => 'report'],       // bao cao
        ]);

        DB::table('house_states')->insert([
            ['state' => 'done'],        // da hoan hanh
            ['state' => 'active'],      // dang hoat dong
            ['state' => 'wait'],        // cho
        ]);

        DB::table('house_types')->insert([
            ['type' => 'sell'],            // ban nha
            ['type' => 'rent'],            // cho thue
        ]);

        DB::table('house_kinds')->insert([
            ['kind' => 'apartment'],        // chung cu
            ['kind' => 'ground'],           // nha mat dat
        ]);

        // DB::table('projects')->insert([
        //     ['name' => Str::random(10), 'content' => 'hava somw conetet hear', 'poster_state' => true, 'user_id' =>'3', 'project_state_id' =>'1'],
        //     ['name' => Str::random(10), 'content' => 'hava somw conetet hear', 'poster_state' => true, 'user_id' =>'3', 'project_state_id' =>'1'],
        //     ['name' => Str::random(10), 'content' => 'hava somw conetet hear', 'poster_state' => true, 'user_id' =>'2', 'project_state_id' =>'1'],
        //     ['name' => Str::random(10), 'content' => 'hava somw conetet hear', 'poster_state' => true, 'user_id' =>'2', 'project_state_id' =>'1'],
        //     ['name' => Str::random(10), 'content' => 'hava somw conetet hear', 'poster_state' => true, 'user_id' =>'2', 'project_state_id' =>'1'],
        //     ['name' => Str::random(10), 'content' => 'hava somw conetet hear', 'poster_state' => true, 'user_id' =>'2', 'project_state_id' =>'1'],
        //     ['name' => Str::random(10), 'content' => 'hava somw conetet hear', 'poster_state' => true, 'user_id' =>'1', 'project_state_id' =>'1'],
        //     ['name' => Str::random(10), 'content' => 'hava somw conetet hear', 'poster_state' => true, 'user_id' =>'1', 'project_state_id' =>'1'],
        //     ['name' => Str::random(10), 'content' => 'hava somw conetet hear', 'poster_state' => true, 'user_id' =>'1', 'project_state_id' =>'1'],
        //     ['name' => Str::random(10), 'content' => 'hava somw conetet hear', 'poster_state' => true, 'user_id' =>'1', 'project_state_id' =>'1'],
        // ]);

        DB::table('houses')->insert([
            ['sell_state' => false, 'post_state' => false, 'title' => 'Ban nha', 'furniture' => true, 'livingroom' => '1', 'kitchen' =>'0', 'toilet' => '2', 'bedroom' => '2', 'bathroom' => '2', 'city' => '18', 'district' => '20', 'commune' => '12', 'address' => Str::random(10), 'images' => '', 'size' => '100', 'desciption' => Str::random(16), 'price'=> '12000', 'user_id' => '3', 'house_state_id' => '1', 'house_type_id' => '1', 'house_kind_id' => '1'],
            ['sell_state' => false, 'post_state' => false, 'title' => 'Ban nha', 'furniture' => true, 'livingroom' => '1', 'kitchen' =>'0', 'toilet' => '2', 'bedroom' => '2', 'bathroom' => '2', 'city' => '18', 'district' => '20', 'commune' => '12', 'address' => Str::random(10), 'images' => '', 'size' => '100', 'desciption' => Str::random(16), 'price'=> '12000', 'user_id' => '3', 'house_state_id' => '1', 'house_type_id' => '2', 'house_kind_id' => '2'],
            ['sell_state' => false, 'post_state' => false, 'title' => 'Ban nha', 'furniture' => true, 'livingroom' => '1', 'kitchen' =>'2', 'toilet' => '2', 'bedroom' => '2', 'bathroom' => '2', 'city' => '18', 'district' => '20', 'commune' => '12', 'address' => Str::random(10), 'images' => '', 'size' => '100', 'desciption' => Str::random(16), 'price'=> '12000', 'user_id' => '3', 'house_state_id' => '1', 'house_type_id' => '2', 'house_kind_id' => '1'],
            ['sell_state' => false, 'post_state' => false, 'title' => 'Ban nha', 'furniture' => true, 'livingroom' => '1', 'kitchen' =>'2', 'toilet' => '2', 'bedroom' => '2', 'bathroom' => '2', 'city' => '18', 'district' => '20', 'commune' => '12', 'address' => Str::random(10), 'images' => '', 'size' => '100', 'desciption' => Str::random(16), 'price'=> '12000', 'user_id' => '3', 'house_state_id' => '1', 'house_type_id' => '2', 'house_kind_id' => '1'],
            ['sell_state' => false, 'post_state' => false, 'title' => 'Ban nha', 'furniture' => true, 'livingroom' => '1', 'kitchen' =>'2', 'toilet' => '2', 'bedroom' => '2', 'bathroom' => '2', 'city' => '18', 'district' => '20', 'commune' => '12', 'address' => Str::random(10), 'images' => '', 'size' => '100', 'desciption' => Str::random(16), 'price'=> '12000', 'user_id' => '3', 'house_state_id' => '1', 'house_type_id' => '2', 'house_kind_id' => '1'],
            ['sell_state' => false, 'post_state' => false, 'title' => 'Ban nha', 'furniture' => true, 'livingroom' => '1', 'kitchen' =>'2', 'toilet' => '2', 'bedroom' => '2', 'bathroom' => '2', 'city' => '18', 'district' => '20', 'commune' => '12', 'address' => Str::random(10), 'images' => '', 'size' => '100', 'desciption' => Str::random(16), 'price'=> '12000', 'user_id' => '1', 'house_state_id' => '1', 'house_type_id' => '1', 'house_kind_id' => '2'],
            ['sell_state' => false, 'post_state' => false, 'title' => 'Ban nha', 'furniture' => true, 'livingroom' => '1', 'kitchen' =>'2', 'toilet' => '2', 'bedroom' => '2', 'bathroom' => '2', 'city' => '18', 'district' => '20', 'commune' => '12', 'address' => Str::random(10), 'images' => '', 'size' => '100', 'desciption' => Str::random(16), 'price'=> '12000', 'user_id' => '1', 'house_state_id' => '1', 'house_type_id' => '1', 'house_kind_id' => '2'],
            ['sell_state' => false, 'post_state' => false, 'title' => 'Ban nha', 'furniture' => true, 'livingroom' => '1', 'kitchen' =>'2', 'toilet' => '2', 'bedroom' => '2', 'bathroom' => '2', 'city' => '18', 'district' => '20', 'commune' => '12', 'address' => Str::random(10), 'images' => '', 'size' => '100', 'desciption' => Str::random(16), 'price'=> '12000', 'user_id' => '1', 'house_state_id' => '1', 'house_type_id' => '2', 'house_kind_id' => '2'],
            ['sell_state' => false, 'post_state' => false, 'title' => 'Ban nha', 'furniture' => true, 'livingroom' => '1', 'kitchen' =>'1', 'toilet' => '2', 'bedroom' => '2', 'bathroom' => '2', 'city' => '18', 'district' => '20', 'commune' => '12', 'address' => Str::random(10), 'images' => '', 'size' => '100', 'desciption' => Str::random(16), 'price'=> '12000', 'user_id' => '2', 'house_state_id' => '2', 'house_type_id' => '1', 'house_kind_id' => '2'],
            ['sell_state' => false, 'post_state' => false, 'title' => 'Ban nha', 'furniture' => true, 'livingroom' => '1', 'kitchen' =>'1', 'toilet' => '2', 'bedroom' => '2', 'bathroom' => '2', 'city' => '18', 'district' => '20', 'commune' => '12', 'address' => Str::random(10), 'images' => '', 'size' => '100', 'desciption' => Str::random(16), 'price'=> '12000', 'user_id' => '2', 'house_state_id' => '2', 'house_type_id' => '2', 'house_kind_id' => '2'],
            ['sell_state' => false, 'post_state' => false, 'title' => 'Ban nha', 'furniture' => true, 'livingroom' => '1', 'kitchen' =>'1', 'toilet' => '2', 'bedroom' => '2', 'bathroom' => '2', 'city' => '18', 'district' => '20', 'commune' => '12', 'address' => Str::random(10), 'images' => '', 'size' => '100', 'desciption' => Str::random(16), 'price'=> '12000', 'user_id' => '2', 'house_state_id' => '2', 'house_type_id' => '1', 'house_kind_id' => '2'],
            ['sell_state' => false, 'post_state' => false, 'title' => 'Ban nha', 'furniture' => true, 'livingroom' => '1', 'kitchen' =>'1', 'toilet' => '2', 'bedroom' => '2', 'bathroom' => '2', 'city' => '18', 'district' => '20', 'commune' => '12', 'address' => Str::random(10), 'images' => '', 'size' => '100', 'desciption' => Str::random(16), 'price'=> '12000', 'user_id' => '2', 'house_state_id' => '2', 'house_type_id' => '2', 'house_kind_id' => '1'],
        ]);

        DB::table('news')->insert([
            ['title' => 'bao viet nam xa hoi chu nghia', 'content' => 'hava somw conetet hear', 'auther' => 'hoang xuan bach', 'admin_id' =>'2'],
            ['title' => 'bao viet nam xa hoi chu nghia', 'content' => 'hava somw conetet hear', 'auther' => 'hoang xuan bach', 'admin_id' =>'2'],
            ['title' => 'bao viet nam xa hoi chu nghia', 'content' => 'hava somw conetet hear', 'auther' => 'hoang xuan bach', 'admin_id' =>'1'],
        ]);

        DB::table('messages')->insert([
            ['content' => 'hava somw conetet hear', 'message_type_id' => '2', 'user_id' =>'2', 'house_id' => '1'],
            ['content' => 'hava somw conetet hear', 'message_type_id' => '2', 'user_id' =>'2', 'house_id' => '1'],
            ['content' => 'hava somw conetet hear', 'message_type_id' => '1', 'user_id' =>'1', 'house_id' => '1'],
        ]);

        DB::table('bookmarks')->insert([
            ['user_id' =>'2', 'house_id' => '2'],
            ['user_id' =>'2', 'house_id' => '1'],
            ['user_id' =>'1', 'house_id' => '1'],
        ]);
    }
}
